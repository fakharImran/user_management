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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->date('dob');
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('relation')->nullable();
            $table->string('passport_photo');
            $table->json('illness')->nullable();
            $table->string('address')->nullable();
            $table->string('recommended_source');
            $table->string('recommended_source_address');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
