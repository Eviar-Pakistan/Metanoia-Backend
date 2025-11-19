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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->integer('status');  
            $table->integer('android_version')->nullable();
            $table->string('client_app_version')->nullable();
            $table->string('arborxr_home_version')->nullable();
            $table->string('storage_used')->nullable();
            $table->string('battery')->nullable();
            $table->string('ssid')->nullable();
            $table->string('signal_strength')->nullable();
            $table->string('frequency')->nullable();
            $table->string('link_speed')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('mac_address')->nullable();
            $table->string('randomize_mac_address')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
