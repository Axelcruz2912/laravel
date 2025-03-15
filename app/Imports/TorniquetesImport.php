<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

class TorniquetesImport implements ToCollection
{
  public function collection(Collection $rows)
  {
    foreach($rows as $index => $row){
        if($index == 0) continue;

        Http::post('http://localhost:3001/api/torniquetes', [
            'ubicacion' => $row[0],
            'estado' => $row[1],
            'tipo' => $row[2],
        ]);
    }
  }
}
