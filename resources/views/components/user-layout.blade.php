<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Socrates</title>

        <!-- Styles -->
        <link href="{{asset("css/bootstrap.css")}}" rel="stylesheet">
        <link href="{{asset("css/app.css")}}" rel="stylesheet">
        <script src="https://kit.fontawesome.com/e0462e4fee.js" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route("home")}}"><img class="logo" src="{{asset("images/socrates-seperate.png")}}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                    <a class="nav-link {{Route::is("home") ? "active" : ""}}" href="{{route("home")}}">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link {{Route::is("artikelen") ? "active" : ""}}" href="{{route("artikelen")}}">Artikelen</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="/magic-truffles">Magic truffles</a>
                    </li>
                </ul>
                @if(!Session::get("user"))
                <div class="d-flex gap-2 align-items-center">
                    <a href="{{route("loginView")}}" class="btn btn-primary">Login</a>
                    <a href="{{route("registerView")}}" class="btn btn-outline-secondary">Register</a>
                </div>
                @else
                <div class="dropdown">
                    <a href="" data-bs-toggle="dropdown" class="text-white dropdown-toggle">{{Session::get("user")->name . " " . Session::get("user")->prefix . " " . Session::get("user")->lastname}}</a>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        @if(Session::get("user")->level == 1)
                        <li class="dropdown-item">
                            <a href="{{route("admin.dashboard")}}">Dashboard</a>
                        </li>
                        @endif
                        <li class="dropdown-item">
                            <a href="{{route("logout")}}">Uitloggen</a>
                        </li>
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </nav>
        <main>
            {{$slot}}
            <br>
        </main>
        <x-user-footer></x-user-footer>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
