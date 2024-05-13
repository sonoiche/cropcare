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

        <link rel="canonical" href="https://demo-basic.adminkit.io/" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link href="{{ url('assets/css/light.css') }}" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet" />
    </head>

    <body>
        <div class="wrapper">
            @include('layouts.core.sidebar')

            <div class="main">
                @include('layouts.core.navigation')

                <main class="content">
                    <div class="container-fluid p-0">
                        <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

                        @yield('content')

                    </div>
                </main>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row text-muted">
                            <div class="col-6 text-start">
                                <p class="mb-0">
                                    <a class="text-muted" href="#" target="_blank"><strong>{{ config('app.name') }}</strong></a> &copy;
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a class="text-muted" href="#" target="_blank">v0.01</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="{{ url('assets/js/app.js') }}"></script>
        <script src="{{ url('assets/js/datatables.js') }}"></script>
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        @stack('scripts')
        <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script>
    </body>
</html>