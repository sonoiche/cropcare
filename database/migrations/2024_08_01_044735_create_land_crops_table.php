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
        Schema::create('land_crops', function (Blueprint $table) {
            $table->id();
            $table->integer('farmer_id');
            $table->integer('association_id')->nullable();
            $table->string('location')->nullable();
            $table->bigInteger('lat')->nullable();
            $table->bigInteger('lng')->nullable();
            $table->enum('status', ['Available','Owned'])->nullable();
            $table->string('crop_name')->nullable();
            $table->bigInteger('crop_count')->nullable();
            $table->string('crop_yield')->nullable();
            $table->string('acres')->nullable();
            $table->enum('bill_type', ['For Lease', 'For Sale'])->nullable();
            $table->decimal('acre_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_crops');
    }
};
