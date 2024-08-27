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
            $table->decimal('rate')->after('image')->default(0);
            $table->bigInteger('rate_total')->after('rate')->default(0);
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
