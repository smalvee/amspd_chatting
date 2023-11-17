<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class FilesUpload extends Component
{
    use WithFileUploads;



    public $files, $field_name, $multiple;
    public function mount($field_name, $multiple = false){
        $this->field_name = $field_name;
        $this->multiple = $multiple;
        $this->files =  $multiple ? [] : null;
    }
    public function render()
    {
        return view('livewire.files-upload');
    }

    public function remove($key, $field_name){
        if(isset($this->files[$field_name][$key])){
            unset($this->files[$field_name][$key]);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'File removed !']);
        }else{
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'File not found !']);
        }
    }

    public function set($file){
        // dd($this->files, $file);
    }

    public function uploads()
    {
        $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'Under development !']);

    }
}
