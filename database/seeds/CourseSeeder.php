<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Course::class)->create([
            'user_id'     =>'1',
            'title'     =>'Learn laravel',
            'thubnail'  =>'/img/laravel.png'
        ]);
        factory(App\Course::class)->create([
            'user_id'     =>'2',
            'title'     =>'Learn Node.js',
            'thubnail'  =>'/img/node.jpg'
        ]);
        factory(App\Course::class)->create([
            'user_id'     =>'2',
            'title'     =>'Learn Vue.js',
            'thubnail'  =>'/img/vue.jpg'
        ]);
        factory(App\Course::class)->create([
            'user_id'     =>'3',
            'title'     =>'Learn laravel',
            'thubnail'  =>'/img/laravel.png'
        ]);
        factory(App\Course::class)->create([
            'user_id'     =>'4',
            'title'     =>'Master Vue.js Deeply',
            'thubnail'  =>'/img/vue2.jpg'
        ]);
        factory(App\Course::class)->create([
            'user_id'     =>'2',
            'title'     =>'Learn Node.js',
            'thubnail'  =>'/img/node.jpg'
        ]);
        factory(App\Course::class)->create([
            'user_id'     =>'2',
            'title'     =>'Learn Vue.js',
            'thubnail'  =>'/img/vue.jpg'
        ]);
        factory(App\Course::class)->create([
            'user_id'     =>'3',
            'title'     =>'Learn laravel',
            'thubnail'  =>'/img/laravel.png'
        ]);
    }
}
