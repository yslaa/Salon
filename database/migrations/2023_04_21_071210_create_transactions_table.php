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
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('Status', ['Processing', 'Delivered', 'Cancel']);
            $table->date('date_placed');
            $table->integer(column: "customer_id")->unsigned();
            $table
            ->foreign("customer_id")
            ->references("id")
            ->on("customers")
            ->onUpdate("cascade")
            ->onDelete("cascade");
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
        Schema::dropIfExists('transactions');
    }
};
