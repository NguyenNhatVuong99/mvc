<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceListFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_list_formats', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('price_list_id')->nullable();
            $table->foreign('price_list_id')->references('id')->on('price_lists')->onDelete('SET NULL');
            $table->enum('parent_price',['cost_price','now_price'])->default('cost_price');
            $table->enum('calculation',['add','sub','mul'])->default('add');
            $table->integer('value')->default(0);
            $table->enum('type',['person','cash'])->default('person');
            $table->enum('category_product',['all','category'])->default('all');
            $table->boolean('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('price_list_formats');
    }
}
