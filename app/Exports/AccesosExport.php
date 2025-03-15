<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AccesosExport implements FromCollection, WithHeadings
{
    protected $accesos;

    public function __construct($accesos)
    {
        $this->accesos = $accesos;
    }

    public function collection()
    {
        return $this->accesos->map(function ($acceso) {
            return [
                'Usuario' => $acceso['usuario_nombre'] ?? 'N/A',
                'Ubicación del Torniquete' => $acceso['torniquete_ubicacion'] ?? 'N/A',
                'Estado' => $acceso['estado'] ?? 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Usuario',
            'Ubicación del Torniquete',
            'Estado',
        ];
    }
}
