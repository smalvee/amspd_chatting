<?php

namespace App\Http\Livewire\Charts;

use Livewire\Component;

class Chart_1 extends Component
{
    public $node_id, $node_name;
    public function mount($id, $name){
        $this->node_id = $id;
        $this->node_name = $name;
    }
    public function render()
    {
        return view('livewire.charts.chart_1',[
            'node_id' => $this->node_id,
            'node_name' => $this->node_name,
        ])->extends('layouts.app');
    }
}
