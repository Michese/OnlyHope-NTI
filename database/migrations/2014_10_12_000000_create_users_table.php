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
            $table->bigIncrements('user_id');
            $table->string('first_name')
                ->nullable(false);
            $table->string('last_name')
                ->nullable(false);
            $table->string('email')
                ->nullable(false)
                ->unique();
            $table->bigInteger('phone')
                ->nullable(true);
            $table->string('src', 255)
                ->nullable(false)
                ->default('http://via.placeholder.com/300');
            $table->timestamp('email_verified_at')
                ->nullable();
            $table->string('password')
                ->nullable(false);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
