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
        Schema::create('project_task_times', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_task_id')->constrained()->onDelete('cascade');
            $table->dateTime('started_at');
            $table->dateTime('finished_at');
            $table->boolean('is_billable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_task_times');
    }
};
