<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('https://bootswatch.com/cosmo/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css') }}"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.min.css" rel="stylesheet">
    <style>
        .swal2-modal {
            border-radius: 0;
        }

        .swal2-modal .swal2-styled {
            border-radius: 0;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 65px;
            background-color: #f5f5f5;
            padding: 25px;
        }

        .grid-lang {
            background: #e8e8e8;
            display: grid;
            height: 165px;
            width: 165px;
            margin-top: 20px;
        }

        .grid-lang:hover {
            background: #1a6ecc;
            text-decoration: none;
        }

        .grid-lang-link {
            color: #6b6b6b;
            text-decoration: none;
        }

        .grid-lang-link:hover {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa fa-language"></i> &nbsp; Penerjemah Tampan
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('tambah_arti') }}">Bantu terjemahkan</a></li>
                </ul>
                @if(!Auth::guest())
                    @if(Auth::user()->isAdmin() === 'admin')
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('database') }}">Database</a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('bahasa') }}">Bahasa</a></li>
                        </ul>
                    @elseif(Auth::user()->isAdmin() === 'user')
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('terjemahan_saya') }}">Kata yang diterjemahkan</a></li>
                        </ul>
                @endif
            @endif
            <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Masuk</a></li>
                        <li><a href="{{ route('register') }}">Mendaftar</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>
<footer class="footer">
    <div class="container">
        <div class="row">
            <p style="float:left" class="text-muted">&copy; 2017 <i class="fa fa-heart"></i> Axl Yody. Build with
                Laravel 5 <i class="fa fa-close"></i> Bootstrap 3</p>
            <p style="float:right" class="text-muted">Fork me on <a href="http://github.com/axlyody">GitHub</a></p>
        </div>
    </div>
</footer>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.4/sweetalert2.min.js"></script>
<script>

    $("#tambah").submit(function (e) {
        $("#kirim").text("Menambahkan...");
        var url = "{{ url('api/v1/tambah_arti') }}"; // the script where you handle the form input.

        $.ajax({
            type: "POST",
            url: url,
            data: $("#tambah").serialize(), // serializes the form's elements.
            success: function () {
                $("#kirim").text("Buat");
                swal(
                    'Yay!!',
                    'Data berhasil ditambahkan! Menunggu moderasi',
                    'success'
                )
            },
            error: function () {
                $("#kirim").text("Buat");
                swal(
                    'Oops...',
                    'Data tidak lengkap',
                    'error'
                )
            }

        });

        e.preventDefault(); // avoid to execute the actual submit of the form.
    });
</script>
</body>
</html>
