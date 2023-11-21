<?php

namespace App\Http\Livewire;

use App\Models\ProjectWiseUserAccess;
use App\Models\ProjectWiseUserInfo;
use App\Models\RoleWisePermission;
use App\Models\User as ModelsUser;
use App\Notifications\Invite;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class User extends Component
{
    public $email, $role, $project_id, $user_id, $username, $search, $type, $name, $user_check, $orgin_user_id;

    public function mount($project_id = null)
    {
        $this->project_id = $project_id;
    }
    public function render()
    {

        $module_id = NULL;
        $user_check = null;
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

        if ($access_permission == 'User' || $access_permission == 'Admin') {
            $access = ProjectWiseUserAccess::where('user_id', Auth::user()->id)->where('project_id', $this->project_id)->first();
        }

        return view('livewire.user', [
            'roles' => RoleWisePermission::all(),
            // 'roles' => RoleWisePermission::all()->unique('role'),
            'users' => ProjectWiseUserInfo::where('project_id', $this->project_id)->when($this->search, function ($q) {
                $q->where('username', 'LIKE', "%$this->search%");
            })->get(),
            'access' => $access,
            'access_permission' => $access_permission
        ])->extends('layouts.app');
    }



    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
            'type' => 'required'
        ]);

        $user = ModelsUser::whereEmail($this->email)->first();
        if (!$user) {
            $user = ModelsUser::create([
                'type' => $this->type,
                'status' => 'Invite',
                'name' => $this->name,
                'email' => $this->email,
                // 'password' => bcrypt(rand(111111, 999999)),
                'password' => bcrypt('12345678'),
            ]);
        }


        $user_check = ProjectWiseUserInfo::whereusername($this->email)->where('project_id', $this->project_id)->first();
        if (!$user_check) {
            ProjectWiseUserInfo::create([
                'username' => $this->email,
                'role' => $this->role,
                'project_id' => $this->project_id,
                'user_id' => $user->id,
                'status' => 'Invite',
            ]);

            // $user->notify(new Invite($user, $this->project_id)); 
            // return redirect()->back();
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully invitation sent !']);
            // $this->reset();
        } else {
            // dd(123);
            $this->dispatchBrowserEvent('alert', ['type' => 'warning',  'message' => 'User already exist !']);
            // $this->reset();
        }
    }


    public function Edit_modal(int $user_id)
    {
        $users = ProjectWiseUserInfo::findOrFail($user_id);
        if ($users) {
            $this->user_id = $users->id;
            $user_email = $this->email = $users->username;
            $this->role = $users->role;



            $users_info = ModelsUser::whereEmail($user_email)->first();
            $this->orgin_user_id = $users_info->id;
            $this->name = $users_info->name;
            $this->type = $users_info->type;

            // dd($this->orgin_user_id);


        } else {
            return redirect()->to('/user');
        }
    }


    public function update_modal()
    {
        $this->validate([
            'name' => 'required|string',
            'role' => 'required',
            'type' => 'required'
        ]);


        ProjectWiseUserInfo::where('id', $this->user_id)->update([
            'role' => $this->role,
        ]);
        ModelsUser::where('id', $this->orgin_user_id)->update([
            'type' => $this->type,
            'name' => $this->name,
        ]);

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully Edited!']);
    }

    // public function CloseModal()
    // {
    //     $this->ProjectWiseUserInfo->resetInput();
    // }

    public function delete($user_id)
    {
        ProjectWiseUserInfo::findOrFail($user_id)->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully User deleted !']);
    }
}
