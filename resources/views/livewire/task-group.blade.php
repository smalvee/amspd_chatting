<?php

use App\Models\ProjectWiseUserInfo;
use App\Models\TaskGroup;
use App\Models\TaskGroupWiseUserList;
use App\Models\User;
use Illuminate\Support\Facades\DB;




$task = $this->group_id;
$p_id = $this->project_id_for_sql;

// $q1 = "SELECT * FROM project_wise_user_infos 
// WHERE project_wise_user_infos.user_id NOT IN (
// SELECT user_id FROM task_group_wise_user_lists WHERE task_group_id = '5')";

// $p_name = DB::select($q1);


$results = ProjectWiseUserInfo::where('project_id', $p_id)->whereNotIn('user_id', function ($query) use ($task) {
    $query->select('user_id')
        ->from('task_group_wise_user_lists')
        ->where('task_group_id', $task);
})
    ->get();

$results1 = TaskGroupWiseUserList::where('task_group_id', $task)->get();



$module_id = null;
$create = null;
$read = null;
$update = null;
$delete = null;

if($access)
{
    foreach ($access as $acs) {
        if ($acs->module_id == 7) {
            $module_id = 7;
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
    <x-breadcrumb title="{{ __('Task Group') }}" @admin btn="1" @endadmin />
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
                                    @admin
                                    <th scope="col">Action</th>
                                    @endadmin
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($groups as $group)
                                <tr class="align-middle">
                                    <td class="text-nowrap"> {{ $loop->iteration }} </td>
                                    <td class="text-nowrap">
                                        {{ $group->name }}
                                    </td>
                                    
                                    <td class="text-nowrap">
                                        <!-- <button class="btn btn-falcon-primary btn-sm">Edit</button>  -->
                                        @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($module_id == '7' && $create == '1'))
                                        <button type="button" wire:click="Open_add_user_modal({{$group->id}})" class="btn btn-falcon-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add_user_modal">User Add/Remove</button>
                                        @endif
                                        @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($module_id == '7' && $update == '1'))
                                        <button type="button" wire:click="Edit_modal({{$group->id}})" class="btn btn-falcon-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update_modal">Edit</button>
                                        @endif
                                        @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($module_id == '7' && $delete == '1'))
                                        <button class="btn btn-falcon-danger btn-sm" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete('{{ $group->id }}')">Delete</button>
                                        @endif
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
        </div>
    </div>


    {{-- Create || Update Modal --}}
    @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($module_id == '7' && $create == '1'))
    <div wire:ignore.self class="modal fade" id="create_and_edit_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> ToDo Group </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='submit'>
                            <div class="mb-3">
                                <label class="col-form-label" for="category">Category</label>
                                <input class="form-control" id="category" type="text" wire:model="category" />
                                @error('category') <x-alert type="danger" :$message /> @enderror
                            </div>
                           
                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" onclick="empty()" id="close_add_task_group_Modal" type="button" id data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif


    {{-- add_user_modal || Update Modal --}}
    @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($module_id == '7' && $create == '1'))
    <div wire:ignore.self class="modal fade" id="add_user_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" onclick="empty()" id="close_add_user_Modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> Task Group </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='add_user'>
                            <div class="mb-3">
                                <input class="form-control" id="gt_id" type="hidden" wire:model="gt_id">
                                <label class="col-form-label" for="category">Category</label>
                                <input class="form-control" id="category" type="text" wire:model="category" disabled />
                                @error('category') <x-alert type="danger" :$message /> @enderror
                            </div>
                            <div class="mb-3">


                                <label class="col-form-label" for="category">Adde User</label>
                                <table class="table table-hover table-striped overflow-hidden">
                                    <thead>
                                        <tr>

                                            <th scope="col">Email</th>
                                            
                                            <th scope="col">Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($results1 as $group)
                                        @php
                                        $result2 = User::where('id', $group->user_id)->pluck('email')->first();
                                        @endphp
                                        <tr class="align-middle">

                                            <td class="text-nowrap">
                                                {{ $result2 }}
                                            </td>
                                            
                                            <td class="text-nowrap">
                                                <button class="btn btn-falcon-danger btn-sm" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="Remove_user('{{ $group->id }}')">Remove</button>
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>

                            <br>
                            <br>

                            <label class="col-form-label" for="category">---------- Select User ----------</label>
                            <br>
                            @foreach ($results as $rest_user)
                            <div class="form-check form-switch form-check-inline">
                                <input class="form-check-input" id="user-{{ $rest_user->user_id }}" type="checkbox" wire:model="users.{{ $rest_user->user_id }}">
                                <label for="user-{{ $rest_user->user_id }}">{{ $rest_user->username }}, {{ $rest_user->role }} {{ $rest_user->user_id }}</label>
                            </div>
                            @endforeach
                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" onclick="empty()" id="close_add_user_Modal" type="button" id="close_add_user_Modal" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif


    {{-- update || Update Modal --}}
    @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($module_id == '7' && $update == '1'))
    <div wire:ignore.self class="modal fade" id="update_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> Task Group </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='update_modal'>
                            <input class="form-control" id="gt_id" type="hidden" wire:model="gt_id" />
                            <div class="mb-3">
                                <label class="col-form-label" for="category">Category</label>
                                <input class="form-control" id="category" type="text" wire:model="category" />
                                @error('category') <x-alert type="danger" :$message /> @enderror
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" onclick="empty()" id="close_update_Modal" type="button" data-bs-dismiss="modal">Close</button>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




<script>
    window.addEventListener('close_add_task_group_Modal', event => {
        console.log('Close modal event triggered');
        var button = document.getElementById("close_add_task_group_Modal");
        button.click();
        // location.reload();

    });
</script>
<script>
    window.addEventListener('close_update_Modal', event => {
        console.log('Close modal event triggered');
        var button = document.getElementById("close_update_Modal");
        button.click();
        // location.reload();

    });
</script>
<script>
    window.addEventListener('close_add_user_Modal', event => {
        console.log('Close modal event triggered');
        var button = document.getElementById("close_add_user_Modal");
        button.click();
        location.reload();
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

        var checkboxFields = document.querySelectorAll('input[type="checkbox"]');
        checkboxFields.forEach(function(checkboxField) {
            checkboxField.checked = false;
        });

    }
</script>