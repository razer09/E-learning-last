<?php

use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Video::class)->create([
            'user_id'     =>'1',
            'title'     =>'Learn laravel',
            'thubnail'  =>'/img/laravel.png'
        ]);
        factory(App\Video::class)->create([
            'user_id'     =>'2',
            'title'     =>'Learn Node.js',
            'thubnail'  =>'/img/node.jpg'
        ]);
    }
}
