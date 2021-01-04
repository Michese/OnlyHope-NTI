<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->bigInteger('order_id')
                ->nullable(false)
                ->unsigned();
            $table->bigInteger('product_id')
                ->nullable(false)
                ->unsigned();
            $table->integer('quantity')
                ->nullable(false)
                ->unsigned()
                ->default(1);
            $table->foreign('order_id')
                ->references('order_id')
                ->on('orders');
            $table->foreign('product_id')
                ->references('product_id')
                ->on('products');
            $table->primary(['order_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('order_product');
    }
}
