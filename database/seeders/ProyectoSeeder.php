<?php

namespace Database\Seeders;

use App\Models\Proyecto;
use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    /**
     * Carga los proyectos iniciales que en la Unidad 1 estaban como datos estáticos.
     */
    public function run(): void
    {
        Proyecto::insert([
            ['nombre' => 'Portal Corporativo',    'fechaInicio' => '2026-03-10', 'estado' => 'En progreso', 'responsable' => 'Camila Rojas',   'monto' => 4500000,  'created_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'App Inventario Bodega', 'fechaInicio' => '2026-04-01', 'estado' => 'Planificado', 'responsable' => 'Diego Muñoz',    'monto' => 7200000,  'created_by' => null, 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Migración ERP',         'fechaInicio' => '2026-01-15', 'estado' => 'Finalizado',  'responsable' => 'Valentina Soto', 'monto' => 12800000, 'created_by' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
