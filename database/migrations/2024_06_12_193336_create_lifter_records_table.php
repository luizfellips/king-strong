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
        Schema::create('lifter_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lifter_id');
            $table->unsignedBigInteger('compound_id');
            $table->integer('one_rep_max')->nullable();
            $table->integer('compound_total')->nullable();
            $table->integer('reps')->nullable();
            $table->integer('reps_in_reserve')->nullable();
            $table->string('training_level')->nullable();

            $table->timestamps();

            $table->foreign('compound_id')->references('id')->on('compounds')->onDelete('cascade');
            $table->foreign('lifter_id')->references('id')->on('lifters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lifter_records');
    }
};
