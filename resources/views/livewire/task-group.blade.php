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
                                    @admin
                                    <td class="text-nowrap">
                                        <!-- <button class="btn btn-falcon-primary btn-sm">Edit</button>  -->
                                        <button type="button" wire:click="Edit_modal({{$group->id}})" class="btn btn-falcon-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update_modal">Edit</button>
                                        <button class="btn btn-falcon-danger btn-sm" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete('{{ $group->id }}')">Delete</button>
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
                            @foreach ($project_users as $user)
                            <div class="form-check form-switch form-check-inline">
                                <input class="form-check-input" id="user-{{ $user->id }}" type="checkbox" wire:model="users.{{ $user->id }}">
                                <label for="user-{{ $user->id }}">{{ $user->username }}, {{ $user->role }}</label>
                            </div>
                            @endforeach
                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" id="close_button" type="button" id data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endadmin

    {{-- update || Update Modal --}}
    @admin
    <div wire:ignore.self class="modal fade" id="update_modal">
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
                        <form wire:submit.prevent='update_modal'>
                            <input class="form-control" id="gt_id" type="hidden" wire:model="gt_id" />
                            <div class="mb-3">
                                <label class="col-form-label" for="category">Category</label>
                                <input class="form-control" id="category" type="text" wire:model="category" />
                                @error('category') <x-alert type="danger" :$message /> @enderror
                            </div>
                            @foreach ($project_users as $user)
                            <div class="form-check form-switch form-check-inline">
                                <input class="form-check-input" id="user-{{ $user->id }}" type="checkbox" wire:model="users.{{ $user->id }}">
                                <label for="user-{{ $user->id }}">{{ $user->username }}, {{ $user->role }}</label>
                            </div>
                            @endforeach
                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" id="close_button" type="button" data-bs-dismiss="modal">Close</button>
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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




<script>
    window.addEventListener('closeModal', event => {
        console.log('Close modal event triggered');
        var button = document.getElementById("close_button");
        button.click();
        
    });
</script>


