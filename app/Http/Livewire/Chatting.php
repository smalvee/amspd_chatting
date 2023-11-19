<?php

namespace App\Http\Livewire;

use App\Models\Chatting as ModelsChatting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class Chatting extends Component
{
    use WithFileUploads;

    public $chat_details, $data, $project, $users, $todo_id, $todo, $refresh_count, $attachments = [];

    public function mount($id)
    {
        // $this->todo_id = $chatting_id;
        $this->todo_id = $id;
        // dd($this->todo_id);
    }

    public function render()
    {
        return view('livewire.chatting', [
            'chat' => ModelsChatting::where('to_do_id', $this->todo_id)->get(),
            'to_do_id_chat' => $this->todo_id


        ])->extends('layouts.app');

        // dd($data);
    }





    public function submit()
    {
        $user_email = Auth::user()->email;
        $this->validate([
            'chat_details' => 'required',
            // 'to_do_id' => 'required',
            // 'user_id' => 'required',
        ]);

        ModelsChatting::create([
            'chat_details' => $this->chat_details,
            'to_do_id' => $this->todo_id,
            'user_id' => $user_email,

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
