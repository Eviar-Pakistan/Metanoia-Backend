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
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('license_number')->unique();
            $table->date('established_date');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->string('postal_code');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('manager_id')->references('id')->on('managers')->onDelete('set null');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
