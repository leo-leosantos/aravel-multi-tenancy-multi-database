<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Default',
            'email'=>'default@gmail.com',
            'password'=>bcrypt('123456')
        ]);
    }
}
