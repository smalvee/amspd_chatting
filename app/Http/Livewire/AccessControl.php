<?php

namespace App\Http\Livewire;

use App\Models\Module;
use App\Models\RoleWisePermission;
use Livewire\Component;

class AccessControl extends Component
{
    public $permissions = [], $name, $permission_as, $search;

    public function render() 
    {
        return view('livewire.access-control', [
            'roles' => RoleWisePermission::pluck('role')->unique(),
            'modules' => Module::where('status', 1)->orwhere('status', 2)->get()
        ])->extends('layouts.app');
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|unique:role_wise_permissions,role',
            'permission_as' => 'nullable',
            'permissions' => 'required|array'
        ]);

        if ($this->permission_as == NULL) {
            $permission_as = 'User';
        } else {
            $permission_as = $this->permission_as;
        }

        foreach ($this->permissions as $module => $permission_array) {
            if (is_array($permission_array)) {
                foreach ($permission_array as $permission_key => $permission_value) {
                    if ($permission_value) {
                        RoleWisePermission::firstOrCreate([
                            'role' => $this->name,
                            'module' => $module,
                            'permission' => $permission_key,
                            'permission_as' => $permission_as
                        ]);
                    }
                }
            }
        }
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully created !']);
        $this->reset();
    }


    public function Edit_modal(string $role)
    {
        $access = RoleWisePermission::findOrFail($role);
        if ($access) {
            $this->name = $access->role;
        } else {
            return redirect()->to('/user');
        }

        dd($this->name);
    }



    public function update_modal()
    {

        if ($this->permission_as == NULL) {
            $permission_as = 'User';
        } else {
            $permission_as = $this->permission_as;
        }

        foreach ($this->permissions as $module => $permission_array) {
            if (is_array($permission_array)) {
                foreach ($permission_array as $permission_key => $permission_value) {
                    if ($permission_value) {
                        RoleWisePermission::where('role', $this->name)->update([
                            'role' => $this->name,
                            'module' => $module,
                            'permission' => $permission_key,
                            'permission_as' => $permission_as
                        ]);
                    }
                }
            }
        }


        // RoleWisePermission::where('role', $this->name)->update([
        //     'username' => $this->email,
        //     'role' => $this->role,
        // ]);

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Edited!']);
    }


















    public function delete_role($role)
    {
        RoleWisePermission::whereRole($role)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully deleted !']);
    }
}
