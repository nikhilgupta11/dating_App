<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name', 50);
            $table->string('mobile', 16)->unique()->nullable();
            $table->integer('otp')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender', 12)->nullable();
            $table->tinyInteger('sexual_orientation')->default('0')->nullable();
            $table->string('gender_filter')->nullable();
            $table->text('user_gallery')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->integer('type')->default(0);
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->tinyInteger('term_condition')->default(1);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
};
