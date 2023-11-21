<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chatting;

class ChatFile extends Component
{
    public $todo_id, $search;
    
    public function mount($id)
    {
        $this->todo_id = $id;
    }


    public function render()
    {
        

        // dd($todo_user);
        
        $data = [            
            'chat' => Chatting::where('to_do_id', $this->todo_id)
                  ->whereNotNull('attachments')->when($this->search, function ($q) {
                    $q->where('attachments', 'LIKE', "%$this->search%");
                })->get(),

            'tidiid' => $this->todo_id

        ];
        

        return view('livewire.chat-file', $data)->extends('layouts.app');
    }
    
}
