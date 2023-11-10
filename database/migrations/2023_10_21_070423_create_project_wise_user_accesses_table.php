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
        Schema::create('project_wise_user_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('project_id');
            $table->string('module_id');
            $table->string('role_name');
            $table->string('create');
            $table->string('read');
            $table->string('update');
            $table->string('delete');
            $table->string('status');
            $table->string('default_access');
            $table->string('created_by');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_wise_user_accesses');
    }
};
