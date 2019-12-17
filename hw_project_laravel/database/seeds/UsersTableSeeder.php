<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\User::updateOrCreate([
            'first_name'=>'Test',
            'last_name'=>'Test',
            'email'=>'test@test.com',
            'password'=>bcrypt('12345678'),
        ]);
    }
}
