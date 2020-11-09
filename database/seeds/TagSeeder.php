<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tag::class)->create(['name'=>'laravel']);
        factory(App\Tag::class)->create(['name'=>'nodeJs']);
        factory(App\Tag::class)->create(['name'=>'java']);
        factory(App\Tag::class)->create(['name'=>'Photoshop']);
        factory(App\Tag::class)->create(['name'=>'Laptop']);
        factory(App\Tag::class)->create(['name'=>'Keyboard']);
        factory(App\Tag::class)->create(['name'=>'Gulp.js']);
        factory(App\Tag::class)->create(['name'=>'Programation']);
    }
}
