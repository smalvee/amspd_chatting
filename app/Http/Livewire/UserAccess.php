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
    public $search, $module_id,  $a_id, $m_id, $user_id, $project_id, $role_name, $create, $read, $update, $delete, $status, $default_access, $created_by;

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

            'users' => ProjectWiseUserAccess::where('module_id', $this->module_id)->when($this->search, function ($q) {
                $q->where('username', 'LIKE', "%$this->search%");
            })->get(),

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

        $check = ProjectWiseUserAccess::where('project_id', $this->project_id)->where('user_id', $this->user_id)->where('module_id', $this->module_id)->first();
        if ($check) {
            $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'Already exist !']);
        } else {


            ProjectWiseUserAccess::create([
                'user_id' => $this->user_id,
                'project_id' => $this->project_id,
                'module_id' => $this->module_id,
                'create' => $this->create,
                'read' => $this->read,
                'update' => $this->update,
                'delete' => $this->delete,
                'status' => "1",
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
            $this->dispatchBrowserEvent('closeModalc');
        }
    }








    public function Edit_modal(int $id)
    {
        $access_reffer = ProjectWiseUserAccess::findOrFail($id);

        // dd( $projects_reffer);
        if ($access_reffer) {
            $this->a_id = $access_reffer->id;
            $this->user_id = $access_reffer->user_id;
            $this->project_id = $access_reffer->project_id;
            $this->create = $access_reffer->create;
            $this->read = $access_reffer->read;
            $this->update = $access_reffer->update;
            $this->delete = $access_reffer->delete;
            $this->default_access = $access_reffer->default_access;
            $this->status = $access_reffer->status;
            // return view('livewire.project', compact((string) $projects_reffer));
        } else {
            return redirect()->to('/project');
        }
    }



    public function update()
    {
        $this->validate([
            'user_id' => 'required',
            'project_id' => 'required',
            'create' => 'nullable',
            'read' => 'nullable',
            'update' => 'nullable',
            'delete' => 'nullable',
            'status' => 'nullable',
            'default_access' => 'nullable',
        ]);

        $result = ProjectWiseUserAccess::where('id', $this->a_id)->update([
            'default_access' => $this->default_access,
            'create' => $this->create,
            'read' => $this->read,
            'update' => $this->update,
            'delete' => $this->delete,
            'status' => $this->status,

        ]);
        

        $this->reset([
            'default_access',
            'create',
            'read',
            'update',
            'delete',
            'status'
           
        ]);

        if ($result) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Access successfully Updated !']);
            $this->dispatchBrowserEvent('closeModalu');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'danger',  'message' => 'Something Wrong !']);
            $this->dispatchBrowserEvent('closeModalu');
        }
    }










    public function delete($id)
    {
        ProjectWiseUserAccess::findOrFail($id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully deleted !']);
    }
}
