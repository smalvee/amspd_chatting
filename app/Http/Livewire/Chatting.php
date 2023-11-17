<?php

namespace App\Http\Livewire;

use App\Models\Chatting as ModelsChatting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Chatting extends Component
{

    public $chat_details, $data, $project, $users, $todo_id, $todo;

    public function mount($id)
    {
        // $this->todo_id = $chatting_id;
        $this->todo_id = $id;
        // dd($this->todo_id);
    }

    public function render()
    {
        return view('livewire.chatting', [
            'chat' => ModelsChatting::where('to_do_id', $this->todo_id)->get()


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
}
