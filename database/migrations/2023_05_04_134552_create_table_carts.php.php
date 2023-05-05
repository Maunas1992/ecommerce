<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->string('qty');
            $table->string('color');
            $table->unsignedBigInteger('user_id')
                    ->references('id')
                    ->on('carts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('carts');
            $table->unsignedBigInteger('product_id')
                    ->references('id')
                    ->on('carts')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('carts');
            $table->unsignedBigInteger('category_id')
                    ->references('id')
                    ->on('carts')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('carts');
            $table->float('total_price');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
