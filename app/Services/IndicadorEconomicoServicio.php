<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IndicadorEconomicoServicio
{
    private const URL_API = 'https://mindicador.cl/api/uf';
    private const MINUTOS_CACHE = 60;

    /**
     * Obtiene el valor de la UF del día desde un servicio externo.
     * Si el servicio no responde, entrega un valor de respaldo.
     */
    public function obtenerUfDelDia(): array
    {
        return Cache::remember('uf_del_dia', now()->addMinutes(self::MINUTOS_CACHE), function () {
            try {
                $respuesta = Http::timeout(5)->get(self::URL_API);

                if ($respuesta->successful()) {
                    $datos = $respuesta->json();

                    return [
                        'valor'  => $datos['serie'][0]['valor'],
                        'fecha'  => $datos['serie'][0]['fecha'],
                        'origen' => 'mindicador.cl',
                    ];
                }
            } catch (\Throwable $e) {
                Log::warning('No se pudo consultar la UF: '.$e->getMessage());
            }

            return [
                'valor'  => 39250.00,
                'fecha'  => now()->toIso8601String(),
                'origen' => 'valor de respaldo',
            ];
        });
    }
}
