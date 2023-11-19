<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chatting;

class ChatFile extends Component
{
    public $todo_id;
    
    public function mount($id)
    {
        $this->todo_id = $id;
    }


    public function render()
    {
        
        $data = [            
            'project_users' => Chatting::where('to_do_id', $this->todo_id)->get()
           

        ];

        return view('livewire.chat-file', $data)->extends('layouts.app');
    }
}
