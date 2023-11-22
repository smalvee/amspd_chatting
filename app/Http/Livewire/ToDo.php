<?php

namespace App\Http\Livewire;

use App\Models\ProjectWiseUserAccess;
use App\Models\ProjectWiseUserInfo;
use App\Models\SubmitTodo;
use App\Models\TaskGroup;
use App\Models\ToDo as ModelsToDo;
use App\Models\ToDoCategory;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ToDo extends Component
{
    use WithFileUploads;

    public $search, $group_id, $date, $attachments = [],
        $display_at_task_list_status,
        $rebuild_view_member_status,
        $created_by,
        $title_shown_in_task_list,
        $chat_function_status,
        $send_notice_mail_status,
        $display_after_deadline_expired_status,
        $display_deadline,
        $submission_deadline_status,
        $submission_deadline,
        $meeting_datetime_status,
        $meeting_datetime,
        $place_info,
        $sub_title,
        $content,
        $submission_title,
        $display_theme_list_status,
        $presentation_screen_status,
        $presentation_screen_content,
        $functional_display_frame_prod_status,
        $hide_submission_information_status,
        $remark_display_status,
        $inputArray = [],
        $signature,
        $to_do_id,
        $progress,
        $progressinput;


    public $project;
    public function mount()
    {
        $this->project = app()->get('s_active_project');
    }

    public function render()
    {

        // Alvee Code Start
        // dd(123);




        $access = NULL;

        $access_permission = Auth::user()->type ?? null;


        if ($access_permission == 'User' || $access_permission == 'Admin') {
            $access = ProjectWiseUserAccess::where('user_id', Auth::user()->id)->where('project_id', $this->project->id)->where('status', 1)->where('read', 1)->first();
            if ($access == NULL) {
                $access = null;
            }

            // $tas = TaskGroup::where('project_id', $this->project->id)->get()->pluck('project_wise_user_info_ids', Auth::user()->id)->pluck('id');

            // $tas = TaskGroup::where('project_id', $this->project->id)
            //     ->whereJsonContains('project_wise_user_info_ids', Auth::user()->id)
            //     ->select('id', 'name', 'project_wise_user_info_ids')
            //     ->get();

            $tas = TaskGroup::join('task_group_wise_user_lists', 'task_groups.id', '=', 'task_group_wise_user_lists.task_group_id')
                ->select('task_groups.id', 'task_groups.name')
                ->where('task_group_wise_user_lists.user_id', Auth::user()->id)
                ->where('task_group_wise_user_lists.project_id', $this->project->id)
                ->where('task_group_wise_user_lists.status', 1)
                ->get();
        }


        if ($access_permission == 'Super Admin' || $access_permission == 'Admin') {
            $tas = TaskGroup::where('project_id', $this->project->id)->get();
        }







        // else {
        //     $tas = TaskGroup::where('project_id', $this->project->id)->get();
        // }

        $data = [
            'todos' => ModelsToDo::where('project_id', $this->project->id)->when($this->search, function ($q) {
                $q->where('name', 'LIKE', "%$this->search%");
            })->get(),
            'task_groups_view' => $tas,
            'task_groups' => TaskGroup::where('project_id', $this->project->id)->get(),
            'project_users' => ProjectWiseUserInfo::where('project_id', $this->project->id)->get(),
            'access' => $access,
            'access_permission' => $access_permission

        ];

        return view('livewire.to-do', $data)->extends('layouts.app');
    }





    public function removeAttachment($index)
    {
        unset($this->attachments[$index]);
        $this->attachments = array_values($this->attachments);
    }

    // public function addToArray()
    // {
    //     $this->inputArray[] = '';
    // }

    public function submit()
    {
        $validated_data = $this->validate([

            'display_at_task_list_status' => 'nullable',
            'group_id' => 'required',
            'rebuild_view_member_status' => 'nullable',
            'created_by' => 'nullable',
            'title_shown_in_task_list' => 'required',
            'chat_function_status' => 'nullable',

            'send_notice_mail_status' => 'nullable',
            'display_after_deadline_expired_status' => 'nullable',
            'display_deadline' => 'nullable',

            'submission_deadline_status' => 'nullable',

            'submission_deadline' => 'nullable',
            'meeting_datetime_status' => 'nullable',
            'meeting_datetime' => 'nullable',
            'place_info' => 'nullable',

            'content' => 'nullable',
            'attachments' => 'max:10240',
            'submission_title' => 'nullable',
            'display_theme_list_status' => 'nullable',

            'presentation_screen_status' => 'nullable',
            'presentation_screen_content' => 'nullable',
            'functional_display_frame_prod_status' => 'nullable',


            'hide_submission_information_status' => 'nullable',
            // 'remark_display_status' => 'nullable',



        ]);
        // dd($validated_data);

        // ModelsToDo::create($validated_data);

        // $attached_file =  $this->attachments;

        // $targetDirectory = "../storage/app/public/file/"; // Specify your target directory
        // $randomNumber = rand(100000, 999999);


        // $attachments_originalFileName = basename($_FILES["attachments"]["name"]);
        // $attachments_fileExtension = pathinfo($attachments_originalFileName, PATHINFO_EXTENSION);
        // $attachments_newFileName = $randomNumber . '.' . $attachments_fileExtension;
        // $attachments_targetFilePath = $targetDirectory . $attachments_newFileName;
        // move_uploaded_file($_FILES["attachments"]["tmp_name"], $attachments_targetFilePath);


        // $filePath = $this->attachments->store('../storage/app/public/file/');

        // foreach ($this->attachments as $attachment) {
        //     $randomNumber = rand(100000, 999999);
        //     $attachments_newFileName = $randomNumber . '.' . $attachment->getClientOriginalExtension();

        //     // Store the uploaded file in the storage directory
        //     $path = $attachment->storeAs('public/file', $attachments_newFileName);

        // }





        $uploadedFileNames = [];

        foreach ($this->attachments as $attachment) {
            $randomNumber = rand(100000, 999999);
            $attachments_newFileName = $randomNumber . '.' . pathinfo($attachment->getClientOriginalName(), PATHINFO_EXTENSION);

            // Store the uploaded file in the storage directory
            $path = Storage::putFileAs('public/file', $attachment, $attachments_newFileName);

            // Add the file name to the list
            $uploadedFileNames[] = $path;
        }

        // Convert the array of file names to JSON
        $jsonFileNames = json_encode($uploadedFileNames);








        ModelsToDo::create([
            // 'date_column_name' => $this->date,

            'display_at_task_list_status' => $this->display_at_task_list_status,
            'project_id' => $this->project->id,
            'group_id' => $this->group_id,
            'rebuild_view_member_status' => $this->rebuild_view_member_status,
            'created_by' => $this->created_by,
            'title_shown_in_task_list' => $this->title_shown_in_task_list,
            'chat_function_status' => $this->chat_function_status,

            'send_notice_mail_status' => $this->send_notice_mail_status,
            'display_after_deadline_expired_status' => $this->display_after_deadline_expired_status,
            'display_deadline' => $this->display_deadline,

            'submission_deadline_status' => $this->submission_deadline_status,

            'submission_deadline' => $this->submission_deadline,
            'meeting_datetime_status' => $this->meeting_datetime_status,
            'meeting_datetime' => $this->meeting_datetime,
            'place_info' => $this->place_info,

            'content' => $this->content,
            'attachments' => $jsonFileNames,
            'submission_title' => $this->submission_title,
            'display_theme_list_status' => $this->display_theme_list_status,

            'presentation_screen_status' => $this->presentation_screen_status,
            'presentation_screen_content' => $this->presentation_screen_content,
            'functional_display_frame_prod_status' => $this->functional_display_frame_prod_status,


            'hide_submission_information_status' => $this->hide_submission_information_status,
            // 'remark_display_status'=> $this->remark_display_status,
        ]);


        // if($this->send_notice_mail_status){
        //     $user->notify(new Invite($user, $this->project_id));
        // }



        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully created !']);
    }


    public function Edit_modal(int $to_do_id)
    {
        // dd($to_do_id);
        $todo_details = ModelsToDo::findOrFail($to_do_id);



        if ($todo_details) {

            $this->to_do_id = $todo_details->id;


            $this->display_at_task_list_status = $todo_details->display_at_task_list_status;

            $this->group_id = $todo_details->group_id;
            $this->rebuild_view_member_status = $todo_details->rebuild_view_member_status;

            $this->title_shown_in_task_list = $todo_details->title_shown_in_task_list;
            $this->chat_function_status = $todo_details->chat_function_status;

            $this->send_notice_mail_status = $todo_details->send_notice_mail_status;

            $this->display_after_deadline_expired_status = $todo_details->display_after_deadline_expired_status;

            $this->display_deadline = $todo_details->display_deadline;

            $this->submission_deadline_status = $todo_details->submission_deadline_status;

            $this->submission_deadline = $todo_details->submission_deadline;

            $this->meeting_datetime_status = $todo_details->meeting_datetime_status;
            $this->meeting_datetime = $todo_details->meeting_datetime;

            $this->place_info = $todo_details->place_info;

            $this->content = $todo_details->content;

            // $this->attachments = $todo_details->attachments;

            $this->submission_title = $todo_details->submission_title;
            $this->display_theme_list_status = $todo_details->display_theme_list_status;

            $this->presentation_screen_status = $todo_details->presentation_screen_status;
            $this->presentation_screen_content = $todo_details->presentation_screen_content;
            $this->functional_display_frame_prod_status = $todo_details->functional_display_frame_prod_status;


            $this->hide_submission_information_status = $todo_details->hide_submission_information_status;
        } else {
            return redirect()->to('/user');
        }
    }


    public function update_modal()
    {
        $validated_data = $this->validate([

            'display_at_task_list_status' => 'nullable',
            'group_id' => 'required',
            'rebuild_view_member_status' => 'nullable',
            'created_by' => 'nullable',
            'title_shown_in_task_list' => 'required',
            'chat_function_status' => 'nullable',

            'send_notice_mail_status' => 'nullable',
            'display_after_deadline_expired_status' => 'nullable',
            'display_deadline' => 'nullable',

            'submission_deadline_status' => 'nullable',

            'submission_deadline' => 'nullable',
            'meeting_datetime_status' => 'nullable',
            'meeting_datetime' => 'nullable',
            'place_info' => 'nullable',

            'content' => 'nullable',
            'attachments' => 'max:10240',
            'submission_title' => 'nullable',
            'display_theme_list_status' => 'nullable',

            'presentation_screen_status' => 'nullable',
            'presentation_screen_content' => 'nullable',
            'functional_display_frame_prod_status' => 'nullable',


            'hide_submission_information_status' => 'nullable',
            // 'remark_display_status' => 'nullable',

        ]);

        $uploadedFileNames = [];

        foreach ($this->attachments as $attachment) {
            $randomNumber = rand(100000, 999999);
            $attachments_newFileName = $randomNumber . '.' . pathinfo($attachment->getClientOriginalName(), PATHINFO_EXTENSION);

            // Store the uploaded file in the storage directory
            $path = Storage::putFileAs('public/file', $attachment, $attachments_newFileName);

            // Add the file name to the list
            $uploadedFileNames[] = $path;
        }

        // Convert the array of file names to JSON
        $jsonFileNames = json_encode($uploadedFileNames);


        ModelsToDo::where('id', $this->to_do_id)->update([

            'display_at_task_list_status' => $this->display_at_task_list_status,
            'project_id' => $this->project->id,
            'group_id' => $this->group_id,
            'rebuild_view_member_status' => $this->rebuild_view_member_status,
            'created_by' => $this->created_by,
            'title_shown_in_task_list' => $this->title_shown_in_task_list,
            'chat_function_status' => $this->chat_function_status,

            'send_notice_mail_status' => $this->send_notice_mail_status,
            'display_after_deadline_expired_status' => $this->display_after_deadline_expired_status,
            'display_deadline' => $this->display_deadline,

            'submission_deadline_status' => $this->submission_deadline_status,

            'submission_deadline' => $this->submission_deadline,
            'meeting_datetime_status' => $this->meeting_datetime_status,
            'meeting_datetime' => $this->meeting_datetime,
            'place_info' => $this->place_info,

            'content' => $this->content,
            'attachments' => $jsonFileNames,
            'submission_title' => $this->submission_title,
            'display_theme_list_status' => $this->display_theme_list_status,

            'presentation_screen_status' => $this->presentation_screen_status,
            'presentation_screen_content' => $this->presentation_screen_content,
            'functional_display_frame_prod_status' => $this->functional_display_frame_prod_status,


            'hide_submission_information_status' => $this->hide_submission_information_status,
            // 'remark_display_status'=> $this->remark_display_status,
        ]);
        
        $this->dispatchBrowserEvent('close_update_Modal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Updated!']);
    }




    public function show_data_on_submit_modal(int $to_do_id)
    {

    }

    public function updateProgress()
    {


        $validated_data = $this->validate([
            'progressinput' => 'nullable|number'
        ]);

        dd($this->progressinput);
        // Save the progress value to the database
        // SubmitTodo::create(['value' => $this->progressValue]);

        // You can also perform additional logic here if needed

        // Reset the progress value
        // $this->progressValue = 0;
    }

    




















    public function delete($id)
    {
        ModelsToDo::findOrFail($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully deleted !']);
    }
}
