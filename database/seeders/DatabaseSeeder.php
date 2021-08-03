<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([ UsersTableSeeder::class ]);
        //親テーブルから上に順に書くので、employeesテーブルのシーダーよりも上に書く
        $this->call([ DepartmentsTableSeeder::class ]);

    }
}
