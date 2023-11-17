<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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


?>


<div>
    <x-breadcrumb title="{{ __('Project') }}"  btn="1"  />
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
                            <input class="form-control" type="search" placeholder="Search" wire:model="search">
                            <!-- <input placeholder=""> -->
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="table-responsive scrollbar">
                        <table class="table table-hover table-striped overflow-hidden">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Project</th>
                                    @admin
                                    <th scope="col">Action</th>
                                    @endadmin
                                </tr>
                            </thead>
                            <?php
                            if (Auth::user()->type == 'Super Admin') { ?>
                                <tbody>
                                    @foreach ($projects as $project)
                                    <tr class="align-middle">
                                        <td class="text-nowrap"> {{ $loop->iteration }} </td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('project.todo', $project->id) }}">
                                                {{ $project->name }}
                                            </a>
                                        </td>
                                        @admin
                                        <td class="text-nowrap">
                                            <!-- <button class="btn btn-falcon-primary btn-sm">Edit</button> -->
                                            <button type="button" wire:click="Edit_modal({{$project->id}})" class="btn btn-falcon-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update_modal">Edit</button>
                                            <button class="btn btn-falcon-danger btn-sm" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete('{{ $project->id }}')">Delete</button>
                                            <!-- <button class="btn btn-falcon-danger btn-sm">Delete</button> -->
                                        </td>
                                        @endadmin
                                    </tr>
                                    @endforeach
                                </tbody>

                            <?php }
                            ?>



                            <?php
                            $loggedin_id = Auth::user()->id;
                            if (Auth::user()->type != 'Super Admin') {

                            ?>

                                    <tbody>
                                        @foreach ($select_project as $project)
                                        <tr class="align-middle">
                                            <td class="text-nowrap"> {{ $loop->iteration }} </td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('project.todo', $project->id) }}">
                                                {{ $project->name}}
                                                </a>
                                            </td>
                                            @admin
                                            <td class="text-nowrap">
                                                <!-- <button class="btn btn-falcon-primary btn-sm">Edit</button> -->
                                                <button type="button" wire:click="Edit_modal({{$project->id}})" class="btn btn-falcon-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update_modal">Edit</button>
                                                <button class="btn btn-falcon-danger btn-sm" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete('{{ $project->id }}')">Delete</button>
                                                <!-- <button class="btn btn-falcon-danger btn-sm">Delete</button> -->
                                            </td>
                                            @endadmin
                                        </tr>
                                        @endforeach
                                    </tbody>

                            <?php }
                            
                            ?>




                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Create || Update Modal --}}
    @admin
    <div wire:ignore.self class="modal fade" id="create_and_edit_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> Project </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='submit'>
                            <div class="mb-3">
                                <label class="col-form-label" for="en_name">Name (en):</label>
                                <input class="form-control" id="en_name" type="text" wire:model="en_name" />
                                @error('en_name') <x-alert type="danger" :$message /> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="jp_name">Name (jp):</label>
                                <input class="form-control" id="jp_name" type="text" wire:model="jp_name" />
                                @error('jp_name') <x-alert type="danger" :$message /> @enderror
                            </div>
                            {{-- <div class="mb-3">
                                <label class="col-form-label" for="email">Email:</label>
                                <input class="form-control" id="email" type="email" wire:model="email" />
                                 @error('email') <x-alert type="danger" :$message /> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="password">Password:</label>
                                <input class="form-control" id="password" type="password" wire:model="password" />
                                 @error('password') <x-alert type="danger" :$message /> @enderror
                            </div> --}}
                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" id="close_button" type="button" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endadmin












    {{-- Update || Update Modal --}}
    @admin
    <div wire:ignore.self class="modal fade" id="update_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> Project </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='update_project_modal'>

                            <div class="mb-3">
                                <input class="form-control" id="p_id" type="text" wire:model="p_id" />
                                <label class="col-form-label" for="en_name">Name (en):</label>
                                <input class="form-control" id="en_name" type="text" wire:model="en_name" />
                                @error('en_name') <x-alert type="danger" :$message /> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="jp_name">Name (jp):</label>
                                <input class="form-control" id="jp_name" type="text" wire:model="jp_name" />
                                @error('jp_name') <x-alert type="danger" :$message /> @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label class="col-form-label" for="email">Email:</label>
                                <input class="form-control" id="email" type="email" wire:model="email" />
                                 @error('email') <x-alert type="danger" :$message /> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="password">Password:</label>
                                <input class="form-control" id="password" type="password" wire:model="password" />
                                 @error('password') <x-alert type="danger" :$message /> @enderror
                            </div> --}}
                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Update </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endadmin










</div>


<script>
    window.addEventListener('closeModal', event => {
        console.log('Close modal event triggered');
        var button = document.getElementById("close_button");
        button.click();

    });
</script>