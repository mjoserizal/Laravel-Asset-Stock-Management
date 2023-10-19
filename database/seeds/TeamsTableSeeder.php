<?php

use App\Team;
use App\User;
use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'ADARO ENERGY',
            ],
        ];
        Team::insert($users);
    }

}
