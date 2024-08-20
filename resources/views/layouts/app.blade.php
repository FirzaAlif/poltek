<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <!-- Custom Styles -->
    <style>
        #wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        #sidebar-wrapper {
            width: 250px;
            background-color: #343a40;
            color: white;
        }

        #sidebar-wrapper .list-group-item {
            border: none;
            padding: 15px 20px;
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: #495057;
        }

        #page-content-wrapper {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f8f9fa;
        }

        .navbar {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #0069d9;
            border-color: #0069d9;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        main {
            padding-top: 20px;
        }
    </style>

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        @guest
            <!-- Navbar untuk pengguna yang belum login -->
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto"></ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto">
                            <!-- Authentication Links -->
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>
        @endguest

        @auth
            <!-- Sidebar untuk pengguna yang sudah login -->
            <div id="wrapper">
                <div id="sidebar-wrapper">
                    <div class="sidebar-heading text-white py-4 px-3">
                        <h3>{{ config('app.name', 'Laravel') }}</h3>
                    </div>
                    <div class="list-group list-group-flush">
                        <a href="#" 
                            class="list-group-item list-group-item-action bg-dark text-white">Dashboard</a>
                        <a href="{{ route('departements.index') }}"
                            class="list-group-item list-group-item-action bg-dark text-white">Jurusan</a>
                        <a href="{{ route('mahasiswas.index') }}"
                            class="list-group-item list-group-item-action bg-dark text-white">Mahasiswa</a>
                        <a href="{{ route('majors.index') }}"
                            class="list-group-item list-group-item-action bg-dark text-white">Prodi</a>
                        <a href="{{ route('assignments.index') }}"
                            class="list-group-item list-group-item-action bg-dark text-white">Tugas</a> 
                        <a href="{{ route('tasktransactions.index') }}"
                            class="list-group-item list-group-item-action bg-dark text-white">Transaksi Tugas</a>  
                            
                    </div>
                </div>

                <div id="page-content-wrapper">
                    <nav class="navbar navbar-expand-md navbar-light bg-white">
                        <div class="container-fluid">


                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav me-auto"></ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>

                    <main class="py-4">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @yield('content')
                    </main>
                </div>
            </div>
        @endauth
    </div>

    <!-- JavaScript -->
    <script>
        @auth
        document.getElementById("menu-toggle").addEventListener("click", function() {
            document.getElementById("wrapper").classList.toggle("toggled");
        });
        @endauth
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
