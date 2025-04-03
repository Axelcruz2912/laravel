<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TorniquetesImport;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exports\TorniquetesExport;

class TorniquetesController extends Controller
{
    public function getData(Request $request)
    {
        try {
            $response = Http::get('http://localhost:3001/api/torniquetes/');

            if ($response->successful()) {
                $torniquetes = collect($response->json());

                // Aplicar búsqueda si hay un término ingresado
                if ($request->filled('search')) {
                    $search = strtolower($request->search);
                    $torniquetes = $torniquetes->filter(function ($item) use ($search) {
                        return stripos(strtolower($item['ubicacion']), $search) !== false ||
                               stripos(strtolower($item['estado']), $search) !== false ||
                               stripos(strtolower($item['tipo']), $search) !== false;
                    });
                }

                // Paginación
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                $perPage = 5;
                $currentItems = $torniquetes->slice(($currentPage - 1) * $perPage, $perPage)->values();

                $torniquetes = new LengthAwarePaginator($currentItems, $torniquetes->count(), $perPage);
                $torniquetes->setPath(url()->current())->appends($request->query());

                return view('admin.torniquetes', compact('torniquetes'));
            }

            return redirect()->back()->with('error', 'Error al consultar la API');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error inesperado: ' . $e->getMessage());
        }
    }

    public function getData2($id)
    {
        $response = Http::get("http://localhost:3001/api/torniquetes/{$id}");

        if ($response->successful()) {
            $detalle = $response->json();
            return view('admin.torniquetes_detalle', compact('detalle'));
        }

        return redirect()->back()->with('error', 'Torniquete no encontrado');
    }

    public function create()
    {
        return view('admin.torniquetes_crear');
    }

    public function postData(Request $request)
    {
        $data = $request->validate([
            'ubicacion' => 'required|string|max:255',
            'estado' => 'required|string|in:Activo,Inactivo',
            'tipo' => 'required|string|max:100',
        ]);

        try {
            $response = Http::post('http://localhost:3001/api/torniquetes/', $data);

            if ($response->successful()) {
                return redirect()->route('torniquetes')->with('success', 'Torniquete creado correctamente');
            }

            return redirect()->back()->with('error', 'Error al crear el torniquete.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error inesperado: ' . $e->getMessage());
        }
    }

    public function editData($id)
    {
        $response = Http::get("http://localhost:3001/api/torniquetes/{$id}");

        if ($response->successful()) {
            $editar = $response->json();
            return view('admin.torniquetes_editar', compact('editar'));
        }

        return redirect()->back()->with('error', 'Error al consultar la API');
    }

    public function updateData(Request $request, $id)
    {
        $data = $request->validate([
            'ubicacion' => 'sometimes|required|string|max:255',
            'estado' => 'sometimes|required|string|in:Activo,Inactivo',
            'tipo' => 'sometimes|required|string|max:100',
        ]);

        try {
            $response = Http::put("http://localhost:3001/api/torniquetes/{$id}", $data);

            if ($response->successful()) {
                return redirect()->route('torniquetes')->with('success', 'Datos actualizados correctamente');
            }

            return redirect()->back()->with('error', 'Error al actualizar los datos');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error inesperado: ' . $e->getMessage());
        }
    }

    public function deleteData($id)
    {
        try {
            $response = Http::delete("http://localhost:3001/api/torniquetes/{$id}");

            if ($response->successful()) {
                return redirect()->route('torniquetes')->with('success', 'Torniquete eliminado correctamente');
            }

            return redirect()->back()->with('error', 'Error al eliminar el torniquete');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error inesperado: ' . $e->getMessage());
        }
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:xlsx,csv'
        ]);

        try {
            Excel::import(new TorniquetesImport, $request->file('archivo'));
            return redirect()->back()->with('success', 'Torniquetes importados exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al importar archivo: ' . $e->getMessage());
        }
    }

    public function exportExcel(Request $request)
    {
        try {
            $response = Http::get('http://localhost:3001/api/torniquetes/');

            if ($response->successful()) {
                $torniquetes = collect($response->json());

                if ($request->filled('search')) {
                    $search = strtolower($request->search);
                    $torniquetes = $torniquetes->filter(function ($item) use ($search) {
                        return stripos(strtolower($item['ubicacion']), $search) !== false ||
                               stripos(strtolower($item['estado']), $search) !== false ||
                               stripos(strtolower($item['tipo']), $search) !== false;
                    });
                }

                return Excel::download(new TorniquetesExport($torniquetes), 'torniquetes.xlsx');
            }

            return redirect()->back()->with('error', 'Error al consultar la API');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error inesperado: ' . $e->getMessage());
        }
    }

    public function showGraph(Request $request)
    {
        try {
            $buscar = $request->input('buscar');
            $response = Http::get('http://localhost:3001/api/torniquetes/');
    
            if (!$response->successful()) {
                return redirect()->back()->with('error', 'Error al obtener datos para la gráfica');
            }
    
            $torniquetes = collect($response->json());
    
            // Filtrar datos según la búsqueda
            if ($buscar) {
                $torniquetes = $torniquetes->filter(function ($item) use ($buscar) {
                    return stripos(strtolower($item['ubicacion']), $buscar) !== false ||
                           stripos(strtolower($item['estado']), $buscar) !== false ||
                           stripos(strtolower($item['tipo']), $buscar) !== false;
                });
            }
    
            // Preparar datos para la gráfica
            $datosGrafica = $torniquetes->groupBy('estado')->map->count();
    
            return view('admin.torniquetes_grafica', [
                'labels' => json_encode($datosGrafica->keys()->toArray()),
                'data' => json_encode($datosGrafica->values()->toArray()),
                'buscar' => $buscar
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error inesperado: ' . $e->getMessage());
        }
    }
}