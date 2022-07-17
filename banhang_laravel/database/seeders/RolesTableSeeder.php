<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Roles::truncate();
        DB::table('roles')->truncate();
        DB::table('roles')->insert(['name'=>'admin']);
        DB::table('roles')->insert(['name'=>'author']);
        DB::table('roles')->insert(['name'=>'user']);


    }
}
