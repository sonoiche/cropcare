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
        Schema::create('geographics', function (Blueprint $table) {
            $table->id();
            $table->integer('president_id');
            $table->integer('association_id');
            $table->integer('farmer_id')->nullable();
            $table->integer('consultation_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('location')->nullable();
            $table->text('remarks')->nullable();
            $table->text('consultation')->nullable();
            $table->string('crop_name')->nullable();
            $table->bigInteger('crop_count')->nullable();
            $table->bigInteger('crop_yield')->nullable();
            $table->enum('status', ['Available','Owned'])->nullable();
            $table->enum('consultaion_status', ['Pending','Resolved'])->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geographics');
    }
};
