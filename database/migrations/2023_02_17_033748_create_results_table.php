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

        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('replicate_id');
            $table->integer('cost');
            $table->json('input');
            $table->string('output')->nullable();
            $table->string('image_url')->nullable();
            $table->string('replicate_status', 50)->nullable();
            $table->timestamp('replicate_created_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->mediumText('error')->nullable();
            $table->string('version')->nullable();
            $table->json('replicate_payload')->nullable();

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
