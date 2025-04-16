<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('auths/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('auths/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('auths/modules/jquery-selectric/selectric.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('auths/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('auths/css/components.css') }}">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="{{ asset('auths/img/stisla-fill.svg') }}" alt="logo" width="100"
                                class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>

                            <div class="card-body">
                                <form action="{{route("auth.register.store")}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="frist_name">First Name</label>
                                            <input id="frist_name" type="text" class="form-control" name="frist_name"
                                                autofocus>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="last_name">Last Name</label>
                                            <input id="last_name" type="text" class="form-control" name="last_name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email">
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Username</label>
                                            <input name="username" type="text" class="form-control">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Phone Number</label>
                                            <input name="phone" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password" class="d-block">Password</label>
                                            <input id="password" type="password" class="form-control pwstrength"
                                                data-indicator="pwindicator" name="password">
                                            <div id="pwindicator" class="pwindicator">
                                                <div class="bar"></div>
                                                <div class="label"></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="password2" class="d-block">Password Confirmation</label>
                                            <input id="password2" type="password" class="form-control"
                                                name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control selectric">
                                                <option va>Male</option>
                                                <option>Female</option>
                                                <option>Orther</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Birth date</label>
                                            <input name="birth_date" type="date" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="agree" class="custom-control-input"
                                                id="agree">
                                            <label class="custom-control-label" for="agree">I agree with the terms
                                                and conditions</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Minh Tam 2025
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('auths/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('auths/modules/popper.js') }}"></script>
    <script src="{{ asset('auths/modules/tooltip.js') }}"></script>
    <script src="{{ asset('auths/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('auths/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('auths/modules/moment.min.js') }}"></script>
    <script src="{{ asset('auths/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('auths/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('auths/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('auths/js/page/auth-register.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('auths/js/scripts.js') }}"></script>
    <script src="{{ asset('auths/js/custom.js') }}"></script>
</body>

</html>
