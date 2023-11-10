<div class="container" data-layout="container">
    <script>
        var isFluid = JSON.parse(localStorage.getItem('isFluid'));
        if (isFluid) {
            var container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
        }
    </script>
    <div class="row flex-center min-vh-100 py-6">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4"><a class="d-flex flex-center mb-4"
                href="{{ route('home') }}"><img class="me-2"
                    src="{{ asset('assets/img/icons/spot-illustrations/falcon.png') }}" alt=""
                    width="58" /><span class="font-sans-serif fw-bolder fs-5 d-inline-block">AMPSD</span></a>
            <div class="card">
                <div class="card-body p-4 p-sm-5">
                    <div class="row flex-between-center mb-2">
                        <div class="col-auto">
                            <h5>Invitation Form</h5>
                            @if ($project)
                                <h5>Project: {{ $project->name }}</h5>
                                <h5>Role: {{ $project_wise_user_info->role }}</h5>
                            @endif
                        </div>

                        {{-- <div class="col-auto fs--1 text-600"><span class="mb-0 undefined">or</span> <span><a
                    href="#">Create an account</a></span></div> --}}
                    </div>
                    <form wire:submit.prevent="submit">
                        <div class="mb-3">
                            <input class="form-control" value="{{ $user->email }}" readonly />
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="text" placeholder="What is your name ?"
                                wire:model="name" required />
                            @error('name')
                                <x-alert type="danger" :message="$message" />
                            @enderror
                        </div>
                        @if ($user->status == 'Invite')
                            <div class="mb-3">
                                <input class="form-control" type="password" placeholder="Password" wire:model="password"
                                    required />
                                @error('password')
                                    <x-alert type="danger" :message="$message" />
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input class="form-control" type="password" placeholder="Confirmation password"
                                    wire:model="password_confirmation" required />
                                @error('password_confirmation')
                                    <x-alert type="danger" :message="$message" />
                                @enderror
                            </div>
                            <div class="mb-3">
                                <x-alert type="info" message="Create a new user account" />
                            </div>
                        @else
                        <div class="mb-3">
                            <div class="mb-3">
                                <x-alert type="info" message="Already you have an user account" />
                            </div>
                        </div>
                        @endif
                        <div class="mb-3"><button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                name="submit">Accept Invitation</button></div>
                    </form>

                    {{-- Session Message Start --}}
                    <x-session-message />
                    {{-- Session Message End --}}

                    {{-- <div class="position-relative mt-4">
              <hr />
              <div class="divider-content-center">or log in with</div>
            </div>
            <div class="row g-2 mt-2">
              <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100" href="#"><span
                    class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> google</a></div>
              <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100" href="#"><span
                    class="fab fa-facebook-square me-2" data-fa-transform="grow-8"></span> facebook</a></div>
            </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
