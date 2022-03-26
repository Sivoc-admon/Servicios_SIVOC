<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([
            'name' => 'Francisco',
            'last_name' => 'Gil',
            'mother_last_name' => 'Sanchez',
            'email' => 'jfgils02@gmail.com',
            'password' => Hash::make('123456'),
            'area_id' => '5',
            'grade' => 'Licenciatura',
            'profession' => 'Ingeniero',
            'street' => 'Huichapan',
            'telefono' => '1245788956',
            'contacto' => '1245788956',
            'created_at' => date('Y-m-d H:m:s'), 
            'updated_at' => date('Y-m-d H:m:s')
        ]);

    }
}
