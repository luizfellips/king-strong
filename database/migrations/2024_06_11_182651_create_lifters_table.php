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
        Schema::create('lifters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('years_of_lifting')->nullable();
            $table->char('gender')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lifters');
    }
};
