<?php

namespace App\Http\Livewire;

use App\Models\Chatting as ModelsChatting;
use App\Models\ProjectWiseUserInfo;
use App\Models\ToDo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class Chatting extends Component
{
    use WithFileUploads;

    public $chat_details, $pro_id, $data, $project, $users, $todo_id, $todo, $refresh_count, $attachments = [], $admin = 'Admin';

    public function mount($id)
    {
        // $this->todo_id = $chatting_id;
        $this->todo_id = $id;
        // dd($this->todo_id);
    }

    public function render()
    {
        $pro_id = ToDo::select('project_id')->where('id', $this->todo_id)->value('project_id');
        // dd($pro_id);



        // $todo_user = User::select('users.id', 'users.name', 'project_wise_user_infos.role')
        //     ->join('task_group_wise_user_lists', 'users.id', '=', 'task_group_wise_user_lists.user_id')
        //     ->join('to_dos', 'task_group_wise_user_lists.task_group_id', '=', 'to_dos.group_id')
        //     ->join('project_wise_user_infos', 'users.id', '=', 'project_wise_user_infos.user_id')

        //     ->where('to_dos.id', $this->todo_id)
        //     ->get();

        $todo_user = User::select('users.id', 'users.name', 'project_wise_user_infos.role', 'project_wise_user_infos.project_id')
            ->join('task_group_wise_user_lists', 'users.id', '=', 'task_group_wise_user_lists.user_id')
            ->join('to_dos', 'task_group_wise_user_lists.task_group_id', '=', 'to_dos.group_id')
            ->join('project_wise_user_infos', function ($join) use ($pro_id) {
                $join->on('users.id', '=', 'project_wise_user_infos.user_id')
                    ->where('project_wise_user_infos.project_id', '=', $pro_id);
            })
            ->where('to_dos.id', '=', $this->todo_id)
            ->get();


        $get_to_do_admin = User::select('users.id', 'users.name', 'users.type', 'project_wise_user_infos.role')
            ->join('project_wise_user_infos', 'users.id', '=', 'project_wise_user_infos.user_id')
            ->join('to_dos', 'project_wise_user_infos.project_id', '=', 'to_dos.project_id')
            ->where('users.type', 'Admin')
            ->where('to_dos.id', $this->todo_id)
            ->get();

        $to_head_line = ToDo::join('chattings', 'to_dos.id', '=', 'chattings.to_do_id')
            ->where('to_dos.id', $this->todo_id)
            ->value('to_dos.title_shown_in_task_list');

        // dd($to_head_line);

        return view('livewire.chatting', [
            'chat' => ModelsChatting::where('to_do_id', $this->todo_id)->get(),
            'to_do_id_chat' => $this->todo_id,
            'to_do_user_list' =>  $todo_user,
            'count' => $todo_user->count() + $get_to_do_admin->count(),
            'to_do_admin' => $get_to_do_admin,
            'to_do_head_line' => $to_head_line


        ])->extends('layouts.app');

        // dd($data);
    }





    public function submit()
    {
        $user_name = Auth::user()->name;
        $this->validate([
            'chat_details' => 'required',
            // 'to_do_id' => 'required',
            // 'user_id' => 'required',
        ]);

        ModelsChatting::create([
            'chat_details' => $this->chat_details,
            'to_do_id' => $this->todo_id,
            'user_id' => $user_name,

            // 'email' => $this->email,
        ]);

        $this->chat_details = '';

        // Optionally, you can add a success message
        // session()->flash('message', 'User created successfully.');
        $this->dispatchBrowserEvent('reloadPage');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully send !']);
    }


    public function sendfile()
    {


        $user_email = Auth::user()->email;
        $this->validate([
            'attachments' => 'max:10240',
        ]);

        $uploadedFileNames = [];

        foreach ($this->attachments as $attachment) {
            $randomNumber = rand(100000, 999999);
            $attachments_newFileName = $randomNumber . '.' . pathinfo($attachment->getClientOriginalName(), PATHINFO_EXTENSION);

            // Store the uploaded file in the storage directory
            $path = Storage::putFileAs('public/chat_file', $attachment, $attachments_newFileName);

            // Add the file name to the list
            $uploadedFileNames[] = $path;
        }

        // Convert the array of file names to JSON
        $jsonFileNames = json_encode($uploadedFileNames);


        ModelsChatting::create([

            'attachments' => $jsonFileNames,
            'to_do_id' => $this->todo_id,
            'user_id' => $user_email,
            'chat_details' => 'File Received',

        ]);

        $this->attachments = '';

        // Optionally, you can add a success message
        // session()->flash('message', 'User created successfully.');
        // $this->dispatchBrowserEvent('reloadPage');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully file send !']);
    }
}
