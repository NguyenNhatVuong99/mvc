<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_stocks', function (Blueprint $table) {
            $table->id('id');
            $table->string('code')->nullable();
            $table->string('document_code')->nullable();
            $table->dateTime('document_date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('child_cat_id')->nullable();
            $table->foreign('cat_id')->references('id')->on('receipt_categories')->onDelete('SET NULL');
            $table->foreign('child_cat_id')->references('id')->on('receipt_categories')->onDelete('SET NULL');
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('CASCADE');
            $table->string('partner_code');
            $table->integer('quantity');
            $table->integer('total');
            $table->integer('payment');
            $table->integer('debt')->nullable();

            $table->string('note')->nullable();
            $table->date('date_import')->nullable();
            $table->date('date_delivery')->nullable();
            $table->boolean('isReceive')->default(0);
            $table->enum('status',['Hoàn thành','Đang xử lý'])->default('Đang xử lý');
            $table->enum('isPayment',['Hoàn thành','Nợ'])->default('Hoàn thành');
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
        Schema::dropIfExists('receipt_stocks');
    }
}
