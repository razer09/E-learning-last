<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('title');
            $table->text('excerpt')->default('');
            $table->text('description');
            $table->string('thubnail');
            $table->integer('old_price');
            $table->double('price', 15, 8);
            $table->timestamps();
        });

        // tags [0.*] <=> [0.*] courses
        Schema::create('course_tag', function (Blueprint $table) {
            $table->primary(['tag_id', 'course_id']);
            $table->foreignId('tag_id')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreignId('course_id')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
        });

        // tags [0.*] <=> [0.*] courses
        Schema::create('enrolled_course', function (Blueprint $table) {
            $table->primary(['user_id', 'course_id']);
            $table->foreignId('user_id')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->foreignId('course_id')
                    ->constrained()
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
        Schema::dropIfExists('course_tag');
        Schema::dropIfExists('enrolled_course');
    }
}
