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
        Schema::create('service_employee', function (Blueprint $table) {
            $table->integer(column: "service_id")->unsigned();
            $table
            ->foreign("service_id")
            ->references("id")
            ->on("services")
            ->onUpdate("cascade")
            ->onDelete("cascade");
            $table->integer(column: "employee_id")->unsigned();
            $table
            ->foreign("employee_id")
            ->references("id")
            ->on("employees")
            ->onUpdate("cascade")
            ->onDelete("cascade");
            $table->primary(['service_id', 'employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_employee');
    }
};
