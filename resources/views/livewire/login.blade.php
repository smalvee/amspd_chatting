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
                href="{{ route('home') }}"><img class="me-2" src="{{ asset('assets/img/icons/spot-illustrations/falcon.png') }}"
                    alt="" width="58" /><span
                    class="font-sans-serif fw-bolder fs-5 d-inline-block">AMPSD</span></a>
            <div class="card">
                <div class="card-body p-4 p-sm-5">
                    <div class="row flex-between-center mb-2">
                        <div class="col-auto">
                            <h5>Log in</h5>
                        </div>
                        {{-- <div class="col-auto fs--1 text-600"><span class="mb-0 undefined">or</span> <span><a
                    href="#">Create an account</a></span></div> --}}
                    </div>
                    <form wire:submit.prevent="login"> 
                        <div class="mb-3">
                            <input class="form-control" type="email" placeholder="Email address" wire:model="email"
                                required />
                            @error('email')
                                <x-alert type="danger" :message="$message" />
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="password" placeholder="Password" wire:model="password"
                                required />
                            @error('password')
                                <x-alert type="danger" :message="$message" />
                            @enderror
                        </div>
                        <div class="row flex-between-center">
                            <div class="col-auto">
                                <div class="form-check mb-0"><input class="form-check-input" type="checkbox"
                                        id="basic-checkbox" checked="checked" /><label class="form-check-label mb-0"
                                        for="basic-checkbox">Remember
                                        me</label></div>
                            </div>
                            <div class="col-auto">
                                {{-- <a class="fs--1" href="forgot-password.html">Forgot Password?</a> --}}
                            </div>
                        </div>
                        <div class="mb-3"><button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                name="submit">Log
                                in</button></div>
                    </form>

                    {{-- Session Message Start --}}
                    <x-session-message/>
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
                <table class="table table-sm">
                    <tr>
                        <td>S Admin</td>
                        <td>superadmin@ampsd.com</td>
                        <td>12345678</td>
                    </tr>
                    <tr>
                        <td>Admin</td>
                        <td>admin@ampsd.com</td>
                        <td>12345678</td>
                    </tr>
                    <tr>
                        <td>User</td>
                        <td>user@ampsd.com</td>
                        <td>12345678</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
