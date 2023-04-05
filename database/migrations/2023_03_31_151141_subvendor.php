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
        Schema::create('subvendor', function (Blueprint $table){
            $table->id();
            $table->string('client_id')->references('client_id')->on('client')->nullable();
            $table->string('invoice_number')->references('invoice_id')->on('invoice')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank')->nullable();
            $table->string('amount')->nullable();
            $table->string('amount_payable')->nullable();
            $table->string('commission')->nullable();
            $table->string('remarks')->nullable();
            $table->string('captured_by')->references('id')->on('users')->nullable();
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
        //
    }
};
