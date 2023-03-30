<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments("id");
            $table->integer(column: "user_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table
            ->foreign("user_id")
            ->references("id")
            ->on("users")
            ->onUpdate("cascade")
            ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
