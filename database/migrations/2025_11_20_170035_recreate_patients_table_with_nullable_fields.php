<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, backup any existing patient data
        $existingPatients = DB::table('patients')->get();
        
        // Drop the existing table
        Schema::dropIfExists('patients');
        
        // Recreate the table with nullable fields
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('hospital_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('set null');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('set null');
        });
        
        // Restore the existing data
        foreach ($existingPatients as $patient) {
            DB::table('patients')->insert([
                'id' => $patient->id,
                'user_id' => $patient->user_id,
                'date_of_birth' => $patient->date_of_birth,
                'gender' => $patient->gender,
                'address' => $patient->address,
                'hospital_id' => $patient->hospital_id,
                'doctor_id' => $patient->doctor_id,
                'created_at' => $patient->created_at,
                'updated_at' => $patient->updated_at,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Backup existing data
        $existingPatients = DB::table('patients')->get();
        
        // Drop table
        Schema::dropIfExists('patients');
        
        // Recreate with original non-nullable structure
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->date('date_of_birth');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->text('address');
            $table->unsignedBigInteger('hospital_id');
            $table->unsignedBigInteger('doctor_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
        
        // Restore data (only complete records)
        foreach ($existingPatients as $patient) {
            if ($patient->date_of_birth && $patient->gender && $patient->address && $patient->hospital_id && $patient->doctor_id) {
                DB::table('patients')->insert([
                    'id' => $patient->id,
                    'user_id' => $patient->user_id,
                    'date_of_birth' => $patient->date_of_birth,
                    'gender' => $patient->gender,
                    'address' => $patient->address,
                    'hospital_id' => $patient->hospital_id,
                    'doctor_id' => $patient->doctor_id,
                    'created_at' => $patient->created_at,
                    'updated_at' => $patient->updated_at,
                ]);
            }
        }
    }
};
