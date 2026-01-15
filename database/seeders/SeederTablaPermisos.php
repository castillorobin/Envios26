<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos =[
           //tabla roles
           'ver-rol',
           'crear-rol',
           'editar-rol',
           'borrar-rol',
           //tabla 
           'ver-recolecta',
           'crear-recolecta',
           'editar-recolecta',
           'borrar-recolecta',
        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
    }
}
