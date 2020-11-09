<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->create([
            'name'      =>'acil',
            'email'     =>'benkheddaacile@gmail.com',
            'password'  =>Hash::make('yesweCAN2017')
        ]);
        factory(App\User::class)->create([
            'name'      =>'kamale',
            'email'     =>'kamele@gmail.com',
            'password'  =>Hash::make('yesweCAN2017')
        ]);
        factory(App\User::class, 4)->create();
    }
}
