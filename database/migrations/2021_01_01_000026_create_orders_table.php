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
            $table->id();
            $table->string('code')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('SET NULL');
            $table->integer('sub_price');
            $table->integer('coupon')->nullable();
            $table->integer('fee_ship');
            $table->integer('total_price');
            $table->integer('quantity');
            $table->enum('giveFriend',['true','false'])->default('false');
            $table->enum('type',['Online','Offline'])->default('Online');
            $table->enum('payments',['Online','Tiền mặt'])->default('Tiền mặt');
            $table->string('service_name')->nullable();
            $table->string('delivery_time')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('order_statuses')->onDelete('SET NULL');
            $table->unsignedBigInteger('account_id')->nullable();
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('SET NULL');
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
        Schema::dropIfExists('orders');
    }
}
