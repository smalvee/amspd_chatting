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
                        <table class="table table-hover table-striped overflow-hidden">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User ID</th>                                   
                                    <th scope="col">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $info)
                                <tr class="align-middle">
                                    <td class="text-nowrap"> {{ $loop->iteration }} </td>
                                    <td class="text-nowrap">
                                    {{$info->user_id}}
                                    </td>
                                   
                                    <td class="text-nowrap">
                                        <!-- <button class="btn btn-falcon-primary btn-sm">Edit</button>  -->
                                        <button type="button" wire:click="Edit_modal({{$info->id}})" class="btn btn-falcon-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update_modal">Edit</button>
                                        <button class="btn btn-falcon-danger btn-sm" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete('{{ $info->id }}')">Delete</button>
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
                                    <option value="">User List</option>
                                    @foreach($all_users as $a_u)
                                    <option value="{{$a_u->id}}">{{$a_u->email}}({{$a_u->id}})</option>
                                    @endforeach
                                </select>
                                @error('user_id') <x-alert type="danger" :$message /> @enderror


                                <label for="organizerSingle">Select Project</label>
                                <select class="form-select js-choice" id="project_id" wire:model="project_id" size="1" name="organizerSingle" data-options='{"removeItemButton":true,"placeholder":true}'>
                                    <option value="">User List</option>
                                    @foreach($all_projects as $pro)
                                    <option value="{{$pro->id}}">{{$pro->name}}</option>
                                    @endforeach
                                </select>
                                @error('project_id') <x-alert type="danger" :$message /> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="default_access">Permission As</label>
                                <!-- <input class="form-control" id="permission_as" type="text" wire:model="permission_as" /> -->
                                <select class="form-control" id="default_access" type="text" wire:model="default_access">
                                    <option>Selcet One</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Super Admin">Super Admin</option>
                                </select>
                                @error('permission_as') <x-alert type="danger" :$message /> @enderror

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







    {{-- edit || Update Modal --}}
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
                        <form wire:submit.prevent='submit'>
                            <div class="mb-3">
                                <label class="col-form-label" for="name">Role</label>
                                <input class="form-control" id="name" type="text" wire:model="name" />
                                @error('name') <x-alert type="danger" :$message /> @enderror
                                @error('permissions') <br> <x-alert type="danger" :$message /> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="permission_as">Permission As</label>
                                <!-- <input class="form-control" id="permission_as" type="text" wire:model="permission_as" /> -->
                                <select class="form-control" id="permission_as" type="text" wire:model="permission_as">
                                    <option>Selcet One</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Super Admin">Super Admin</option>
                                </select>
                                @error('permission_as') <x-alert type="danger" :$message /> @enderror
                                @error('permissions') <br> <x-alert type="danger" :$message /> @enderror
                            </div>
                            <div class="mb-3">
                                <table class="table table-hover table-striped overflow-hidden">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Module</th>
                                            <th>Create</th>
                                            <th>Read</th>
                                            <th>Update</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="align-middle">
                                            <td class="text-nowrap"> 1 </td>
                                            <td class="text-nowrap">User</td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.user.create'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.user.read'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.user.update'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.user.delete'>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="align-middle">
                                            <td class="text-nowrap"> 2 </td>
                                            <td class="text-nowrap">To Do List</td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.todo.create'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.todo.read'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.todo.update'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.todo.delete'>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="align-middle">
                                            <td class="text-nowrap"> 3 </td>
                                            <td class="text-nowrap">To Do Category</td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.todo-category.create'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.todo-category.read'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.todo-category.update'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.todo-category.delete'>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="align-middle">
                                            <td class="text-nowrap"> 4 </td>
                                            <td class="text-nowrap">Event</td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.event.create'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.event.read'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.event.update'>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch form-check-inline">
                                                    <input class="form-check-input" type="checkbox" wire:model='permissions.event.delete'>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Submit </button>
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