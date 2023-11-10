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
        Schema::create('node_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('node_id');
            $table->string('name'); //fms, cam, control, robot, ftp_cam
            $table->string('data_table_name')->nullable(); // example: tbl_cam_photo_2000012
            $table->string('note')->nullable(); //cam => take picture
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('node_features');
    }
};
