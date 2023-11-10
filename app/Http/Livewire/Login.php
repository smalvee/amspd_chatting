<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;
    public function render()
    {
        return view('livewire.login')->extends('layouts.auth');
    }

    public function login(){
        $validatedData = $this->validate([
            'email' => 'required|email:exists:users',
            'password' => 'required|string|min:6|max:30',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password, 'status' => 'Active'])) {
            switch(auth()->user()->type){
                case('Super Admin'):
                    return redirect()->route('project');
                case('Admin'):
                    return redirect()->route('project');
                case('User'):
                    return redirect()->route('project');
                default:
                    auth()->logout();
                    $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Invalid user type !']);
            }
        }else{
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'User password not match !']);
            session()->flash('message', 'User password not match !');
            session()->flash('class-type', 'danger');
        }
    }
}
