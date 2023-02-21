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

        Schema::create('image_results', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('user_id')->nullable();
            $table->string('input_image_url')->nullable();
            $table->string('processed_image_url')->nullable();
            $table->integer('cost');
            $table->string('replicate_id');
            $table->json('replicate_input')->nullable();
            $table->string('replicate_output')->nullable();
            $table->string('replicate_status', 50)->nullable();
            $table->mediumText('replicate_error')->nullable();
            $table->timestamp('replicate_started_at')->nullable();
            $table->timestamp('replicate_completed_at')->nullable();
            $table->string('status', 50)->nullable();
            $table->string('version')->nullable();

            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replicate_jobs');
    }
};
