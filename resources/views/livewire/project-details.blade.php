<div>
    <x-breadcrumb title="{{ __('Project') }} / {{ $project->name }}" />
    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row flex-between-center">
                        <div class="col-md">
                            <h5 class="mb-2 mb-md-0">
                                Task
                            </h5>
                        </div>
                        <div class="col-auto">
                            <input class="form-control" type="search" placeholder="Search" wire:model="search">
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="table-responsive scrollbar">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th class="text-end" scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ricky Antony</td>
                                    <td>ricky@example.com</td>
                                    <td class="text-end">
                                        <div>
                                            <a href="{{ route('project.chatting', ['project_id' => $s_active_project->id]) }}" class="btn btn-link p-0">Chat</a>
                                            <button class="btn btn-link p-0" type="button" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><span
                                                    class="text-500 fas fa-edit"></span></button><button
                                                class="btn btn-link p-0 ms-2" type="button" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><span
                                                    class="text-500 fas fa-trash-alt"></span></button></div>
                                    </td>
                                </tr>
                                <tr class="table-active">
                                    <td>Emma Watson</td>
                                    <td>emma@example.com</td>
                                    <td class="text-end">
                                        <div>
                                            <a href="{{ route('project.chatting', ['project_id' => $s_active_project->id]) }}" class="btn btn-link p-0">Chat</a>
                                            <button class="btn btn-link p-0" type="button" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><span
                                                    class="text-500 fas fa-edit"></span></button><button
                                                class="btn btn-link p-0 ms-2" type="button" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><span
                                                    class="text-500 fas fa-trash-alt"></span></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Rowen Atkinson</td>
                                    <td>rown@example.com</td>
                                    <td class="text-end">
                                        <div>
                                            <a href="{{ route('project.chatting', ['project_id' => $s_active_project->id]) }}" class="btn btn-link p-0">Chat</a>
                                            <button class="btn btn-link p-0" type="button" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><span
                                                    class="text-500 fas fa-edit"></span></button><button
                                                class="btn btn-link p-0 ms-2" type="button" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><span
                                                    class="text-500 fas fa-trash-alt"></span></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Antony Hopkins</td>
                                    <td class="table-active">antony@example.com</td>
                                    <td class="text-end">
                                        <div>
                                            <a href="{{ route('project.chatting', ['project_id' => $s_active_project->id]) }}" class="btn btn-link p-0">Chat</a>
                                            <button class="btn btn-link p-0" type="button" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><span
                                                    class="text-500 fas fa-edit"></span></button><button
                                                class="btn btn-link p-0 ms-2" type="button" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><span
                                                    class="text-500 fas fa-trash-alt"></span></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jennifer Schramm</td>
                                    <td>jennifer@example.com</td>
                                    <td class="text-end">
                                        <div>
                                            <a href="{{ route('project.chatting', ['project_id' => $s_active_project->id]) }}" class="btn btn-link p-0">Chat</a>
                                            <button class="btn btn-link p-0" type="button" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit"><span
                                                    class="text-500 fas fa-edit"></span></button><button
                                                class="btn btn-link p-0 ms-2" type="button" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><span
                                                    class="text-500 fas fa-trash-alt"></span></button></div>
                                    </td>
                                </tr>
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
                        <h4 class="mb-1"> Project </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='submit'>
                            <div class="mb-3">
                                <label class="col-form-label" for="en_name">Name (en):</label>
                                <input class="form-control" id="en_name" type="text" wire:model="en_name" />
                                @error('en_name')
                                    <x-alert type="danger" :$message />
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="jp_name">Name (jp):</label>
                                <input class="form-control" id="jp_name" type="text" wire:model="jp_name" />
                                @error('jp_name')
                                    <x-alert type="danger" :$message />
                                @enderror
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
                                <button class="btn btn-secondary" type="button"
                                    data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
