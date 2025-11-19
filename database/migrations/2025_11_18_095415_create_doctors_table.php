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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('profile_image')->nullable();
            $table->string('fullname');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->integer('experience');
            $table->unsignedBigInteger('specialization_id');
            $table->unsignedBigInteger('hospital_id');
            $table->unsignedBigInteger('created_by');
            $table->date('joining_date');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
