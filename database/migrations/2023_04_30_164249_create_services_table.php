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
        Schema::create('services', function (Blueprint $table) {
            $table->increments("id");
            $table->text("service");
            $table->float('cost');
            $table->integer(column: "product_id")->unsigned();
            $table
            ->foreign("product_id")
            ->references("id")
            ->on("products")
            ->onUpdate("cascade")
            ->onDelete("cascade");
            $table->integer(column: "employee_id")->unsigned();
            $table
            ->foreign("employee_id")
            ->references("id")
            ->on("employees")
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
        Schema::dropIfExists('services');
    }
};
