<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;


class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'id' => '1',
            'name' => 'manager',
            'email' => 'manager@test',
            'password' => bcrypt('password'),
            'role' => 1,
        ];
        Teacher::create($param);

        $param = [
            'id' => '2',
            'name' => 'teacher1',
            'email' => 'teacher@test',
            'password' => bcrypt('password'),
            'role' => 2,
        ];
        Teacher::create($param);
    }
}
