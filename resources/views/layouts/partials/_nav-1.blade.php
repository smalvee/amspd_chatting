<nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" data-double-top-nav="data-double-top-nav"
    style="display: none;">
    <div class="w-100">
        <div class="d-flex flex-between-center">
            <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarDoubleTop" aria-controls="navbarDoubleTop"
                aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                        class="toggle-line"></span></span></button>
            <a class="navbar-brand me-1 me-sm-3" href="{{ route('dashboard') }}">
                <div class="d-flex align-items-center"><img class="me-2"
                        src="{{ asset('assets/img/icons/spot-illustrations/falcon.png') }}" alt="" width="40" /><span
                        class="font-sans-serif">falcon</span></div>
            </a>
            <ul class="navbar-nav navbar-nav-icons ms-auto flex-row align-items-center">
                <li class="nav-item px-2">
                    <x-language-switcher />
                </li>

                <li class="nav-item px-2">
                    <div class="theme-control-toggle fa-icon-wait"><input
                            class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                            type="checkbox" data-theme-control="theme" value="dark" /><label
                            class="mb-0 theme-control-toggle-label theme-control-toggle-light" for="themeControlToggle"
                            data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to light theme"><span
                                class="fas fa-sun fs-0"></span></label><label
                            class="mb-0 theme-control-toggle-label theme-control-toggle-dark" for="themeControlToggle"
                            data-bs-toggle="tooltip" data-bs-placement="left" title="Switch to dark theme"><span
                                class="fas fa-moon fs-0"></span></label>
                    </div>
                </li>

                <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-xl">
                            <img class="rounded-circle" src="assets/img/team/3-thumb.png" alt="" />
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-caret dropdown-caret dropdown-menu-end py-0"
                        aria-labelledby="navbarDropdownUser">
                        <div class="bg-white dark__bg-1000 rounded-2 py-2">
                            <a class="dropdown-item" href="pages/user/profile.html">Profile &amp;
                                account</a>
                            <a class="dropdown-item" href="#!">Feedback</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="pages/user/settings.html">Settings</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <hr class="my-2 d-none d-lg-block" />
        <div class="collapse navbar-collapse scrollbar py-lg-2" id="navbarDoubleTop">
            <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        id="dashboards">{{ __('Dashboard') }}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
