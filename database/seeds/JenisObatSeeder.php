<?php

use App\JenisObat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class JenisObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisobat = [
            [
                'id'             => 1,
                'name'           => 'Cair',
            ],
        ];
        JenisObat::insert($jenisobat);
    }
}

