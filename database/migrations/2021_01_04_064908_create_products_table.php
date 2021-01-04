<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('title', 25)
                ->unique()
                ->nullable(false);
            $table->string('description');
            $table->string('src', 255)
                ->nullable(false)
                ->default('http://via.placeholder.com/300');
            $table->boolean('stock')
                ->nullable(false)
                ->default(false);
            $table->decimal('price', 8, 2, true)
                ->nullable(false);
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
        Schema::dropIfExists('products');
    }
}
