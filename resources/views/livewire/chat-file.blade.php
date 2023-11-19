<div>
    <x-breadcrumb title="{{ __('Conversation File') }}" />
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
                            <!-- <input placeholder=""> -->
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-end">
                    <div class="table-responsive scrollbar">
                        <table class="table table-hover table-striped overflow-hidden">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">File Name</th>

                                    <th scope="col">Preview</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach($chat as $item)

                                <tr class="align-middle">
                                    <td class="text-nowrap">{{ $loop->iteration }}</td>
                                    <td class="text-nowrap">


                                        <a target="_blank" href="{{ Storage::url('public/chat_file/' . $item->attachments) }}">{{$item->attachments}}</a>
                                    </td>
                                    <td class="text-nowrap">

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

                                        @else
                                        <a href="{{ Storage::url('public/chat_file/' . $item->attachments) }}">Preview not available. Click to download</a>
                                        
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













</div>