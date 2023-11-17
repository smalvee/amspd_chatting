<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\ProjectWiseUserInfo;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Crypt;

class Invitation extends Component
{
    public $user, $name, $password, $password_confirmation, $project_wise_user_info;
    public $project;
    public function mount($user_id, $project_id = null)
    {
        $this->user = User::findOrFail(Crypt::decryptString($user_id));
        if ($project_id) {
            $this->project = Project::findOrFail($project_id);
            $this->project_wise_user_info = ProjectWiseUserInfo::where(['project_id' => $project_id, 'user_id' => $this->user->id])->firstOrFail();
        }

        if ($project_id == null && $this->user->status != 'Invite') {
            abort(404);
        }

        if ($this->project_wise_user_info && $this->project_wise_user_info->status != 'Invite') {
            abort(404);
        }
    }
    public function render()
    {
        return view('livewire.invitation')->extends('layouts.auth');
    }

    public function submit()
    {
        if ($this->user->status == 'Invite') {
            $this->validate([
                'name' => 'required|string',
                'password' => 'required|string|min:6',
                'password_confirmation' => 'required|same:password',
            ]);
            $this->user->update([
                'status' => 'Active',
                'name' => $this->name,
                'password' => bcrypt($this->password),
            ]);
        }

        if ($this->project_wise_user_info) {
            $this->validate([
                'name' => 'required|string',
            ]);
            $this->project_wise_user_info->update([
                'status' => 'Active',
                'username' => $this->name,
            ]);
        }


        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Successfully activated ypur account !']);
        $this->reset();
        return redirect()->intended('login');
    }
}
