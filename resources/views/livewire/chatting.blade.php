<?php

use Illuminate\Support\Facades\Auth;

$chat_sender_id = Auth::user()->email;

?>

<div>
    {{-- <x-breadcrumb title="{{ __('Chatting') }}" @superAdminOrAdmin btn="1" @endSuperAdminOrAdmin /> --}}
    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card card-chat overflow-hidden">
                <div class="card-body d-flex p-0 h-100">
                    <div class="chat-sidebar">
                        <div class="contacts-list scrollbar-overlay">
                            <div class="nav nav-tabs border-0 flex-column" role="tablist" aria-orientation="vertical">

                                <!-- Total User Start -->
                                <div class="hover-actions-trigger chat-contact nav-item active" role="tab" id="chat-link-0" data-bs-toggle="tab" data-bs-target="#chat-0" aria-controls="chat-0" aria-selected="true">
                                    <div class="d-flex p-3">
                                        <div class="avatar avatar-xl status-online">
                                            <img class="rounded-circle" src="../assets/img/team/avatar.png" alt="" />
                                        </div>
                                        <div class="flex-1 chat-contact-body ms-2 d-md-none d-lg-block">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-0 chat-contact-title">Total User</h6>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="chat-contact-content pe-3"> {{$count}} Users</div>
                                                <div class="position-absolute bottom-0 end-0 hover-hide"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Total User End -->

                                <hr>
                                <!-- chat User List start -->
                                <div class="hover-actions-trigger">
                                    @foreach($to_do_admin as $admin)
                                    <div class="d-flex p-3">

                                        <div class="avatar avatar-xl">
                                            <img class="rounded-circle" src="../assets/img/team/avatar.png" alt="" />
                                        </div>
                                        <div class="flex-1 chat-contact-body ms-2 d-md-none d-lg-block">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-0 chat-contact-title">{{$admin->name}}</h6>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="chat-contact-content pe-3">{{$admin->type}}</div>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <hr>

                                    @foreach($to_do_user_list as $chat_user)
                                    <div class="d-flex p-3">
                                        <div class="avatar avatar-xl">
                                            <img class="rounded-circle" src="../assets/img/team/avatar.png" alt="" />
                                        </div>
                                        <div class="flex-1 chat-contact-body ms-2 d-md-none d-lg-block">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-0 chat-contact-title">{{$chat_user->name}}</h6>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="chat-contact-content pe-3">{{$chat_user->role}}</div>

                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <!-- chat User List end -->


                            </div>
                        </div>
                        <form class="contacts-search-wrapper">
                            <div class="form-group mb-0 position-relative d-md-none d-lg-block w-100 h-100"><input class="form-control form-control-sm chat-contacts-search border-0 h-100" type="text" placeholder="Search contacts ..." /><span class="fas fa-search contacts-search-icon"></span></div>
                            <button class="btn btn-sm btn-transparent d-none d-md-inline-block d-lg-none"><span class="fas fa-search fs--1"></span></button>
                        </form>
                    </div>

                    <!-- chat Body Start -->
                    <div class="tab-content card-chat-content">
                        <div class="tab-pane card-chat-pane active" id="chat-0" role="tabpanel" aria-labelledby="chat-link-0">

                            <div class="chat-content-header">
                                <div class="row flex-between-center">
                                    <div class="col-6 col-sm-8 d-flex align-items-center"><a class="pe-3 text-700 d-md-none contacts-list-show" href="#!">
                                            <!-- <div class="fas fa-chevron-left"></div> -->
                                        </a>
                                        <div class="min-w-0">
                                            
                                            <h5 style="max-width: 400px" class="mb-0 text-truncate fs-0">{{$to_do_head_line}}</h5>
                                            
                                            <!-- <div class="fs--2 text-400">Active On Chat</div> -->
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('chat-file', $to_do_id_chat) }}">
                                            <button class="btn btn-sm btn-falcon-primary btn-chat-info" type="button" title="Conversation File Information">
                                                <span class="fas fa-info"></span>
                                            </button>
                                        </a>

                                    </div>
                                </div>
                            </div>

                            <div class="chat-content-body" style="display: inherit;">

                                <!-- Share media info Start -->
                                <!-- <div class="conversation-info" data-index="0">
                                    <div class="h-100 overflow-auto scrollbar">
                                        <hr class="my-2" />
                                        <div class="px-3" id="others-info-0">
                                            <div class="title" id="shared-media-title-0"><a class="btn btn-link btn-accordion hover-text-decoration-none dropdown-indicator" href="#shared-media-0" data-bs-toggle="collapse" aria-expanded="false" aria-controls="shared-media-0">Shared media</a></div>
                                            <div class="collapse" id="shared-media-0" aria-labelledby="shared-media-title-0" data-parent="#others-info-0">
                                                <div class="row mx-n1">
                                                    <div class="col-6 col-md-4 px-1"><a href="../assets/img/chat/1.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="../assets/img/chat/1.jpg" alt="" /></a></div>
                                                    <div class="col-6 col-md-4 px-1"><a href="../assets/img/chat/2.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="../assets/img/chat/2.jpg" alt="" /></a></div>
                                                    <div class="col-6 col-md-4 px-1"> <a href="../assets/img/chat/3.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="../assets/img/chat/3.jpg" alt="" /></a></div>
                                                    <div class="col-6 col-md-4 px-1"> <a href="../assets/img/chat/4.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="../assets/img/chat/4.jpg" alt="" /></a></div>
                                                    <div class="col-6 col-md-4 px-1"> <a href="../assets/img/chat/5.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="../assets/img/chat/5.jpg" alt="" /></a></div>
                                                    <div class="col-6 col-md-4 px-1"> <a href="../assets/img/chat/6.jpg" data-gallery="images-1"><img class="img-fluid rounded-1 mb-2" src="../assets/img/chat/6.jpg" alt="" /></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- Share media info End -->


                                <div class="chat-content-scroll-area scrollbar">

                                    @foreach($chat as $item)


                                    @if($item->user_id != Auth::user()->name)
                                    <!-- chat of other user start -->
                                    <div class="d-flex p-3">
                                        <div class="avatar avatar-l me-2">
                                            <img class="rounded-circle" src="../assets/img/team/avatar.png" alt="" />
                                        </div>
                                        <div class="flex-1">
                                            <div class="w-xxl-75">
                                                <div class="text-400 fs--2"><span>{{ $item->user_id }}</span></div>
                                                <div class="hover-actions-trigger d-flex align-items-center">
                                                    <div class="chat-message bg-200 p-2 rounded-2">{{ $item->chat_details }}
                                                        <br>

                                                        @if($item->attachments != null)

                                                        @php
                                                        $fileInfo = pathinfo($item->attachments);
                                                        $fileExtension = strtolower($fileInfo['extension']);
                                                        @endphp

                                                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                                        {{-- Display an image --}}
                                                        <img src="{{ Storage::url('public/chat_file/' . $item->attachments) }}" alt="Image">
                                                        <br>

                                                        @elseif (in_array($fileExtension, ['pdf']))
                                                        {{-- Display a PDF file --}}
                                                        <embed src="{{ Storage::url('public/chat_file/' . $item->attachments) }}" type="application/pdf" width="100%" height="100%">
                                                        <br>

                                                        @elseif (in_array($fileExtension, ['mp4', 'avi', 'mov']))
                                                        {{-- Display a video --}}
                                                        <video width="320" height="240" controls>
                                                            <source src="{{ Storage::url('public/chat_file/' . $item->attachments) }}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                        <br>
                                                        @endif

                                                        <a target="_blank" style="color: black;" href="{{ Storage::url('public/chat_file/' . $item->attachments) }}">{{ $item->attachments }}</a>
                                                        @endif
                                                    </div>

                                                    <!-- <ul class="hover-actions position-relative list-inline mb-0 text-400 ms-2">
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Forward"><span class="fas fa-share"></span></a></li>
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Archive"><span class="fas fa-archive"></span></a></li>
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-edit"></span></a></li>
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><span class="fas fa-trash-alt"></span></a></li>
                                                    </ul> -->
                                                </div>
                                                <div class="text-400 fs--2"><span>{{ $item->created_at }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- chat of other user end -->
                                    @endif

                                    @if($item->user_id == Auth::user()->name)
                                    <!-- chat of Loged in user Start -->
                                    <div class="d-flex p-3">
                                        <div class="flex-1 d-flex justify-content-end">
                                            <div class="w-100 w-xxl-75">
                                                <div class="text-400 fs--2 text-end">{{ $item->user_id }}</div>
                                                <div class="hover-actions-trigger d-flex flex-end-center">
                                                    <!-- <ul class="hover-actions position-relative list-inline mb-0 text-400 me-2">
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Forward"><span class="fas fa-share"></span></a></li>
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Archive"><span class="fas fa-archive"></span></a></li>
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-edit"></span></a></li>
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><span class="fas fa-trash-alt"></span></a></li>
                                                    </ul> -->
                                                    <div class="bg-primary text-white p-2 rounded-2 chat-message" data-bs-theme="light">{{ $item->chat_details }}
                                                        <br>

                                                        @if($item->attachments != null)

                                                        @php
                                                        $fileInfo = pathinfo($item->attachments);
                                                        $fileExtension = strtolower($fileInfo['extension']);
                                                        @endphp

                                                        @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                                        {{-- Display an image --}}
                                                        <img src="{{ Storage::url('public/chat_file/' . $item->attachments) }}" alt="Image">
                                                        <br>

                                                        @elseif (in_array($fileExtension, ['pdf']))
                                                        {{-- Display a PDF file --}}
                                                        <embed src="{{ Storage::url('public/chat_file/' . $item->attachments) }}" type="application/pdf" width="100%" height="100%">
                                                        <br>

                                                        @elseif (in_array($fileExtension, ['mp4', 'avi', 'mov']))
                                                        {{-- Display a video --}}
                                                        <video width="320" height="240" controls>
                                                            <source src="{{ Storage::url('public/chat_file/' . $item->attachments) }}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                        <br>
                                                        @endif

                                                        <a target="_blank" style="color: white;" href="{{ Storage::url('public/chat_file/' . $item->attachments) }}">{{ $item->attachments }}</a>
                                                        @endif

                                                    </div>

                                                </div>
                                                <div class="text-400 fs--2 text-end">{{ $item->created_at }}
                                                    <!-- <span class="fas fa-check ms-2 text-success"></span> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- chat of Loged in user End -->
                                    @endif
                                    @endforeach


                                </div>


                            </div>
                        </div>




                        <form wire:submit.prevent='submit' class="chat-editor-area">
                            <!-- <div class="emojiarea-editor outline-none scrollbar" contenteditable="true"></div> -->
                            <input class="emojiarea-editor outline-none scrollbar" id="chat_details" wire:model='chat_details' type="text" contenteditable="true" style="border: none;">
                            <input class="d-none" type="file" id="chat-file-upload" wire:model="attachments" />
                            <label class="chat-file-upload cursor-pointer" for="chat-file-upload">
                                <span class="fas fa-paperclip"></span>
                            </label>
                            <!-- <div class="btn btn-link emoji-icon" data-picmo="data-picmo" data-picmo-input-target=".emojiarea-editor">
                                <span class="far fa-laugh-beam"></span>
                            </div> -->
                            <button class="btn btn-sm btn-send shadow-none" type="submit">Send</button>
                        </form>
                    </div>
                    <!-- chat Body End -->

                </div>
            </div>
        </div>
    </div>
</div>













<div>
    <div class="row g-3 mb-3">
        <div class="col-md-12">
            <div class="card">
                <form method="post" action="{{ route('send_chat_file', ['to_do_id_chat' => $to_do_id_chat]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <div class="row flex-between-center">
                            <div class="col-md">
                                <h5 class="mb-2 mb-md-0">File Upload Section</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end">
                        <div>
                            <input class="form-control" type="file" id="attachments" name="attachments" required>
                            @error('attachments')
                            <x-alert type="danger" :$message />
                            @enderror
                        </div>
                        <div id="preview"></div>

                        <button class="form-control btn btn-primary" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<script>
    document.getElementById('attachments').addEventListener('change', handleFileSelect);

    function handleFileSelect(event) {
        const files = event.target.files;

        if (files.length === 0) {
            return;
        }

        const previewContainer = document.getElementById('preview');
        previewContainer.innerHTML = ''; // Clear previous previews

        for (const file of files) {
            const previewElement = document.createElement('div');
            previewElement.className = 'file-preview';

            // Check if the file type is an image (jpg or png)
            if (file.type.startsWith('image/')) {
                const previewImage = document.createElement('img');
                previewImage.className = 'preview-image';
                previewImage.src = URL.createObjectURL(file);
                previewElement.appendChild(previewImage);
            } else {
                // Display a generic file icon for other file types
                const fileIcon = document.createElement('img');
                fileIcon.className = 'file-icon';
                fileIcon.src = getFileIcon(file.type);
                previewElement.appendChild(fileIcon);

                const fileName = document.createElement('span');
                fileName.textContent = file.name;
                previewElement.appendChild(fileName);
            }

            previewContainer.appendChild(previewElement);
        }
    }

    function getFileIcon(fileType) {
        // Replace these icons with your own or use a library for more options
        switch (fileType) {
            case 'application/pdf':
                return 'pdf-icon.png'; // Replace with your PDF icon
                // Add more cases for different file types
            default:
                return 'generic-file-icon.png'; // Replace with a generic file icon
        }
    }
</script>

















<!-- <script>
    $(document).ready(function() {

        function update_message_panel() {

            $('.chat-content-scroll-area').scrollTop($('.chat-content-scroll-area')[0].scrollHeight);

            @this.set('refresh_count', Math.floor(Math.random() * 10));
            setTimeout(update_message_panel, 1000); // Change in every 1 second
        }

        // Start the change cycle
        update_message_panel();
    });
</script> -->

<script>
    $(document).ready(function() {

        function update_message_panel() {

            var autoScrollEnabled = true;

            $('.chat-content-scroll-area').on('scroll', function() {
                // Check if the user is actively scrolling
                if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                    // User is at the bottom, enable auto-scrolling
                    autoScrollEnabled = true;
                } else {
                    // User is manually scrolling, disable auto-scrolling
                    autoScrollEnabled = false;
                }
            });

            // Function to handle auto-scrolling
            function autoScroll() {
                if (autoScrollEnabled) {
                    $('.chat-content-scroll-area').scrollTop($('.chat-content-scroll-area')[0].scrollHeight);
                }
            }

            // Call the autoScroll function periodically to check if auto-scrolling is enabled
            setInterval(autoScroll, 5000); // Adjust the interval as needed

            @this.set('refresh_count', Math.floor(Math.random() * 10));
            setTimeout(update_message_panel, 1000); // Change in every 1 second
        }

        // Start the change cycle
        update_message_panel();
    });
</script>