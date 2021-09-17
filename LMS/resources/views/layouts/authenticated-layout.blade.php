<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CSC</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="/css/main.css" rel="stylesheet" />
    </head>
    <body class="body-section">
        <nav class="navbar navbar-expand-md nav-section">
            <div class="container-fluid">
              <div class="navbar-nav pull-right">
                @if(\Auth::user()->role == 'Admin')
                <li class="nav-item">
                    <a class="nav-link" href="/lecturers">Lecturers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/students">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/courses">Courses</a>
                </li>
                @endif
                
                @if(\Auth::user()->role != 'Student')
                <li class="nav-item">
                    <a class="nav-link" href="/result-upload">Upload</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="/view-results">Results</a>
                </li>
                
                @if(\Auth::user()->role != 'Admin')
                <li class="nav-item">
                    <a class="nav-link" href="/profile">Profile</a>
                </li>
                @endif
                <li class="nav-item pe-3">
                    <a class="nav-link" href="/logout">Log out</a>
                </li>
              </div>
            </div>
        </nav>
        <div>
                @if(session('message'))
                  <div class="alert alert-success">
                    {{session('message')}}
                  </div>
                @endif
                @yield('content')
        </div>
        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.multiple-select').select2();
            });
        </script>
        @yield('script')
    </body>
</html>
