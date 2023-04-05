<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EQUIPESeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('EQUIPE')->delete();
        DB::table('EQUIPE')->insert([
            'idequipe' => 1,
            'nom' => 'KCORP'
            
        ]);
    }
}
