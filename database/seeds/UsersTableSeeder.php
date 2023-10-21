<?php

use App\User;
use App\JenisObat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'remember_token' => null,
            ],
        ];
        $jenisobat = [
            [
                'id' => 1,
                'name' => 'Cair',
            ],
            [
                'id' => 2,
                'name' => 'Tablet',
            ],
            [
                'id' => 3,
                'name' => 'Caplet',
            ],
            [
                'id' => 4,
                'name' => 'Box',
            ],
        ];
        JenisObat::insert($jenisobat);

        User::insert($users);

    }
}
