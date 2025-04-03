<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function iniciarSesion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:100|regex:/^[\w.+-]+@gmail\.com$/',
            'password' => 'required|string|min:6|max:16',
        ], [
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'El correo no tiene un formato válido.',
            'email.max' => 'El correo no puede exceder los 100 caracteres.',
            'email.regex' => 'Solo se permiten correos de Gmail (@gmail.com).',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.max' => 'La contraseña no puede tener más de 16 caracteres.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('iniciar_sesion')->withErrors($validator)->withInput();
        }

        $email = $request->email;
        $cacheKey = "intentos_login_{$email}";

        // Obtener intentos fallidos
        $intentos = Cache::get($cacheKey, 0);

        // Si ya alcanzó el límite, bloquear cuenta
        if ($intentos >= 5) {
            return redirect()->route('iniciar_sesion')->withErrors([
                'error' => 'Cuenta bloqueada por demasiados intentos fallidos. Intenta nuevamente en 1 hora.',
            ])->withInput();
        }

        // Llamar a la API de autenticación
        $respuesta = Http::post('http://localhost:3001/api/login', [
            'email' => $email,
            'password' => $request->password,
        ]);

        if ($respuesta->failed()) {
            // Incrementar intentos y establecer bloqueo si es necesario
            $intentos++;
            Cache::put($cacheKey, $intentos, now()->addMinutes(60)); // Guardar intentos por 1 hora

            if ($intentos >= 5) {
                return redirect()->route('iniciar_sesion')->withErrors([
                    'error' => 'Cuenta bloqueada por demasiados intentos fallidos. Intenta nuevamente en 1 hora.',
                ])->withInput();
            }

            return redirect()->route('iniciar_sesion')
                ->withErrors(['error' => "Credenciales incorrectas. Intentos restantes: " . (5 - $intentos)])
                ->withInput();
        }

        // Si el login es exitoso, eliminar intentos fallidos
        Cache::forget($cacheKey);

        $data = $respuesta->json();
        if (!isset($data['usuario']) || !isset($data['usuario']['tipo_usuario'])) {
            return redirect()->route('iniciar_sesion')->withErrors(['error' => 'Respuesta inválida del servidor.']);
        }

        $usuario = $data['usuario'];

        // Guardar sesión
        Session::put('usuario', $usuario);
        Session::put('tipo_usuario', $usuario['tipo_usuario']);

        // Redirigir según el rol
        return match ($usuario['tipo_usuario']) {
            'admin' => redirect()->route('admin.dashboard'),
            'visitante' => redirect()->route('visitante.dashboard'),
            'alumno' => redirect()->route('alumno.dashboard'),
            default => redirect()->route('iniciar_sesion')->withErrors(['error' => 'Tipo de usuario no reconocido.']),
        };
    }

    public function cerrarSesion()
    {
        Session::flush();
        return redirect()->route('dashboard');
    }

    public function mostrarFormularioLogin()
    {
        return view('auth.iniciar_sesion');
    }

    public function mostrarFormularioRegistro()
    {
        return view('auth.registrarse');
    }

    public function registrarse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:usuarios,email|regex:/^[\w.+-]+@gmail\.com$/',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'
            ],
            'telefono' => 'required|string|digits:10',
        ], [
            'password.regex' => 'La contraseña debe contener al menos una mayúscula, una minúscula, un número y un carácter especial.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('registrarse')->withErrors($validator)->withInput();
        }

        $tipo_usuario = 'alumno';

        $respuesta = Http::post('http://localhost:3001/api/usuarios', [
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => $request->password,
            'telefono' => $request->telefono,
            'tipo_usuario' => $tipo_usuario,
        ]);

        if ($respuesta->successful()) {
            return redirect()->route('iniciar_sesion')->with('success', 'Registro exitoso. Inicia sesión.');
        }

        return redirect()->route('registrarse')->withErrors(['error' => 'Error al registrar usuario.']);
    }
}
