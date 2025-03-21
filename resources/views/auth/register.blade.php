<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5" />
        <meta name="author" content="AdminKit" />
        <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web" />

        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link rel="shortcut icon" href="{{ url('assets/img/icons/icon-48x48.png') }}" />

        <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

        <title>{{ config('app.name') }}</title>

        <link href="{{ url('assets/css/app.css') }}" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />
        <style>
            .login-bg {
                background-image: url('../../assets/img/login-bg.jpg');
                background-size: contain;
                background-repeat: no-repeat;
                background-position: center;
            }
            body {
                background-color: #dcecc9;
            }
        </style>
    </head>

    <body class="login-bg">
        <main class="d-flex w-100">
            <div class="container d-flex flex-column">
                <div class="row vh-100">
                    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">
                            <div class="text-center mt-4">
                                <h1 class="h2">Get started</h1>
                                <p class="lead">
                                    Start creating the best possible user experience for you.
                                </p>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">First Name</label>
                                                <input class="form-control form-control-lg @error('fname') is-invalid @enderror" type="text" name="fname" placeholder="Enter your first name" value="{{ old('fname') }}" />
                                                @error('fname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Last Name</label>
                                                <input class="form-control form-control-lg @error('lname') is-invalid @enderror" type="text" name="lname" placeholder="Enter your last name" value="{{ old('lname') }}" />
                                                @error('lname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" />
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter password" />
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Retype Password</label>
                                                <input class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Confirm password" />
                                            </div>
                                            <div class="text-center mt-3">
                                                <button type="submit" class="btn btn-lg btn-primary">Sign up</button>
                                                <a href="{{ url('login') }}" class="btn btn-lg btn-outline-secondary">Sign in Here</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <script src="{{ url('assets/js/app.js') }}"></script>
    </body>
</html>