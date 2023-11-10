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
        Schema::create('to_dos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->nullable();
            $table->foreignId('group_id')->nullable();
            $table->string('display_at_task_list_status')->nullable();// Active/Inactive
            $table->string('rebuild_view_member_status')->nullable();// Active/Inactive
            $table->foreignId('created_by')->nullable();
            $table->string('title_shown_in_task_list')->nullable();
            $table->string('chat_function_status')->nullable();// Active/Inactive
            $table->string('send_notice_mail_status')->nullable();// Active/Inactive
            $table->string('display_after_deadline_expired_status')->nullable();// Active/Inactive
            $table->dateTime('display_deadline')->nullable();// Date Time
            $table->string('submission_deadline_status')->nullable();// Active/Inactive
            $table->dateTime('submission_deadline')->nullable();// Date Time
            $table->string('meeting_datetime_status')->nullable();// Active/Inactive
            $table->dateTime('meeting_datetime')->nullable();// Date Time
            $table->longText('place_info')->nullable();// Place info. shown in Task List
            $table->string('sub_title')->nullable();
            $table->longText('content')->nullable();
            $table->json('attachments')->nullable();
            $table->string('submission_title')->nullable();//Title of submission page
            $table->string('display_theme_list_status')->nullable();// Active/Inactive
            $table->string('presentation_screen_status')->nullable();// Active/Inactive
            $table->longText('presentation_screen_content')->nullable();
            $table->string('functional_display_frame_prod_status')->nullable();// Active/Inactive
            $table->string('hide_submission_information_status')->nullable();// Active/Inactive
            $table->longText('signature')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('to_dos');
    }
};
