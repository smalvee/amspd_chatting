<?php

namespace App\Http\Livewire;

use App\Models\Module as ModelsModule;
use Livewire\Component;
use App\Models\Project as ModelsProject;
use LDAP\Result;
use Illuminate\Support\Facades\Auth;


class Module extends Component
{
    public $module_name, $jp_name, $projects_reffer, $name, $updated_at, $created_at, $m_id;
    public $search, $logged_in_use_id;

    

    public function render()
    {
        return view('livewire.module',[
            'modules' => ModelsModule::all()
        ])->extends('layouts.app'); 
    }


    public function submit(){
        $this->validate([
            'module_name' => 'required|string|unique:modules,module_name',
        ]);

        $logged_in_use_id = Auth::user()->id;

        ModelsModule::create([
            'module_name' => $this->module_name,
            'created_by' => $logged_in_use_id,

        ]);
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Module successfully Created !']);
        $this->reset();
    }


    public function Edit_modal(int $module_id)
    {
        $Module_reffer = ModelsModule::findOrFail($module_id);

        // dd( $projects_reffer);
        if ($Module_reffer) {
            $this->m_id = $Module_reffer->id;
            $this->module_name = $Module_reffer->module_name;
            
            // $this->name = $project->name;
            // return view('livewire.project', compact((string) $projects_reffer));
        } else {
            return redirect()->to('/project');
        }
    } 


    public function update_project_modal()
    {

        $this->validate([
            'module_name' => 'required|string|unique:modules,module_name',
        ]);

        $result = ModelsModule::where('id', $this->m_id)->update([


            'module_name' => $this->module_name,
            
        ]);
        if($result){
            
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Edited!']);
        }
        else{
            $this->dispatchBrowserEvent('alert', ['type' => 'fail',  'message' => 'Failed']);
        }
       
    }


    public function delete($module_id){
        ModelsModule::findOrFail($module_id)->delete(); 
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Project deleted !']);
    }
}
