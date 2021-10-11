<header>
    <nav class="navbar navbar-expand-lg navbar-light custom-nav py-3">
        <div class="container-fluid">
            <div class="nav-left d-flex align-items-center">
                <a class="navbar-brand" href=""><img src="{{ URL::asset("img/logoForHeader.png") }}" alt="logo" class="img-fluid"></a>
                <div class="search-bar ml-5">
                    <form action="">
                        <input type="text" name="search" placeholder="Enter Keywords...">
                        <div class="searachIcon"><img src="{{ URL::asset("img/search.png") }}" alt=""></div>
                    </form>
                </div>
            </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
            <div class="login-user-name-icon">
                <a href="">Mahin Kahn <img src="{{ URL::asset("img/photo.png") }}" alt="avatar" class="img-fluid"></a>
            </div>
          </div>
        </div>
        </div>
      </nav>
</div>
</header>