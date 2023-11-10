<?php

namespace App\Http\Livewire;

use App\Models\NodeInfo;
use Livewire\Component;

class Dashboard extends Component
{
    public $project_id;
    public function mount($project_id){
        $this->project_id = $project_id;
    }
    public function render()
    {
        return view('livewire.dashboard',[
            'nodes' => NodeInfo::where('project_id',$this->project_id)->get()
        ])->extends('layouts.app');
    }
}
