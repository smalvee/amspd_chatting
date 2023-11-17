<?php

namespace App\Http\Livewire;

use App\Models\ProjectWiseUserAccess;
use App\Models\RoleWisePermission;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Role extends Component
{
    public $name, $role_id;
    public function render()
    {

        $module_id = NULL;
        $access = NULL;
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

        if ($access_permission == 'User' || $access_permission == 'Admin') {
            $access = ProjectWiseUserAccess::where('user_id', Auth::user()->id)->first();
        }




        return view('livewire.role', [
            'roles' => RoleWisePermission::all(),
            'access_permission' => $access_permission,
            'access' => $access
        ])->extends('layouts.app');
    }


    public function submit()
    {
        $this->validate([
            'name' => 'required|string'
        ]);

        RoleWisePermission::firstOrCreate([
            'role' => $this->name,
            'created_by' => Auth::user()->id
        ]);

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully created !']);
        $this->reset();
    }


    public function Edit_modal(int $id)
    {
        $access = RoleWisePermission::findOrFail($id);
        if ($access) {
            $this->role_id = $access->id;
            $this->name = $access->role;
        } else {
            return redirect()->to('/role');
        }

        // dd($this->name);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $result = RoleWisePermission::where('id', $this->role_id)->update([
            'role' => $this->name,

        ]);

        $this->reset([
            'name',
           
        ]);

        if ($result) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Access successfully Updated !']);
            $this->dispatchBrowserEvent('closeModalu');
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'danger',  'message' => 'Something Wrong !']);
            $this->dispatchBrowserEvent('closeModalu');
        }
    }


    public function delete_role(int $id)
    {
        RoleWisePermission::where('id', $id)->delete();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully deleted !']);
    }
}
