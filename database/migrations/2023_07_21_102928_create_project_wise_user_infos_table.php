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
        Schema::create('project_wise_user_infos', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable();
            $table->string('role')->nullable();
            $table->foreignId('project_id');
            $table->foreignId('user_id');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_wise_user_infos');
    }
};
