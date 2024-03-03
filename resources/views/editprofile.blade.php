<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Web Board</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm" aria-label="Main navigation">
            <div class="container">
                <a class="navbar-brand">Web Board</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="{{ url('/posts/create') }}"><button type="button" class="btn btn-primary"
                        data-bs-target="#exampleModal">+ เพิ่มกระทู้</button></a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">

                        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" type= "get"
                            action="{{ url('search') }}">
                            <input type="search" class="form-control form-control-white text-bg-white" name="query"
                                type="search" placeholder="Search..." aria-label="Search">
                        </form>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a href="{{ route('login') }}"><button type="button"
                                            class="btn btn-outline-light me-2">Login</button></a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}"><button type="button"
                                            class="btn btn-warning">Register</button></a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <button id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </button>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ url('/editprofile') }}">
                                        {{ __('Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ url('/posts') }}">
                                        {{ __('My Posts') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
        <!-- หน้าตั้งค่า Profile -->
        <main class="container">
            <div class="d-flex align-items-center"></div>
            <div class="row justify-content-center">
                <!-- เปลี่ยน justify-content-center เพื่อจัดให้ตรงกลาง -->
                <div class="b-example-divider"></div>
                <div class="d-grid gap-3">
                    <div class="container mt-3">

                        <!-- Propic -->
                        <div class="text-center">
                            <img src="{{ asset('uploads/propic/image.png') }}" alt="Category Image"
                                class="rounded-circle" style="width: 150px; height: 150px;">
                        </div><br>
                        <!------------>

                        <h3 class="text-center">{{ Auth::user()->name }}</h3><br>
                        <div class="d-flex justify-content-center mb-3">
                            <a href=""><button type="button" class="btn btn-secondary">Edit Profile
                                    Image</button></a>
                        </div>
                        <div class="bg-body ">
                            <!-- เปลี่ยน username -->
                            <div class="my-3 p-3 bg-body rounded shadow-sm border">
                                <p>Change Username</p>
                                <form action="{{ route('update-name') }}" method="post">
                                    @csrf
                                    <input type="text" class="form-control form-control-dark text-bg-gray"
                                        placeholder="Enter your new username" aria-label="Search" name="new_name"><br>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted"> </small>
                                        <input class="btn btn-primary" type="submit" value="Submit">
                                    </div>
                                </form>
                            </div>
                            <!------------>
                            <!-- เปลี่ยน password -->
                            <div class="my-3 p-3 bg-body rounded shadow-sm border">
                                <p>Change Password </p>
                                <form action="{{ route('update-password') }}" method="post">
                                    @csrf
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-dark text-bg-gray"
                                            name="new_password" placeholder="Enter your new password" required>
                                        <button type="button" class="btn btn-outline-secondary"
                                            id="toggleNewPassword">
                                            <i class="bi bi-eye-slash" id="newPasswordIcon"></i>
                                        </button>
                                    </div><br>
                                    <div class="input-group">
                                        <input type="password" class="form-control form-control-dark text-bg-gray"
                                            name="new_password_confirmation" placeholder="Confirm your new password"
                                            required>
                                        <button type="button" class="btn btn-outline-secondary"
                                            id="toggleConfirmNewPassword">
                                            <i class="bi bi-eye-slash" id="confirmNewPasswordIcon"></i>
                                        </button>
                                    </div><br>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">Password must be at least 8 characters long.</small>
                                        <input class="btn btn-primary" type="submit" value="Submit">
                                    </div>
                                </form>
                            </div>
                            <!------------>
                        </div>
                    </div>
                </div>
            </div>
        </main>


        <script>
            const toggleNewPassword = document.querySelector('#toggleNewPassword');
            const toggleConfirmNewPassword = document.querySelector('#toggleConfirmNewPassword');
            const newPassword = document.querySelector('input[name="new_password"]');
            const confirmNewPassword = document.querySelector('input[name="new_password_confirmation"]');
            const newPasswordIcon = document.querySelector('#newPasswordIcon');
            const confirmNewPasswordIcon = document.querySelector('#confirmNewPasswordIcon');

            toggleNewPassword.addEventListener('click', function() {
                const type = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                newPassword.setAttribute('type', type);
                newPasswordIcon.classList.toggle('bi-eye-slash');
                newPasswordIcon.classList.toggle('bi-eye');
            });

            toggleConfirmNewPassword.addEventListener('click', function() {
                const type = confirmNewPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmNewPassword.setAttribute('type', type);
                confirmNewPasswordIcon.classList.toggle('bi-eye-slash');
                confirmNewPasswordIcon.classList.toggle('bi-eye');
            });
        </script>
</body>

</html>
