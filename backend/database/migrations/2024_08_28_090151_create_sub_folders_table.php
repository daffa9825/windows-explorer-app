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
        Schema::create('sub_folders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('folder_id')->index()->nullable();
            $table->string('name')->index();
            $table->string('type');
            $table->string('size')->nullable();
            $table->timestamps();
            $table->foreign('folder_id')->references('id')->on('parent_folders')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_folders');
    }
};
