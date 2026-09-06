<?php

namespace App\View\Components;

use App\Services\IndicadorEconomicoServicio;
use Illuminate\View\Component;
use Illuminate\View\View;

class ValorUf extends Component
{
    public function __construct(
        private IndicadorEconomicoServicio $indicadorServicio,
        public string $titulo = 'Valor UF de hoy',
    ) {}

    public function render(): View
    {
        return view('components.valor-uf', [
            'uf' => $this->indicadorServicio->obtenerUfDelDia(),
        ]);
    }
}
