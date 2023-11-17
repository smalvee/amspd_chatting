<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\ProjectWiseUserPermission;
use App\Models\User;
use Livewire\Component;

class ProjectDetails extends Component
{
    public $project;
    public function mount($project_id)
    {
        $this->project = Project::findOrFail($project_id);
    }
    public function render()
    {
        return view('livewire.project-details', [
            'users' => User::whereType('User')->get()
        ])->extends('layouts.app');
    }

    public function updatePermission($user_id, $permission)
    {
        $permission_exist = ProjectWiseUserPermission::where([
            'project_id' => $this->project->id,
            'user_id' => $user_id,
            'permission' => $permission,
        ])->first();
        if ($permission_exist) {
            $permission_exist->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'permission removed']);
        } else {
            ProjectWiseUserPermission::create([
                'project_id' => $this->project->id,
                'user_id' => $user_id,
                'permission' => $permission,
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'permission assigned']);
        }
    }
}
