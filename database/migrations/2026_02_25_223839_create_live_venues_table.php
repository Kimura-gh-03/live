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
        Schema::create('live_venues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('prefecture');
            $table->unsignedInteger('capacity');
            $table->string('nearest_station');
            $table->string('access');
            $table->string('google_maps_url');
            $table->json('toilet_layout');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('live_venues');
    }
};
