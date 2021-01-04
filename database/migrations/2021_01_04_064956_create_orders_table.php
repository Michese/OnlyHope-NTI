<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->integer('status_id')
                ->nullable(false)
                ->unsigned()
                ->default(1);
            $table->bigInteger('user_id')
                ->nullable(false)
                ->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('status_id')
                ->references('status_id')
                ->on('statuses');
            $table->foreign('user_id')
                ->references('user_id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('orders');
    }
}
