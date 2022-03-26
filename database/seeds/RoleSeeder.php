<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'admin',
            'description' => 'Perfil de administrador',
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['name' => 'almacen',
            'description' => 'Perfil de almacen',
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['name' => 'calidad',
            'description' => 'Perfil de calidad',
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['name' => 'operaciones',
            'description' => 'Perfil de operaciones',
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['name' => 'compras',
            'description' => 'Perfil de compras',
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['name' => 'direccion',
            'description' => 'Perfil de direccion',
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['name' => 'finanzas',
            'description' => 'Perfil de finanzas',
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['name' => 'ingenieria',
            'description' => 'Perfil de ingenieria',
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['name' => 'manufactura',
            'description' => 'Perfil de manufactura',
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['name' => 'rh',
            'description' => 'Perfil de recursos humanos',
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['name' => 'ventas',
            'description' => 'Perfil de ventas',
            'created_at' => now(), 
            'updated_at' => now()
            ],
            ['name' => 'servicio',
            'description' => 'Perfil de servicio',
            'created_at' => now(), 
            'updated_at' => now()
            ],
            
        ]);
    }
}
