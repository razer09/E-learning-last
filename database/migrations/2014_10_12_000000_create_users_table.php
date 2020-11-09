<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('dark_mode')->default(false);
            $table->boolean('full_screen')->default(false);
            $table->string('first_color')->default('#0B5BF1');
            $table->string('second_color')->default('#F9A826');
            $table->integer('font_size')->default('14');
            $table->string('language')->default('english');
            $table->string('thubnail');
            $table->string('facebook')->default('exemple');
            $table->string('twitter')->default('exemple');
            $table->string('instagram')->default('exemple');
            $table->string('website')->default('exemple.com');
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
        Schema::dropIfExists('users');
    }
}
