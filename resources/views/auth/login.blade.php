@extends("layout.layout")
@section('section')
<div class="login-page-container">
    <div class="container">
        <div class="login-page-logo-wrapper text-center my-5">
            <img src="{{ URL::asset('img/logo.png') }}" alt="logo" loading="lazy">
        </div>
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-5">
                <div class="login-form-wrapper text-center p-5 my-5">
                    <div class="login-form-card">
                        <div class="login-form-title">
                            <h4>Login</h4>
                        </div>
                        <form action="">
                           <div class="my-5">
                            <input type="email" name="email" placeholder="admin" >
                            <input type="password" name="passowrd" placeholder="password" >
                           </div>
                            <input type="button" name="submit" class="login-form-submit-button" value="Login" >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection