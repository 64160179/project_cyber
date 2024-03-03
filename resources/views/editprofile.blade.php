<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Profile</title>
</head>
<body>
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
                  <a class="navbar-brand" href="{{ url('/home') }}">Web Board</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <a href="{{ url('/posts/create')}}"><button type="button" class="btn btn-primary" data-bs-target="#exampleModal">+ เพิ่มกระทู้</button></a>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <!-- Left Side Of Navbar -->
                      <ul class="navbar-nav me-auto">
  
                      </ul>
  
                      <!-- Right Side Of Navbar -->
                      <ul class="navbar-nav ms-auto">
  
                          <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                              <input type="search" class="form-control form-control-white text-bg-white" placeholder="Search..." aria-label="Search">
                          </form>
                          <a href="{{ route('editprofile') }}"><button type="button" class="btn btn-secondary" >My Profile</button></a>
                          <!-- Authentication Links -->
                          @guest
                          @if (Route::has('login'))
                          <li class="nav-item">
                              <a href="{{ route('login') }}"><button type="button" class="btn btn-outline-light me-2">Login</button></a>
                          </li>
                          @endif
  
                          @if (Route::has('register'))
                          <li class="nav-item">
                              <a href="{{ route('register') }}"><button type="button" class="btn btn-warning">Register</button></a>
                          </li>
                          @endif
                          @else
                          <li class="nav-item dropdown">
                              <button id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->name }}
                              </button>
  
                              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
  
          <main class="container">
            <div class="d-flex align-items-center"></div>
              <div class="row">
                <div class="b-example-divider"></div>
                  <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
                    <div class="container mt-3 ">
                      <h3 class="text-center">{{ Auth::user()->name }}</h3>
                      @foreach ($posts as $item)    
                      <img src="{{ asset($item->post_pic) }}" class="rounded mx-auto d-block" alt="...">
                      <br>
                      @endforeach
                      <div class="d-flex justify-content-center">
                        <a href="{{ url('/categories/create') }}"><button type="button" class="btn btn-success">Upload Profile Image</button></a>
                      </div>
                    </div>
              </div>
            </div>
          </main>
                
      </div>
  </body>
  
  </html>
</body>
</html>