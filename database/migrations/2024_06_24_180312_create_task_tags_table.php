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
        Schema::create('task_tags', function (Blueprint $table) {
            $table->id()->primary();
            $table->foreignUuid('task_id')->references('id')->on('tasks')->cascadeOnDelete();
            $table->foreignUuid('tag_id')->references('id')->on('tags')->cascadeOnDelete();
            $table->unique(['task_id', 'tag_id'])->cascadeOnDelete();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_tags');
    }
};
