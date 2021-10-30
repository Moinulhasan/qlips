<header>
    <nav class="navbar navbar-expand-lg navbar-light custom-nav py-3 fixed-top">
        <div class="container-fluid">
            <div class="nav-left d-flex align-items-center">
                <a class="navbar-brand" href="{{ route('topics') }}"><img
                        src="{{ URL::asset('img/logoForHeader.png') }}" alt="logo" class="img-fluid"></a>
            </div>
            <div class="d-flex align-items-center" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <div class="login-user-name-icon" id="userAvatar">
                        {{ auth()->user()->name }} <img src="{{ URL::asset('img/photo.png') }}" alt="avatar"
                            class="img-fluid">
                        <div class="logout-button-wrapper" id="logOutButton">
                            <form action="{{ asset(route('logout')) }}" method="post">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn">Logout</button>
                            </form>

                        </div>
                    </div>
                </div>
                <button id="handleNavbarCollapse" class="offcanvas-button">|||</button>
            </div>
            <div class="offcanvas-content" id="offcanvasContent">
                <div class="sidenav-wrapper">
                    <div class="toppart">
                        <ul>
                            {{-- <li><a href=""> <img src="{{ URL::asset("img/dashboard.svg") }}" alt=""> Dashboard</a></li> --}}
                            <li class="{{ request()->routeIs('topics') ? 'menu-active' : '' }}"><a
                                    href="{{ route('topics') }}">
                                    <img src="{{ URL::asset('img/message.svg') }}" alt="">
                                    Topics</a></li>
                            <li class="{{ request()->routeIs('questions') ? 'menu-active' : '' }}"><a
                                    href="{{ route('questions') }}">
                                    <img src="{{ URL::asset('img/qestions.svg') }}" alt="">
                                    Questions</a></li>
                            <li class="{{ request()->routeIs('advisor') ? 'menu-active' : '' }}"><a
                                    href="{{ route('advisor') }}">
                                    <img src="{{ URL::asset('img/people.svg') }}" alt="">
                                    Advisors</a></li>
                            <li class="{{ request()->routeIs('audio.*') ? 'menu-active' : '' }}"><a
                                    href="{{ route('audio.index') }}"> <img
                                        src="{{ URL::asset('img/qlips.svg') }}" alt="">
                                    Audio
                                    Qlips</a></li>
                        </ul>
                    </div>
                    <div class="bottom-part">
                        <p>Settings</p>
                        <ul>
                            <li><a href=""><img src="{{ URL::asset('img/settings.svg') }}" alt="">Main Settings</a>
                            </li>
                            <li><a href=""><img src="{{ URL::asset('img/notifications.svg') }}"
                                        alt="">Notifications</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    </div>
</header>
