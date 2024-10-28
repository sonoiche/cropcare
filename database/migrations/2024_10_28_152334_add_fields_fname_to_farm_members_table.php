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
        Schema::table('farm_members', function (Blueprint $table) {
            $table->string('fname')->after('fullname')->nullable();
            $table->string('mname')->after('fname')->nullable();
            $table->string('lname')->after('mname')->nullable();
            $table->string('suffix')->after('lname')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('farm_members', function (Blueprint $table) {
            $table->dropColumn('fname');
            $table->dropColumn('mname');
            $table->dropColumn('lname');
            $table->dropColumn('suffix');
        });
    }
};
