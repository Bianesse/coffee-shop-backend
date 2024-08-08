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
        Schema::table('coffees', function (Blueprint $table) {
            $table->string('image')->after('description')->nullable(true);
            $table->float('rate')->after('image');
            $table->string('review')->after('rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('coffees', function (Blueprint $table) {
            //
        });
    }
};
