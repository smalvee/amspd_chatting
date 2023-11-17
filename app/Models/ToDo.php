<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'display_at_task_list_status',
        'project_id',
        'group_id' ,
        'rebuild_view_member_status' ,
        'created_by' ,
        'title_shown_in_task_list',
        'chat_function_status' ,

        'send_notice_mail_status' ,
        'display_after_deadline_expired_status',
        'display_deadline' ,

        'submission_deadline_status' ,

        'submission_deadline',
        'meeting_datetime_status',
        'meeting_datetime' ,
        'place_info',

        'content',
        'attachments',
        'submission_title',
        'display_theme_list_status',

        'presentation_screen_status' ,
        'presentation_screen_content' ,
        'functional_display_frame_prod_status',


        'hide_submission_information_status' ,
        'remark_display_status',
    ];
}
