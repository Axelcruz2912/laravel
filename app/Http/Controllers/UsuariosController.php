<?php

namespace App\Http\Controllers;

use App\Imports\UsuariosImport;
use App\Exports\UsuariosExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UsuariosController extends Controller
{
    public function getData(Request $request)
    {
        $buscar = $request->input('buscar');

        $response = Http::get('http://localhost:3001/api/usuarios/');
        if (!$response->successful()) {
            return redirect()->back()->with('error', 'Error al consultar la API');
        }

        $usuarios = collect($response->json());

        if ($buscar) {
            $usuarios = $usuarios->filter(function ($usuario) use ($buscar) {
                return stripos($usuario['nombre'], $buscar) !== false ||
                       stripos($usuario['email'], $buscar) !== false ||
                       stripos($usuario['telefono'], $buscar) !== false ||
                       stripos($usuario['tipo_usuario'], $buscar) !== false;
            });
        }

        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $usuarios->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $usuarios = new LengthAwarePaginator($currentItems, $usuarios->count(), $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('admin.usuarios', compact('usuarios', 'buscar'));
    }

    public function getData2($id_usuario)
    {
        $response = Http::get('http://localhost:3001/api/usuarios/' . $id_usuario);

        if ($response->successful()) {
            $detalle = $response->json();
            return view('admin.usuarios_detalle', compact('detalle'));
        } else {
            return redirect()->back()->with('error', 'Error al consultar la API');
        }
    }

    public function create()
    {
        return view('admin.usuarios_crear');
    }
    public function postData(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            'telefono' => 'required|string|max:15',
            'tipo_usuario' => 'required|string|in:admin,visitante,alumno',
        ]);

        try {
            $response = Http::post('http://localhost:3001/api/usuarios/', $data);

            $errorMessage = $response->json()['error'] ?? 'Error desconocido';
            return redirect()->back()->with('error', 'Error al crear el usuario: ' . $errorMessage);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error inesperado: ' . $e->getMessage());
        }
    }

    public function editData($id_usuario)
    {
        $response = Http::get('http://localhost:3001/api/usuarios/' . $id_usuario);

        if ($response->successful()) {
            $editar = $response->json();
            return view('admin.usuarios_editar', compact('editar'));
        } else {
            return redirect()->back()->with('error', 'Error al consultar la API');
        }
    }

    public function updateData(Request $request, $id_usuario)
    {
        $data = $request->validate([
            'nombre' => 'sometimes|string|max:100',
            'email' => 'sometimes|email|unique:usuarios,email,' . $id_usuario . ',id_usuario',
            'password' => 'sometimes|string|min:6',
            'telefono' => 'sometimes|string|max:15',
            'tipo_usuario' => 'sometimes|string|in:admin,visitante,alumno',
        ]);

        $response = Http::put('http://localhost:3001/api/usuarios/' . $id_usuario, $data);

        if ($response->successful()) {
            return redirect()->route('usuarios')->with('success', 'Datos actualizados correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al actualizar los datos');
        }
    }
    public function deleteData($id)
    {
        $response = Http::delete('http://localhost:3001/api/usuarios/' . $id);

        if ($response->successful()) {
            return redirect()->route('usuarios')->with('success', 'Usuario eliminado correctamente');
        } else {
            return redirect()->back()->with('error', 'Error al eliminar el usuario');
        }
    }
    public function importExcel(Request $request)
{
    $request->validate([
        'archivo' => 'required|mimes:xlsx,csv'
    ]);

    Excel::import(new UsuariosImport, $request->file('archivo'));

    return redirect()->back()->with('success', 'Usuarios importados exitosamente');
}


public function exportExcel(Request $request)
{
    $buscar = $request->input('buscar');

    $response = Http::get('http://localhost:3001/api/usuarios/');

    if (!$response->successful()) {
        return redirect()->back()->with('error', 'Error al consultar la API');
    }

    $usuarios = collect($response->json());

    // Aplicar filtro si existe búsqueda
    if ($buscar) {
        $usuarios = $usuarios->filter(function ($usuario) use ($buscar) {
            return stripos($usuario['nombre'], $buscar) !== false ||
                   stripos($usuario['email'], $buscar) !== false ||
                   stripos($usuario['telefono'], $buscar) !== false ||
                   stripos($usuario['tipo_usuario'], $buscar) !== false;
        });
    }

    return Excel::download(new UsuariosExport($usuarios), 'usuarios.xlsx');
}
// UsuariosController.php
public function showGraph(Request $request)
{
    $buscar = $request->input('buscar');

    $response = Http::get('http://localhost:3001/api/usuarios/');

    if (!$response->successful()) {
        return redirect()->back()->with('error', 'Error al obtener datos para la gráfica');
    }

    $usuarios = collect($response->json());

    // Aplicar filtro si hay un criterio de búsqueda
    if ($buscar) {
        $usuarios = $usuarios->filter(function ($usuario) use ($buscar) {
            return stripos($usuario['nombre'], $buscar) !== false ||
                   stripos($usuario['email'], $buscar) !== false ||
                   stripos($usuario['telefono'], $buscar) !== false ||
                   stripos($usuario['tipo_usuario'], $buscar) !== false;
        });
    }

    // Contar usuarios por tipo después de filtrar
    $datosGrafica = $usuarios->groupBy('tipo_usuario')->map->count();

    if ($datosGrafica->isEmpty()) {
        return redirect()->back()->with('error', 'No hay datos para mostrar en la gráfica');
    }

    return view('admin.usuarios_grafica', [
        'labels' => json_encode($datosGrafica->keys()->toArray()),
        'data' => json_encode($datosGrafica->values()->toArray()),
        'buscar' => $buscar
    ]);
}
}