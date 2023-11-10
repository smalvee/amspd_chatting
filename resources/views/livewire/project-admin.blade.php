<div>
    <x-breadcrumb title="{{ __('Project Admin') }}" @superadmin btn="1" @endsuperadmin/>
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
                            <input class="form-control" type="search" placeholder="Search">
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="table-responsive scrollbar">
                        <table class="table table-hover table-striped overflow-hidden">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="align-middle">
                                    <td class="text-nowrap">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xl">
                                                <img class="rounded-circle" src="../../assets/img/team/4.jpg"
                                                    alt="" />
                                            </div>
                                            <div class="ms-2">{{ $user->name }}</div>
                                        </div>
                                    </td>
                                    <td class="text-nowrap">{{ $user->email }}</td>
                                    <td class="text-nowrap">
                                        <button class="btn btn-falcon-primary btn-sm">Edit</button>
                                        <button class="btn btn-falcon-danger btn-sm">Delete</button>
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
    <div wire:ignore.self class="modal fade" id="create_and_edit_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> Project Admin </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='submit'>
                            <div class="mb-3">
                                <label class="col-form-label" for="name">Name:</label>
                                <input class="form-control" id="name" type="text" wire:model="name" />
                                 @error('name') <x-alert type="danger" :$message /> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="email">Email:</label>
                                <input class="form-control" id="email" type="email" wire:model="email" />
                                 @error('email') <x-alert type="danger" :$message /> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="password">Password:</label>
                                <input class="form-control" id="password" type="password" wire:model="password" />
                                 @error('password') <x-alert type="danger" :$message /> @enderror
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <label class="col-form-label" for="email-for-invitation">Email for invitation:</label>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email Address"
                            wire:model="invitation_email">
                        <button class="btn btn-outline-secondary" type="button" id="email-for-invitation"
                            wire:click="invitation">Send Invitation</button>
                    </div>
                    @error('invitation_email') <x-alert type="danger" :$message /> @enderror
                </div>
            </div>
        </div>
    </div>
</div>
