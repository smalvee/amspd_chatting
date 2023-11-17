<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Notifications\ProjectAdminCreate;
use App\Notifications\ProjectAdminInvite;
use Livewire\Component;

class ProjectAdmin extends Component
{
    public function render()
    {
        return view('livewire.project-admin', [
            'users' => User::latest()->get()
        ])->extends('layouts.app');
    }

    public $invitation_email;
    public function invitation()
    {
        $this->validate([
            'invitation_email' => 'required|email|unique:users,email'
        ]);

        $user = User::create([
            'type' => 'Admin',
            'status' => 'Invite',
            'name' => 'Admin',
            'email' => $this->invitation_email,
            'password' => bcrypt(rand(111111, 999999)),
        ]);

        $user->notify(new ProjectAdminInvite($user));
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Project admin successfully invited !']);
        $this->reset();
    }

    public $name, $email, $password, $selected_user_for_edit;
    public function create()
    {
        $this->name = $this->email = $this->password = $this->selected_user_for_edit = null;
    }

    public function select_for_edit($selected_user_for_edit)
    {
        $user = User::find($selected_user_for_edit);
        if (!$user) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Project admin not found !']);
        }
        $this->selected_user_for_edit = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = null;
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->selected_user_for_edit,
            'password' => 'required|string|min:6',
        ]);

        if ($this->selected_user_for_edit) {
            $user = User::find($this->selected_user_for_edit);
            if (!$user) {
                $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'Project admin not found !']);
            }
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Project admin successfully updated !']);
        } else {
            $user = User::create([
                'type' => 'Project Admin',
                'status' => 'Active',
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);
            $user->notify(new ProjectAdminCreate($user, $this->password));
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Project admin successfully created !']);
        }
        $this->reset();
    }

    public $selected_user_for_delete;
    public function select_for_delete($selected_user_for_delete)
    {
        $user = User::findOrFail($selected_user_for_delete);
        $this->selected_user_for_delete = $user->id;
    }

    public function delete()
    {
        $user = User::findOrFail($this->selected_user_for_delete);
        $user->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Project admin successfully deleted !']);
    }
}
