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
        Schema::create('guides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('phone')->unique();
            $table->string('address');
            $table->string('location')->nullable();
            $table->string('about')->nullable();
            $table->string('national_id');
            $table->enum('status',['active','deactive','pending'])->default('pending')->comment('active, pending, approved, rejected');
            $table->string('languages')->nullable();
            $table->string('avg_rating')->default(0);
            $table->string('rate')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guides');
    }
};
