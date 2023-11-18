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
                                                <div class="chat-contact-content pe-3"> 6 Users</div>
                                                <div class="position-absolute bottom-0 end-0 hover-hide"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Total User End -->


                                <!-- chat User List start -->
                                <div class="hover-actions-trigger">
                                    <div class="d-flex p-3">
                                        <div class="avatar avatar-xl">
                                            <img class="rounded-circle" src="../assets/img/team/23.jpg" alt="" />
                                        </div>
                                        <div class="flex-1 chat-contact-body ms-2 d-md-none d-lg-block">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="mb-0 chat-contact-title">Gemma Whelan</h6>
                                            </div>
                                            <div class="min-w-0">
                                                <div class="chat-contact-content pe-3">Status: Online</div>

                                            </div>
                                        </div>
                                    </div>
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
                                            <div class="fas fa-chevron-left"></div>
                                        </a>
                                        <div class="min-w-0">
                                            <h5 class="mb-0 text-truncate fs-0">ToDo Head Line</h5>
                                            <!-- <div class="fs--2 text-400">Active On Chat</div> -->
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-sm btn-falcon-primary btn-chat-info" type="button" data-index="0" data-bs-toggle="tooltip" data-bs-placement="top" title="Conversation Information">
                                            <span class="fas fa-info"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="chat-content-body" style="display: inherit;">

                                <!-- Share media info Start -->
                                <div class="conversation-info" data-index="0">
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
                                </div>
                                <!-- Share media info End -->


                                <div class="chat-content-scroll-area scrollbar">

                                    @foreach($chat as $item)

                                    @if($item->user_id != Auth::user()->email)
                                    <!-- chat of other user start -->
                                    <div class="d-flex p-3">
                                        <div class="avatar avatar-l me-2">
                                            <img class="rounded-circle" src="../assets/img/team/2.jpg" alt="" />
                                        </div>
                                        <div class="flex-1">
                                            <div class="w-xxl-75">
                                            <div class="text-400 fs--2"><span>{{ $item->user_id }}</span></div>
                                                <div class="hover-actions-trigger d-flex align-items-center">
                                                    <div class="chat-message bg-200 p-2 rounded-2">{{ $item->chat_details }}</div>
                                                    <ul class="hover-actions position-relative list-inline mb-0 text-400 ms-2">
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Forward"><span class="fas fa-share"></span></a></li>
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Archive"><span class="fas fa-archive"></span></a></li>
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-edit"></span></a></li>
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><span class="fas fa-trash-alt"></span></a></li>
                                                    </ul>
                                                </div>
                                                <div class="text-400 fs--2"><span>{{ $item->created_at }}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- chat of other user end -->
                                    @endif
                                    
                                    @if($item->user_id == Auth::user()->email)
                                    <!-- chat of Loged in user Start -->
                                    <div class="d-flex p-3">
                                        <div class="flex-1 d-flex justify-content-end">
                                            <div class="w-100 w-xxl-75">
                                            <div class="text-400 fs--2 text-end">{{ $item->user_id }}</div>
                                                <div class="hover-actions-trigger d-flex flex-end-center">
                                                    <ul class="hover-actions position-relative list-inline mb-0 text-400 me-2">
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Forward"><span class="fas fa-share"></span></a></li>
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Archive"><span class="fas fa-archive"></span></a></li>
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-edit"></span></a></li>
                                                        <li class="list-inline-item"><a class="chat-option" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><span class="fas fa-trash-alt"></span></a></li>
                                                    </ul>
                                                    <div class="bg-primary text-white p-2 rounded-2 chat-message" data-bs-theme="light">{{ $item->chat_details }}
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
                            <input class="d-none" type="file" id="chat-file-upload" />
                            <label class="chat-file-upload cursor-pointer" for="chat-file-upload">
                                <span class="fas fa-paperclip"></span>
                            </label>
                            <div class="btn btn-link emoji-icon" data-picmo="data-picmo" data-picmo-input-target=".emojiarea-editor">
                                <span class="far fa-laugh-beam"></span>
                            </div>
                            <button class="btn btn-sm btn-send shadow-none" type="submit">Send</button>
                        </form>
                    </div>
                    <!-- chat Body End -->
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        Livewire.on('reloadPage', function() {
            // Reload the page when the 'reloadPage' event is received
            location.reload();
        });
    });
</script>

<script>
    // Wait for the DOM content to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Get the input field by its ID
        var inputField = document.getElementById("myInput");

        // Set the input field's value to "A"
        inputField.value = "A";
    });
</script> -->

@endpush

<script>
        $(document).ready(function() {
            
            function update_message_panel() {

                $('.chat-content-scroll-area').scrollTop($('.chat-content-scroll-area')[0].scrollHeight);
               
                @this.set('refresh_count', Math.floor(Math.random() * 10));
                setTimeout(update_message_panel, 1000); // Change in every 1 second
            }

            // Start the change cycle
            update_message_panel();
        });
    </script>