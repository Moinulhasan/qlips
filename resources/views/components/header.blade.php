<header>
    <nav class="navbar navbar-expand-lg navbar-light custom-nav py-3">
        <div class="container-fluid">
            <div class="nav-left d-flex align-items-center">
                <a class="navbar-brand" href=""><img src="{{ URL::asset('img/logoForHeader.png') }}" alt="logo"
                        class="img-fluid"></a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <div class="login-user-name-icon" id="userAvatar">
                        {{auth()->user()->name}} <img src="{{ URL::asset('img/photo.png') }}" alt="avatar" class="img-fluid">
                        <div class="logout-button-wrapper" id="logOutButton">
                            <form action="{{asset(route('logout'))}}" method="post">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn">Logout</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    </div>
</header>
