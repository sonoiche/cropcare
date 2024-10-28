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
        Schema::create('consultations', function (Blueprint $table) {
            $table->id();
            $table->integer('president_id');
            $table->integer('agriculture_id')->nullable();
            $table->string('farmer_fullname');
            $table->string('title')->nullable();
            $table->text('concern')->nullable();
            $table->string('location')->nullable();
            $table->enum('status', ['Submitted', 'Under Review', 'Resolve'])->nullable();
            $table->dateTime('schedule')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultations');
    }
};
