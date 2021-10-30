<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href={{ URL::asset('css/main.css') }}>
    <title>qlips</title>
    <link rel="shortcut icon" href="{{ asset('/img/logo.png') }}" />
    @stack('styles')
</head>

<body>
    @include("components.header")
    <main>
        <div class="container-fluid">
            <div class="row" class="main-content-row">
                <div class="col-md-2 col-lg-2 d-none d-lg-block">
                    @include("components.sidenav")
                </div>
                <div class="col-md-12 col-lg-10 page-content pl-lg-5 pt-4 pl-md-0">
                    @yield('site-section')
                </div>
            </div>
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
    <script>
        // <script>
        let err = document.querySelectorAll("[id='error']");
        if (err) {
            setTimeout(function() {
                for (var i = 0; i < err.length; i++)
                    err[i].style.display = 'none'
            }, 3000);
        }

        let success = document.getElementById('success')
        if (success) {
            setTimeout(function() {
                success.style.display = 'none'
            }, 3000);
        }
        $("#userAvatar").on("click", function() {
            $("#logOutButton").toggle("fast");
        });
        // offcanvas
        // offcanvasContent
        $("#handleNavbarCollapse").on("click", function() {
            $("#offcanvasContent").toggle("slow")
        })
    </script>
    @stack("script")
</body>

</html>
