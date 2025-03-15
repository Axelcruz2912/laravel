<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class UsuariosExport implements FromCollection, WithHeadings
{
    protected $usuarios;

    public function __construct($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    public function collection()
    {
        return collect($this->usuarios)->map(function ($usuario) {
            return [
                'Nombre' => $usuario['nombre'],
                'Email' => $usuario['email'],
                'Teléfono' => $usuario['telefono'],
                'Tipo de Usuario' => $usuario['tipo_usuario'],
            ];
        });
    }

    public function headings(): array
    {
        return ['Nombre', 'Email', 'Teléfono', 'Tipo de Usuario'];
    }
}
