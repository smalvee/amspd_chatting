<div>

    <?php

    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

    // dd($access);
    if ($access_permission == 'User' && $access == null) {
        echo ("Permission denied");
        return url('/project');
    }

    $loged_in_id = Auth::user()->id;


    ?>








    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        const DropArea = document.getElementById("droap-area");
        const Inputfile = document.getElementById("input-file");

        DropArea.addEventListener("dragover", function(e) {
            e.preventDefault();
        });

        DropArea.addEventListener("drop", function(e) {
            e.preventDefault();
            Inputfile.files = e.dataTransfer.files;
        });
    </script>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap');

        /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        } */

        .containerabc {
            height: 100vh;
            width: 100%;
            align-items: center;
            display: flex;
            justify-content: center;
            background-color: #fcfcfc;
        }

        .cardabc {
            border-radius: 10px;
            box-shadow: 0 5px 10px 0 rgba(0, 0, 0, 0.3);
            width: 600px;
            height: 260px;
            background-color: #ffffff;
            padding: 10px 30px 40px;
        }

        .cardabc h3 {
            font-size: 22px;
            font-weight: 600;

        }

        .drop_boxabc {
            margin: 10px 0;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border: 3px dotted #a3a3a3;
            border-radius: 5px;
        }

        #droap-area {
            margin: 10px 0;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border: 3px dotted #a3a3a3;
            border-radius: 5px;
        }

        .drop_boxabc h4 {
            font-size: 16px;
            font-weight: 400;
            color: #2e2e2e;
        }

        .drop_boxabc p {
            margin-top: 10px;
            margin-bottom: 20px;
            font-size: 12px;
            color: #a3a3a3;
        }

        .btnabc {
            text-decoration: none;
            background-color: #005af0;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            outline: none;
            transition: 0.3s;
        }

        .btnabc:hover {
            text-decoration: none;
            background-color: #ffffff;
            color: #005af0;
            padding: 10px 20px;
            border: none;
            outline: 1px solid #010101;
        }

        .formabc input {
            margin: 10px 0;
            width: 100%;
            background-color: #e2e2e2;
            border: none;
            outline: none;
            padding: 12px 20px;
            border-radius: 4px;
        }
    </style>



    <x-breadcrumb title="{{ __('To Do') }}" btn="1" />

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

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                    <?php

                    // dd($task_groups_view);
                    ?>


                    @foreach($task_groups_view as $tsk_view)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link Active" id="pills-{{$tsk_view->id}}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{$tsk_view->id}}" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{$tsk_view->name}}</button>

                    </li>
                    @endforeach

                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @foreach($task_groups_view as $tsk_view)
                    <?php

                    $to_do_view = DB::select('SELECT * FROM to_dos WHERE group_id = ?', [$tsk_view->id]);
                    ?>
                    <div class="tab-pane fade" id="pills-{{$tsk_view->id}}" role="tabpanel" aria-labelledby="pills-{{$tsk_view->id}}-tab" tabindex="0">
                        <div class="card-body d-flex flex-column justify-content-end">
                            <div class="table-responsive scrollbar">

                                <table class="table table-hover table-striped overflow-hidden">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($to_do_view as $todo)
                                        <tr class="align-middle">
                                            <td class="text-nowrap"> {{ $loop->iteration }} </td>
                                            <td style="width: 80%;">
                                                <h4>{{ $todo->title_shown_in_task_list }}</h4>
                                                <br>
                                                <h6>Project Dadeline: {{ $todo->display_deadline }}</h6>
                                                <div>
                                                    <label>Task List:</label>
                                                    <p style="text-align: justify">{{ $todo->place_info }}</p>
                                                </div>
                                                <br>
                                                <div>
                                                    <label>Contents:</label>
                                                    <p style="text-align: justify">{{ $todo->content }}</p>
                                                </div>

                                            </td>

                                            <td class="text-nowrap">
                                                @if ($todo->chat_function_status)
                                                <a href="{{ route('chatting', $todo->id) }}" class="btn btn-falcon-primary btn-sm">Chat</a>
                                                @endif






                                                @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || $access->module_id == '6' && $access->update == '1')
                                                <button type="button" wire:click="Edit_modal({{$todo->id}})" class="btn btn-falcon-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update_modal">Edit</button>
                                                @endif

                                                <button type="button" wire:click="show_data_on_submit_modal({{$todo->id}})" class="btn btn-falcon-warning btn-sm" data-bs-toggle="modal" data-bs-target="#submit_modal">Submit</button>

                                                @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || $access->module_id == '6' && $access->delete == '1')
                                                <button class="btn btn-falcon-danger btn-sm" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" wire:click="delete('{{ $todo->id }}')">Delete</button>
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    {{-- Create || Update Modal --}}
    @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || ($access->module_id == '6' && $access->create == '1'))

    <div wire:ignore.self class="modal fade" id="create_and_edit_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> Task Form </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='submit'>
                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="display_at_task_list_status" wire:model='display_at_task_list_status'>
                                    <label for="display_at_task_list_status">{{ __('Display at task list status') }}</label>
                                </div>
                                @error('display_at_task_list_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="col-form-label" for="group">Group</label>
                                <select class="form-control" id="group" type="text" wire:model="group_id">
                                    <option value="">Select Task Group</option>
                                    @foreach ($task_groups as $task_group)
                                    <option value="{{ $task_group->id }}">{{ $task_group->name }}</option>
                                    @endforeach
                                </select>
                                @error('group_id')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="rebuild_view_member_status" wire:model='rebuild_view_member_status'>
                                    <label for="rebuild_view_member_status">{{ __('Rebuild view member') }}</label>
                                </div>
                                @error('rebuild_view_member_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>



                            <input class="form-control" id="creator" type="hidden" wire:model="created_by" value="{{$loged_in_id}}">

                            <!-- <div class="mb-3">
                                <label class="col-form-label" for="creator">Created by</label>
                                <select class="form-control" id="creator" type="text" wire:model="created_by">
                                    <option value="">Select User</option>
                                    @foreach ($project_users as $project_user)
                                    <option value="{{ $project_user->id }}">{{ $project_user->username }}</option>
                                    @endforeach
                                </select>
                                @error('created_by')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div> -->

                            <div class="mb-3">
                                <label class="col-form-label" for="title_shown_in_task_list">Title shown in Task
                                    List</label>
                                <input class="form-control" id="title_shown_in_task_list" type="text" wire:model="title_shown_in_task_list" />
                                @error('title_shown_in_task_list')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="chat_function_status" wire:model='chat_function_status'>
                                    <label for="chat_function_status">{{ __('Chat function') }}</label>
                                </div>
                                @error('chat_function_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="send_notice_mail_status" wire:model='send_notice_mail_status'>
                                    <label for="send_notice_mail_status">{{ __('Send notice mail') }}</label>
                                </div>
                                @error('send_notice_mail_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="display_after_deadline_expired_status" wire:model='display_after_deadline_expired_status'>
                                    <label for="display_after_deadline_expired_status">{{ __('Display even if the deadline expired.') }}</label>
                                </div>
                                @error('display_after_deadline_expired_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="display_deadline">Deadline for viewing</label>
                                <input class="form-control" id="display_deadline" type="date" wire:model="display_deadline" />
                                @error('display_deadline')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="submission_deadline_status" wire:model='submission_deadline_status'>
                                    <label for="submission_deadline_status">{{ __('Deadline for the submission') }}</label>
                                </div>
                                @error('submission_deadline_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="submission_deadline">Required</label>
                                <input class="form-control" id="submission_deadline" type="date" wire:model="submission_deadline" />
                                @error('submission_deadline')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="meeting_datetime_status" wire:model='meeting_datetime_status'>
                                    <label for="meeting_datetime_status">{{ __('Date & Time for exhibition') }}</label>
                                </div>
                                @error('meeting_datetime_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="meeting_datetime"> Set the meting date & time
                                </label>
                                <input class="form-control" id="meeting_datetime" type="date" wire:model="meeting_datetime" />
                                @error('meeting_datetime')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="place_info">Place info. shown in Task List </label>
                                <textarea class="form-control summernote" wire:model="place_info" id="place_info" cols="30" rows="10"></textarea>
                                @error('place_info')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="sub_title"> Sub title </label>
                                <input class="form-control" id="sub_title" type="text" wire:model="sub_title" />
                                @error('sub_title')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="content">Contents </label>
                                <textarea class="form-control summernote" wire:model="content" id="content" cols="30" rows="10"></textarea>
                                @error('content')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="attachments">Attached files </label>
                                <!-- @livewire('files-upload', ['field_name' => 'attachments', 'multiple' => true])
                                    @error('attachments')
                                        <x-alert type="danger" :$message />
                                    @enderror -->
                                <input id="droap-area" type="file" wire:model="attachments" multiple>




                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="submission_title">Title of submission page</label>
                                <input class="form-control" id="submission_title" type="text" wire:model="submission_title" />
                                @error('submission_title')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="display_theme_list_status" wire:model='display_theme_list_status'>
                                    <label for="display_theme_list_status">{{ __('Display themes list') }}</label>
                                </div>
                                @error('display_theme_list_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="presentation_screen_status" wire:model='presentation_screen_status'>
                                    <label for="presentation_screen_status">{{ __('Presentation screen status') }}</label>
                                </div>
                                @error('presentation_screen_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="presentation_screen_content"> </label>
                                <textarea class="form-control summernote" wire:model="presentation_screen_content" id="presentation_screen_content" cols="30" rows="10"></textarea>
                                @error('presentation_screen_content')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="functional_display_frame_prod_status" wire:model='functional_display_frame_prod_status'>
                                    <label for="functional_display_frame_prod_status">{{ __('Functional display frame prod status') }}</label>
                                </div>
                                @error('functional_display_frame_prod_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="hide_submission_information_status" wire:model='hide_submission_information_status'>
                                    <label for="hide_submission_information_status">{{ __('Hide submission information status') }}</label>
                                </div>
                                @error('hide_submission_information_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="remark_display_status" wire:model='remark_display_status'>
                                    <label for="remark_display_status">{{ __('Remark display status') }}</label>
                                </div>
                                @error('remark_display_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="signature">Signature </label>
                                <textarea class="form-control summernote" wire:model="signature" id="signature" cols="30" rows="10"></textarea>
                                @error('signature')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" onclick="empty()" id="close_button" type="button" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif






    {{-- Update || Update Modal --}}

    @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || $access->module_id == '6' && $access->update == '1')

    <div wire:ignore.self class="modal fade" id="update_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> Task Form </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='update_modal'>
                            <input class="form-controll" type="hidden" wire:model='to_do_id'>
                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="display_at_task_list_status" wire:model='display_at_task_list_status'>
                                    <label for="display_at_task_list_status">{{ __('Display at task list status') }}</label>
                                </div>
                                @error('display_at_task_list_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="col-form-label" for="group">Group</label>
                                <select class="form-control" id="group" type="text" wire:model="group_id">
                                    <option value="">Select Task Group</option>
                                    @foreach ($task_groups as $task_group)
                                    <option value="{{ $task_group->id }}">{{ $task_group->name }}</option>
                                    @endforeach
                                </select>
                                @error('group_id')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="rebuild_view_member_status" wire:model='rebuild_view_member_status'>
                                    <label for="rebuild_view_member_status">{{ __('Rebuild view member') }}</label>
                                </div>
                                @error('rebuild_view_member_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>



                            <input class="form-control" id="creator" type="hidden" wire:model="created_by" value="{{$loged_in_id}}">

                            <!-- <div class="mb-3">
                                <label class="col-form-label" for="creator">Created by</label>
                                <select class="form-control" id="creator" type="text" wire:model="created_by">
                                    <option value="">Select User</option>
                                    @foreach ($project_users as $project_user)
                                    <option value="{{ $project_user->id }}">{{ $project_user->username }}</option>
                                    @endforeach
                                </select>
                                @error('created_by')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div> -->

                            <div class="mb-3">
                                <label class="col-form-label" for="title_shown_in_task_list">Title shown in Task
                                    List</label>
                                <input class="form-control" id="title_shown_in_task_list" type="text" wire:model="title_shown_in_task_list" />
                                @error('title_shown_in_task_list')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="chat_function_status" wire:model='chat_function_status'>
                                    <label for="chat_function_status">{{ __('Chat function') }}</label>
                                </div>
                                @error('chat_function_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="send_notice_mail_status" wire:model='send_notice_mail_status'>
                                    <label for="send_notice_mail_status">{{ __('Send notice mail') }}</label>
                                </div>
                                @error('send_notice_mail_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="display_after_deadline_expired_status" wire:model='display_after_deadline_expired_status'>
                                    <label for="display_after_deadline_expired_status">{{ __('Display even if the deadline expired.') }}</label>
                                </div>
                                @error('display_after_deadline_expired_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="display_deadline">Deadline for viewing</label>
                                <input class="form-control" id="display_deadline" type="date" wire:model="display_deadline" />
                                @error('display_deadline')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="submission_deadline_status" wire:model='submission_deadline_status'>
                                    <label for="submission_deadline_status">{{ __('Deadline for the submission') }}</label>
                                </div>
                                @error('submission_deadline_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="submission_deadline">Required</label>
                                <input class="form-control" id="submission_deadline" type="date" wire:model="submission_deadline" />
                                @error('submission_deadline')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="meeting_datetime_status" wire:model='meeting_datetime_status'>
                                    <label for="meeting_datetime_status">{{ __('Date & Time for exhibition') }}</label>
                                </div>
                                @error('meeting_datetime_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="meeting_datetime"> Set the meting date & time
                                </label>
                                <input class="form-control" id="meeting_datetime" type="date" wire:model="meeting_datetime" />
                                @error('meeting_datetime')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="place_info">Place info. shown in Task List </label>
                                <textarea class="form-control summernote" wire:model="place_info" id="place_info" cols="30" rows="10"></textarea>
                                @error('place_info')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="sub_title"> Sub title </label>
                                <input class="form-control" id="sub_title" type="text" wire:model="sub_title" />
                                @error('sub_title')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="content">Contents </label>
                                <textarea class="form-control summernote" wire:model="content" id="content" cols="30" rows="10"></textarea>
                                @error('content')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="attachments">Attached files </label>
                                <!-- @livewire('files-upload', ['field_name' => 'attachments', 'multiple' => true])
                                    @error('attachments')
                                        <x-alert type="danger" :$message />
                                    @enderror -->
                                <input id="droap-area" type="file" wire:model="attachments" multiple>




                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="submission_title">Title of submission page</label>
                                <input class="form-control" id="submission_title" type="text" wire:model="submission_title" />
                                @error('submission_title')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="display_theme_list_status" wire:model='display_theme_list_status'>
                                    <label for="display_theme_list_status">{{ __('Display themes list') }}</label>
                                </div>
                                @error('display_theme_list_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="presentation_screen_status" wire:model='presentation_screen_status'>
                                    <label for="presentation_screen_status">{{ __('Presentation screen status') }}</label>
                                </div>
                                @error('presentation_screen_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="presentation_screen_content"> </label>
                                <textarea class="form-control summernote" wire:model="presentation_screen_content" id="presentation_screen_content" cols="30" rows="10"></textarea>
                                @error('presentation_screen_content')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="functional_display_frame_prod_status" wire:model='functional_display_frame_prod_status'>
                                    <label for="functional_display_frame_prod_status">{{ __('Functional display frame prod status') }}</label>
                                </div>
                                @error('functional_display_frame_prod_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="hide_submission_information_status" wire:model='hide_submission_information_status'>
                                    <label for="hide_submission_information_status">{{ __('Hide submission information status') }}</label>
                                </div>
                                @error('hide_submission_information_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="remark_display_status" wire:model='remark_display_status'>
                                    <label for="remark_display_status">{{ __('Remark display status') }}</label>
                                </div>
                                @error('remark_display_status')
                                <x-alert type="danger" :$message />
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="col-form-label" for="signature">Signature </label>
                                <textarea class="form-control summernote" wire:model="signature" id="signature" cols="30" rows="10"></textarea>
                                @error('signature')
                                <x-alert type="danger" :$message />
                                @enderror
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



    {{-- submit_modal || Update Modal --}}

    @if($access_permission == 'Super Admin' || $access_permission == 'Admin' || $access->module_id == '6' && $access->update == '1')

    <div wire:ignore.self class="modal fade" id="submit_modal">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-light">
                        <h4 class="mb-1"> Submit Form </h4>
                    </div>
                    <div class="ps-4 pe-4 pb-0">
                        <form wire:submit.prevent='updateProgress'>


                            <div class="card-header">
                                <div class="row flex-between-center">
                                    <div class="col-md">
                                        <h5 class="mb-2 mb-md-0">Submit Your Slide</h5>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card-body d-flex flex-column justify-content-end">
                                <div>
                                    <input class="form-control" id="droap-area" type="file" wire:model="submit_attachment" multiple>
                                    @error('attachments')
                                    <x-alert type="danger" :$message />
                                    @enderror
                                </div>
                                <div id="preview"></div>

                                <button class="form-control btn btn-primary" type="submit">Upload</button>
                            </div>
                            <br>
                            <div style="background-color: #AED6F1; height:10%;">
                                <label style="margin-left: 2%; margin-top:2%; margin-bottom:2%; width: 70%">Uploaded File</label>
                                <label style="margin-left: 2%; margin-top:2%; margin-bottom:2%">Action</label>
                            </div>
                            <div style="width: 100%; background-color:#D6EAF8; height:auto;">
                                <div>
                                    <label style="width: 70%; margin-left:2%;">abcd.doc</label>
                                    <button class="btn btn-danger" style="font-size: small;">Remove</button>
                                </div>
                                <div>
                                    <label style="width: 70%; margin-left:2%;">adbfodfubd.jpg</label>
                                    <button class="btn btn-danger" style="font-size: small;">Remove</button>
                                </div>
                                <div>
                                    <label style="width: 70%; margin-left:2%;">dasfdswgds.png</label>
                                    <button class="btn btn-danger" style="font-size: small;">Remove</button>
                                </div>
                                <div>
                                    <label style="width: 70%; margin-left:2%;">segsegrhh.pdf</label>
                                    <button class="btn btn-danger" style="font-size: small;">Remove</button>
                                </div>

                            </div>
                            <div style="margin-top: 2%; margin-bottom: 2%;">

                                <label>Task Completed (%)</label>
                                <br>
                                <input type="number" id="inputValue" value="40" wire:model="progressinput"/>
                                <br>
                                
                                <label>Progress Bar</label>
                                <div style="width: 60%;" id="statusBar"></div>




                                <!-- <div id="progressbar" onmousedown="startDrag(event)">
                                    <div id="progress"></div>
                                </div>

                                <div id="progressValue"></div>

                                <input type="number" id="progressInputfeild" value="14" wire:model="progressinput"> -->





                            </div>
                            <div style="margin-top: 2%; margin-bottom: 2%;">
                                <label>Report</label>
                                <textarea class="form-control" placeholder="Sharing today's weekly report"></textarea>
                            </div>




                            <div class="mb-3 text-center">
                                <button class="btn btn-secondary" onclick="empty()" id="close_update_Modal" type="button" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Submit </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- <script>
        function updateStatusBar() {
            // Get the input value
            var inputValue = document.getElementById('inputValue').value;

            // Get the status bar element
            var statusBar = document.getElementById('statusBar');

            // Set the width of the status bar based on the input value
            statusBar.style.width = inputValue + '%';
        }
    </script> -->



    <!-- <script>
        var isDragging = false;

        function startDrag(event) {
            isDragging = true;
            document.addEventListener('mousemove', handleDrag);
            document.addEventListener('mouseup', stopDrag);
            handleDrag(event);
        }

        function handleDrag(event) {
            if (isDragging) {
                var progressBar = document.getElementById('progressbar');
                var progress = document.getElementById('progress');
                var progressValue = document.getElementById('progressValue');

                // Calculate the percentage of the dragged position relative to the progress bar width
                var percentage = (event.clientX - progressBar.getBoundingClientRect().left) / progressBar.clientWidth * 100;

                // Ensure the percentage is within the valid range (0 to 100)
                percentage = Math.min(100, Math.max(0, percentage));

                // Round the percentage to the nearest integer
                var roundedPercentage = Math.round(percentage);

                // Update the progress bar width and value
                progress.style.width = roundedPercentage + '%';

                // Update the progress value element
                progressValue.textContent = 'Progress: ' + roundedPercentage + '%';

                // Update the input field value
                var newValue = roundedPercentage;

                document.getElementById("progressInputfeild").value = newValue;
            }
        }

        function stopDrag() {
            isDragging = false;
            document.removeEventListener('mousemove', handleDrag);
            document.removeEventListener('mouseup', stopDrag);
        }
    </script> -->









    <script>
        $('.summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>

    <script>
        window.addEventListener('closeModal', event => {
            console.log('Close modal event triggered');
            var button = document.getElementById("close_button");
            button.click();

        });
    </script>
    <script>
        window.addEventListener('close_update_Modal', event => {
            console.log('Close modal event triggered');
            var button = document.getElementById("close_update_Modal");
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
</div>