<?php

namespace App\Http\Livewire;

use App\Models\Module;
use App\Models\Project;
use App\Models\ProjectWiseUserAccess;
use App\Models\ProjectWiseUserInfo;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAccess extends Component
{
    public $search, $module_id, $m_id, $user_id, $project_id, $role_name, $create, $read, $update, $delete, $status, $default_access, $created_by;

    public function mount($m_id)
    {
        // $this->todo_id = $chatting_id;
        $this->module_id = $m_id;
        
        // dd($this->todo_id);
    }


    public function render()
    {
        $module_id = NULL;
        $access = null;
        $create = NULL;
        $read = NULL;
        $update = NULL;
        $delete = NULL;
        $access_permission = Auth::user()->type ?? null;
        $results2 = NULL;
        $results1 = NULL;
        $results2 = NULL;
        $results1 = NULL;
        $projects_reffer = [];
        $loggedin_id = Auth::user()->id;

        // if ($access_permission == 'User' || $access_permission == 'Admin') {
        //     $access = ProjectWiseUserAccess::where('user_id', Auth::user()->id)->where('project_id', $this->project->id)->first();
        // }


        // dd($this->module_id);
        return view('livewire.user-access', [
            'users' => ProjectWiseUserAccess::where('module_id', $this->module_id)->get(),
            'all_users' => User::where('status', "Active")->get(),
            'all_projects' => Project::all(),
            'all_modules' => Module::where('id', $this->module_id)->get(),
            'access' => $access,
            'access_permission' => $access_permission

        ])->extends('layouts.app');
    }

    public function submit()
    {
        $this->validate([
            'user_id' => 'required',
            'project_id' => 'required',
            'create' => 'nullable',
            'read' => 'nullable',
            'update' => 'nullable',
            'delete' => 'nullable',
            'default_access' => 'nullable',
        ]);

        ProjectWiseUserAccess::create([
            'user_id' => $this->user_id,
            'project_id' => $this->project_id,
            'module_id' => $this->module_id,
            'create' => $this->create,
            'read' => $this->read,
            'update' => $this->update,
            'delete' => $this->delete,
            'status' => "Active",
            'default_access' => $this->default_access,
            'created_by' => Auth::user()->id,
        ]);

        $this->reset([
            'user_id',
            'project_id',
            'create',
            'read',
            'update',
            'delete',
            'default_access'
        ]);
       

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Access successfully Created !']);
        $this->dispatchBrowserEvent('closeModal');
        
    }
}
