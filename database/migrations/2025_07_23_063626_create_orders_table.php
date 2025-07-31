<?php

use App\Models\Services;
use App\Models\User;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignIdFor(Services::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('teknisi_id');
            $table->foreign('teknisi_id')->references('id')->on('users');
            $table->text('device_problem');
            $table->dateTime('appointment_date')->nullable();
            $table->enum('status', ['pending', 'proses', 'selesai', 'batal'])->default('pending');
            $table->year('finish_time')->default(date('Y'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
