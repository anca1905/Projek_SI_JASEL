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
        Schema::create('technicians_applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('province_code');
            $table->string('regency_code');
            $table->string('subdistrict_code');
            $table->string('village_code');
            $table->string('phone_number');
            $table->string('resume_path');
            $table->text('reason');
            $table->enum('status', ['pending', 'ditolak', 'disetujui'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technicians_applications');
    }
};
