<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate = ['users', 'tags', 'courses', 'roles', 'abilities'];

    public function run()
    {
        foreach ($this->toTruncate as $value) {
            DB::table($value)->delete();
        }

        $this->call(UserSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CourseSeeder::class);
    }
}
