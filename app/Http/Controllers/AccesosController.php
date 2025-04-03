<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AccesosImport;
use App\Exports\AccesosExport;
use Illuminate\Pagination\LengthAwarePaginator;

class AccesosController extends Controller
{
    public function index(Request $request)
    {
        $search = strtolower($request->input('search', ''));
        $response = Http::get('http://localhost:3001/api/accesos', ['search' => $search]);

        if (!$response->successful()) {
            return redirect()->back()->with('error', 'Error al obtener accesos');
        }

        $accesos = collect($response->json());
        if ($search) {
            $accesos = $accesos->filter(fn($item) =>
                (isset($item['usuario_nombre']) && stripos($item['usuario_nombre'], $search) !== false) ||
                (isset($item['torniquete_ubicacion']) && stripos($item['torniquete_ubicacion'], $search) !== false) ||
                (isset($item['estado']) && stripos($item['estado'], $search) !== false)
            );
        }

        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $accesos->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $accesos = new LengthAwarePaginator($currentItems, $accesos->count(), $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);

        return view('admin.accesos', compact('accesos', 'search'));
    }

    public function show($id)
    {
        $response = Http::get("http://localhost:3001/api/accesos/{$id}");
        if (!$response->successful()) {
            return redirect()->back()->with('error', 'Acceso no encontrado');
        }

        $acceso = $response->json();
        $usuario = Http::get("http://localhost:3001/api/usuarios/{$acceso['id_usuario']}")->json();
        $torniquete = Http::get("http://localhost:3001/api/torniquetes/{$acceso['id_torniquete']}")->json();

        return view('admin.accesos_detalle', compact('acceso', 'usuario', 'torniquete'));
    }

    public function create()
    {
        $usuarios = Cache::remember('usuarios', 3600, fn() => Http::get('http://localhost:3001/api/usuarios')->json() ?? []);
        $torniquetes = Cache::remember('torniquetes', 3600, fn() => Http::get('http://localhost:3001/api/torniquetes')->json() ?? []);

        return view('admin.accesos_crear', compact('usuarios', 'torniquetes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_usuario' => 'required|integer',
            'id_torniquete' => 'required|integer',
            'estado' => 'required|string|in:Permitido,Denegado'
        ]);

        $response = Http::post('http://localhost:3001/api/accesos', $validated);

        if ($response->successful()) {
            Cache::forget('accesos');
            return redirect()->route('accesos')->with('success', 'Acceso creado exitosamente');
        }
        return back()->with('error', 'Error al crear acceso');
    }

    public function edit($id)
    {
        $acceso = Http::get("http://localhost:3001/api/accesos/{$id}")->json();
        $usuarios = Cache::get('usuarios', []);
        $torniquetes = Cache::get('torniquetes', []);

        return view('admin.accesos_editar', compact('acceso', 'usuarios', 'torniquetes'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'id_usuario' => 'sometimes|integer',
            'id_torniquete' => 'sometimes|integer',
            'estado' => 'sometimes|string|in:Permitido,Denegado'
        ]);

        $response = Http::put("http://localhost:3001/api/accesos/{$id}", $validated);
        if ($response->successful()) {
            Cache::forget('accesos');
            return redirect()->route('accesos')->with('success', 'Acceso actualizado correctamente');
        }
        return back()->with('error', 'Error al actualizar acceso');
    }

    public function destroy($id)
    {
        $response = Http::delete("http://localhost:3001/api/accesos/{$id}");
        if ($response->successful()) {
            Cache::forget('accesos');
            return redirect()->route('accesos')->with('success', 'Acceso eliminado correctamente');
        }
        return redirect()->back()->with('error', 'Error al eliminar acceso');
    }

    public function import(Request $request)
    {
        $request->validate(['archivo' => 'required|mimes:xlsx,xls,csv|max:2048']);
        try {
            Excel::import(new AccesosImport, $request->file('archivo'));
            return back()->with('success', 'Archivo importado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al importar accesos: ' . $e->getMessage());
            return back()->with('error', 'Hubo un problema al importar el archivo.');
        }
    }

    public function exportExcel(Request $request)
    {
        try {
            $search = strtolower($request->input('search', ''));
            $response = Http::get('http://localhost:3001/api/accesos');

            if (!$response->successful()) {
                return redirect()->back()->with('error', 'Error al obtener datos de la API');
            }

            $accesos = collect($response->json());

            if ($search) {
                $accesos = $accesos->filter(fn($item) =>
                    stripos($item['usuario_nombre'] ?? '', $search) !== false ||
                    stripos($item['torniquete_ubicacion'] ?? '', $search) !== false ||
                    stripos($item['estado'] ?? '', $search) !== false
                );
            }

            return Excel::download(new AccesosExport($accesos), 'accesos.xlsx');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al exportar: ' . $e->getMessage());
        }
    }
    // AccesosController.php
    public function showGraph(Request $request)
    {
        $search = strtolower($request->input('search', ''));
        $response = Http::get('http://localhost:3001/api/accesos');

        if (!$response->successful()) {
            return redirect()->back()->with('error', 'Error al obtener datos para la gráfica');
        }

        $accesos = collect($response->json());

        // Filtrar si hay un término de búsqueda
        if ($search) {
            $accesos = $accesos->filter(fn($item) =>
                stripos($item['usuario_nombre'] ?? '', $search) !== false ||
                stripos($item['torniquete_ubicacion'] ?? '', $search) !== false ||
                stripos($item['estado'] ?? '', $search) !== false
            );
        }

        // Procesar datos para diferentes gráficas
        $datosEstados = $accesos->groupBy('estado')->map->count();
        $datosTorniquetes = $accesos->groupBy('torniquete_ubicacion')->map->count();

        return view('admin.accesos_grafica', [
            'search' => $search,
            'estadosLabels' => $datosEstados->keys()->toArray(),
            'estadosData' => $datosEstados->values()->toArray(),
            'torniquetesLabels' => $datosTorniquetes->keys()->toArray(),
            'torniquetesData' => $datosTorniquetes->values()->toArray()
        ]);
    }
}
