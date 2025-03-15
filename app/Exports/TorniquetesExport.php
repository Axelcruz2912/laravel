<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Http;


class TorniquetesExport implements FromCollection
{
    protected $torniquetes;

    public function __construct($torniquetes)
    {
        $this->torniquetes = $torniquetes;
    }

    public function collection()
    {
        return collect($this->torniquetes);
    }
}
