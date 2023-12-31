<?php

namespace App\Http\Livewire;

use App\Models\ProjectWiseUserAccess;
use App\Models\ProjectWiseUserInfo;
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
        $signature;


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
            $access = ProjectWiseUserAccess::where('user_id', Auth::user()->id)->where('project_id', $this->project->id)->first();
            if($access == NULL)
            {
                $access = null;
            }
        }

        // if ($access_permission == 'Super Admin') {
        //     $task_groups_view = TaskGroup::all();
        // } else
        // {
        //     $task_groups_view = TaskGroup::where('project_id', $this->project->id)->get();
        // }



      
        // Alvee Code End 

        $data = [
            'todos' => ModelsToDo::where('project_id', $this->project->id)->when($this->search, function ($q) {
                $q->where('name', 'LIKE', "%$this->search%");
            })->get(),
            'task_groups_view' => TaskGroup::where('project_id', $this->project->id)->get(),
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
    public function delete($id)
    {
        ModelsToDo::findOrFail($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully deleted !']);
    }
}
