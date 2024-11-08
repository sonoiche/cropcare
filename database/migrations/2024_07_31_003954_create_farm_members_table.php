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
        Schema::create('farm_members', function (Blueprint $table) {
            $table->id();
            $table->integer('association_id');
            $table->integer('president_id');
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('provice')->nullable();
            $table->bigInteger('zip_code')->nullable();
            $table->string('barangay')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_members');
    }
};
