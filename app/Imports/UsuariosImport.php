<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class UsuariosImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index === 0) continue;

            Http::post('http://localhost:3001/api/usuarios', [
                'nombre'       => $row[0],
                'email'        => $row[1],
                'password'     => bcrypt($row[2]),
                'telefono'     => $row[3],
                'tipo_usuario' => $row[4],
            ]);
        }
    }
}
