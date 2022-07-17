<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->truncate();
        DB::table('admin_roles')->truncate();
        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();

        $admin = DB::table('admin')->insert([
            'admin_email' => 'charlenee282@gmail.com',
            'admin_password' => md5('21022000'),
            'admin_name' => 'Vinh',
            'admin_phone' => '0917138144',
        ]);
        $author = DB::table('admin')->insert([
            'admin_email' => 'author@gmail.com',
            'admin_password' => md5('123456'),
            'admin_name' => 'Vinh Author',
            'admin_phone' => '0963256412',
        ]);
        $user = DB::table('admin')->insert([
            'admin_email' => 'user@gmail.com',
            'admin_password' => md5('123123'),
            'admin_name' => 'Vinh User',
            'admin_phone' => '0963265987',
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);

    }
}
