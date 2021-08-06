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
        //departmentsテーブルが親テーブルです。親から上に順に書くので、employeesテーブルのシーダーよりも上に書く
        $this->call([ DepartmentsTableSeeder::class ]);
        // photos は親テーブルです 子テーブルはemployeesテーブルです
        $this->call( [PhotosTableSeeder::class] );
    }
}
