<div>
    <x-breadcrumb title="{{ __('Role') }}" @admin btn="1" @endadmin />
    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="table-responsive scrollbar">
                        <table class="table table-hover table-striped overflow-hidden">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Role Name</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr class="align-middle">
                                    <td class="text-nowrap"> {{ $loop->iteration }} </td>
                                    <td class="text-nowrap"> {{ $role->role }}</td>

                                    <td class="text-nowrap">
                                        @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($access->module_id == '12' && $access->update == '1'))
                                        <button type="button" wire:click="Edit_modal({{$role->id}})" class="btn btn-falcon-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update_modal">Edit</button>
                                        @endif

                                        @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($access->module_id == '12' && $access->delete == '1'))
                                        <button class="btn btn-falcon-danger btn-sm" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete_role({{ $role->id }})">Delete</button>
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
                                <label class="col-form-label" for="name">Role</label>
                                <input class="form-control" id="name" type="text" wire:model="name" />
                                @error('name') <x-alert type="danger" :$message /> @enderror
                                @error('permissions') <br> <x-alert type="danger" :$message /> @enderror
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

    {{-- Edit || Update Modal --}}
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



</div>



<script>
    window.addEventListener('closeModal', event => {
        console.log('Close modal event triggered');
        var button = document.getElementById("close_button");
        button.click();

    });
</script>