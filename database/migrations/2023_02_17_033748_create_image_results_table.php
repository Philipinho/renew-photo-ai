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
            $table->integer('cost');
            $table->string('replicate_id');
            $table->string('url');
            $table->string('input_image_url')->nullable();
            $table->string('output_image_url')->nullable();
            $table->mediumText('error')->nullable();
            $table->string('version')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->string('predict_time', 50)->nullable();
            $table->string('status', 50)->nullable();
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
