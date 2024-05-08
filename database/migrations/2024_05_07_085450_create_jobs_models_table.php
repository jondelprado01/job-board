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
        Schema::create('jobs_models', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company')->default('mrge');
            $table->text('description', 60000);
            $table->string('location');
            $table->string('type');
            $table->text('qualification', 60000);
            $table->string('status')->default('Pending');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs_models');
    }
};
