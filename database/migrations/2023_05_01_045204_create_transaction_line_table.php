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
        Schema::create('transaction_line', function (Blueprint $table) {
            $table->integer(column: "transaction_id")->unsigned();
            $table
            ->foreign("transaction_id")
            ->references("id")
            ->on("transactions")
            ->onUpdate("cascade")
            ->onDelete("cascade");
            $table->integer(column: "service_id")->unsigned();
            $table
            ->foreign("service_id")
            ->references("id")
            ->on("services")
            ->onUpdate("cascade")
            ->onDelete("cascade");
            $table->primary(['transaction_id', 'service_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_line');
    }
};
