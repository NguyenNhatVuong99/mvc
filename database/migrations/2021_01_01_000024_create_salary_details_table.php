<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_details', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('salary_id')->nullable();
            $table->foreign('salary_id')->references('id')->on('salaries')->onDelete('SET NULL');
            $table->unsignedBigInteger('personel_id')->nullable();
            $table->foreign('personel_id')->references('id')->on('personels')->onDelete('SET NULL');
            $table->integer('hour');
            $table->integer('late');
            $table->integer('basic_salary');
            $table->integer('sub_salary');
            $table->integer('advance_salary')->default(0);
            $table->unsignedBigInteger('cashflow_id')->nullable();
            $table->foreign('cashflow_id')->references('id')->on('cashflows')->onDelete('SET NULL');
            $table->integer('bonus_salary')->default(0);
            $table->integer('dedution_salary')->default(0);
            $table->integer('total_salary');
            $table->string('note')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('salary_details');
    }
}
