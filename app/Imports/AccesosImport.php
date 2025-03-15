<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class AccesosImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index == 0) continue; 

            Http::post('http://localhost:3001/api/accesos', [
                'id_usuario' => $row[0],
                'id_torniquete' => $row[1],
                'fecha_hora' => $row[2],
                'estado' => $row[3],
            ]);
        }
    }
}
