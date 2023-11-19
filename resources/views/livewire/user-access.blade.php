<?php

use Illuminate\Support\Facades\DB;
?>
<div>
    <x-breadcrumb title="{{ __('Access') }}" @admin btn="1" @endadmin />
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
                        <table class="table table-hover table-striped overflow-hidden" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User Name (ID)</th>
                                    <th scope="col">Project Name (ID)</th>
                                    <th scope="col">status</th>
                                    <th scope="col">Create</th>
                                    <th scope="col">Read</th>
                                    <th scope="col">Update</th>
                                    <th scope="col">Delete</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $info)

                                <?php

                                $q1 = "SELECT name FROM projects WHERE id = $info->project_id";
                                $p_name = DB::select($q1);

                                foreach ($p_name as $p) {
                                    $p->name;
                                }
                                $jsonString = $p->name;
                                $data = json_decode($jsonString, true);
                                if (isset($data['en'])) {
                                    $p_name = $data['en'];
                                }

                                $q2 = "SELECT name FROM users WHERE id = $info->user_id";
                                $u_name = DB::select($q2);

                                foreach ($u_name as $u) {
                                    $name = $u->name;
                                }

                                if($info->status == 1)
                                {
                                    $status = 'Active';
                                }else{
                                    $status = 'Inactive';
                                }

                                ?>


                                <tr class="align-middle">
                                    <td class="text-nowrap"> {{ $loop->iteration }} </td>
                                    <td class="text-nowrap">{{ $name }} ({{$info->user_id}})</td>



                                    <td class="text-nowrap">{{$p_name}}({{$info->project_id}})</td>

                                    <td class="text-nowrap">{{$status}}</td>

                                    <td class="text-nowrap">
                                        <?php
                                        if ($info->create == 1) { ?>
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        <?php } else print('----')
                                        ?>
                                    </td>

                                    <td class="text-nowrap">
                                        <?php
                                        if ($info->read == 1) { ?>
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        <?php } else print('----')
                                        ?>
                                    </td>

                                    <td class="text-nowrap">
                                        <?php
                                        if ($info->update == 1) { ?>
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        <?php } else print('----')
                                        ?>
                                    </td>

                                    <td class="text-nowrap">
                                        <?php
                                        if ($info->delete == 1) { ?>
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        <?php } else print('----')
                                        ?>
                                    </td>
                                    @admin

                                    <td class="text-nowrap">
                                        <!-- <button class="btn btn-falcon-primary btn-sm">Edit</button>  -->
                                        <button type="button" wire:click="Edit_modal({{$info->id}})" class="btn btn-falcon-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update_modal">Edit</button>
                                        <button class="btn btn-falcon-danger btn-sm" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete('{{ $info->id }}')">Delete</button>
                                    </td>
                                    @endadmin

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
    @admin
    <div wire:ignore.self class="modal fade" id="create_and_edit_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> Access </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='submit'>
                            <div class="mb-3">
                                <label for="organizerSingle">Select User</label>
                                <select class="form-select js-choice" id="user_id" wire:model="user_id" size="1" name="organizerSingle" data-options='{"removeItemButton":true,"placeholder":true}'>
                                    <option value="">Select User</option>
                                    @foreach($all_users as $a_u)
                                    <option value="{{$a_u->id}}">{{$a_u->email}}({{$a_u->id}})</option>
                                    @endforeach
                                </select>
                                @error('user_id') <x-alert type="danger" :$message /> @enderror


                                <label for="organizerSingle">Select Project</label>
                                <select class="form-select js-choice" id="project_id" wire:model="project_id" size="1" name="organizerSingle" data-options='{"removeItemButton":true,"placeholder":true}'>
                                    <option value="">Select Project</option>
                                    @foreach($all_projects as $pro)
                                    <option value="{{$pro->id}}">{{$pro->name}}</option>
                                    @endforeach
                                </select>
                                @error('project_id') <x-alert type="danger" :$message /> @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="col-form-label" for="Custom_permission">Customize Permission</label>

                                <table class="table table-hover table-striped overflow-hidden">
                                    <thead>
                                        <tr>

                                            <th>Create</th>
                                            <th>Read</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="align-middle">


                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="create" wire:model='create'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="read" wire:model='read'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="update" wire:model='update'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="delete" wire:model='delete'>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> Access </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='update'>
                            <div class="mb-3">
                                <label for="organizerSingle">Select User</label>
                                <input class="form-control" id="a_id" type="hidden" wire:model="a_id" />
                                <select class="form-select js-choice" id="user_id" wire:model="user_id" size="1" name="organizerSingle" data-options='{"removeItemButton":true,"placeholder":true}' disabled>
                                    <option value="">User List</option>
                                    @foreach($all_users as $a_u)
                                    <option value="{{$a_u->id}}">{{$a_u->email}}({{$a_u->id}})</option>
                                    @endforeach
                                </select>
                                @error('user_id') <x-alert type="danger" :$message /> @enderror


                                <label for="organizerSingle">Select Project</label>
                                <select class="form-select js-choice" id="project_id" wire:model="project_id" size="1" name="organizerSingle" data-options='{"removeItemButton":true,"placeholder":true}' disabled>
                                    <option value="">User List</option>
                                    @foreach($all_projects as $pro)
                                    <option value="{{$pro->id}}">{{$pro->name}}</option>
                                    @endforeach
                                </select>
                                @error('project_id') <x-alert type="danger" :$message /> @enderror

                                
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="Custom_permission">Access Status</label>

                                <table class="table table-hover table-striped overflow-hidden">
                                    <thead>
                                        <tr style="text-align: center;">

                                            <th>Active/Inactive</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="align-middle" style="text-align: center;">


                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox"  wire:model='status'>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mb-3">
                                <label class="col-form-label" for="Custom_permission">Customize Permission</label>

                                <table class="table table-hover table-striped overflow-hidden">
                                    <thead>
                                        <tr>

                                            <th>Create</th>
                                            <th>Read</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="align-middle">


                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="create" wire:model='create'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="read" wire:model='read'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="update" wire:model='update'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="delete" wire:model='delete'>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" onclick="empty()" id="close_button_u" type="button" data-bs-dismiss="modal">Close</button>
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
    window.addEventListener('closeModalc', event => {
        console.log('Close modal event triggered');
        var button = document.getElementById("close_button");
        button.click();

    });
</script>
<script>
    window.addEventListener('closeModalu', event => {
        console.log('Close modal event triggered');
        var button = document.getElementById("close_button_u");
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

        var checkboxFields = document.querySelectorAll('input[type="checkbox"]');
        checkboxFields.forEach(function(checkboxField) {
            checkboxField.checked = false;
        });

    }
</script>