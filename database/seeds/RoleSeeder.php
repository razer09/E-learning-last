<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Role::class)->create(['name'=>'admin']);
        factory(App\Role::class)->create(['name'=>'manager']);
        factory(App\Role::class)->create(['name'=>'controller']);
        factory(App\Role::class)->create(['name'=>'teacher']);
        factory(App\Role::class)->create(['name'=>'student']);

        factory(App\Ability::class)->create(['name'=>'create_post']);
        factory(App\Ability::class)->create(['name'=>'edit_post']);
        factory(App\Ability::class)->create(['name'=>'sea_report']);
        factory(App\Ability::class)->create(['name'=>'edit_stock']);

    }
}
