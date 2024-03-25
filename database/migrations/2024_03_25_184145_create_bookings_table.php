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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guide_id');
            $table->foreign('guide_id')->references('id')->on('guides');
            $table->unsignedBigInteger('tourist_id');
            $table->foreign('tourist_id')->references('id')->on('tourists');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
