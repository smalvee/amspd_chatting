<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

$Access_permission = NULL;
$results2 = NULL;
$results1 = NULL;
$projects_reffer = [];
$loggedin_id = Auth::user()->id;

if (Auth::user()->name == 'Super Admin') {
    $Access_permission = 'Super Admin';
} else {
    if (Auth::user()->name == 'Admin') {
        return $Access_permission = 'Admin';
    } else {
        if (Auth::user()->name == 'User') {
            $results1 = DB::select('SELECT role FROM project_wise_user_infos WHERE user_id = ?', [$loggedin_id]);
            foreach ($results1 as $r1) {
                $a_p = $r1->role;
                $results2 = DB::select('SELECT * FROM role_wise_permissions WHERE role = ?', [$r1->role]);
                // foreach ($results2 as $r2) {
                //     $Access_permission = $r2->permission;
                // }
            }
        }
    }
}

// dd($Access_permission); 


$module_id = null;
$create = null;
$read = null;
$update = null;
$delete = null;

if($access)
{
    foreach ($access as $acs) {
        if ($acs->module_id == 5) {
            $module_id = 5;
            $create = $acs->create;
            $read = $acs->read;
            $update = $acs->update;
            $delete = $acs->delete;

            break;
        }
    }
}

// dd($delete);





?>



<div>
    <x-breadcrumb title="{{ __('Users') }}" @admin btn="1" @endadmin />
    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row flex-between-center">
                        <div class="col-md">
                            <h5 class="mb-2 mb-md-0">

                            </h5>
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="search" placeholder="Search by email" wire:model="search">
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="table-responsive scrollbar">
                        <table class="table table-hover table-striped overflow-hidden">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Status</th>
                                    @admin
                                    <th scope="col">Action</th>
                                    @endadmin
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="align-middle">
                                    <td class="text-nowrap"> {{ $loop->iteration }} </td>
                                    @php
                                    $user_name = User::where('email', $user->username)->get();
                                    @endphp
                                    @foreach($user_name as $name)
                                    <td class="text-nowrap">
                                        {{ $name->name }}
                                    </td>
                                    <td class="text-nowrap">
                                        {{ $user->username}}
                                    </td>
                                    <td class="text-nowrap">
                                        {{ $user->role }}
                                    </td>
                                    <td class="text-nowrap">
                                        {{ $user->status }}
                                    </td>
                                    
                                    <td class="text-nowrap">
                                        @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($module_id == '5' && $update == '1'))
                                        <button type="button" wire:click="Edit_modal({{$user->id}})" class="btn btn-falcon-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update_modal">Edit</button>
                                        @endif
                                        @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($module_id == '5' && $delete == '1'))
                                        <button class="btn btn-falcon-danger btn-sm" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete('{{ $user->id }}')">Delete</button>
                                        @endif

                                    </td>
                                    
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Create --}}
    @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($module_id == '5' && $create == '1'))
    <div wire:ignore.self class="modal fade" id="create_and_edit_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> User Invitation </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='submit'>
                            <div class="mb-3">
                                <label class="col-form-label" for="email">Name</label>
                                <input class="form-control" id="name" type="text" wire:model="name" />
                                @error('name')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="email">Email Address</label>
                                <input class="form-control" id="email" type="email" wire:model="email" />
                                @error('email')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="role">Role</label>
                                <select class="form-control" wire:model='role'>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->role }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="type">Permission as Like</label>
                                <select class="form-control" wire:model='type'>
                                    <option value="">Select one</option>
                                    <option value="User">User</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Super Admin">Super Admin</option>

                                </select>
                                @error('role')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>


                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" onclick="empty()" id="closeModalc" type="button" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif



    {{-- Update Modal --}}
    @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($module_id == '5' && $update == '1'))
    <div wire:ignore.self class="modal fade" id="update_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> User Invitation </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='update_modal'>
                            <div class="mb-3">
                                <label class="col-form-label" for="email">Email Address</label>
                                <input class="form-control" id="email" type="email" wire:model="email" disabled />
                                @error('email')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="email">Name</label>
                                <input class="form-control" id="name" type="text" wire:model="name" />
                                @error('name')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="col-form-label" for="role">Role</label>
                                <select class="form-control" wire:model='role'>
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->role }}">{{ $role->role }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="type">Permission as Like</label>
                                <select class="form-control" wire:model='type'>
                                    <option value="">Select one</option>
                                    <option value="User">User</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Super Admin">Super Admin</option>

                                </select>
                                @error('role')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" onclick="empty()" id="closeModalu" type="button" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Update </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    window.addEventListener('closeModalc', event => {
        console.log('Close modal event triggered');
        var button = document.getElementById("close_button");
        button.click();

    });
</script>
<script>
    window.addEventListener('closeModalu', event => {
        console.log('Close modal event triggered');
        var button = document.getElementById("closeModalu");
        button.click();

    });
</script>
<script>
    function empty() {
        var inputFields = document.querySelectorAll('input');
        inputFields.forEach(function(inputField) {
            inputField.value = '';
        });

        var inputFields = document.querySelectorAll('select');
        inputFields.forEach(function(inputField) {
            inputField.value = '';
        });



    }
</script>