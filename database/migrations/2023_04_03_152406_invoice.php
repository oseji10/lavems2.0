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
        Schema::create('invoice', function (Blueprint $table){
            $table->id();
            $table->string('invoice_number')->nullable();
            $table->string('client_id')->nullable();
            $table->string('equipment_serial_number')->nullable();
            $table->string('equipment')->nullable();
            $table->string('quantity')->nullable();
            $table->string('cost')->nullable();
            // $table->string('invoiced_by')->nullable();
            $table->string('created_binvoiced_byy')->references('id')->on('users')->nullable();
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
