<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Socrates</title>

    <!-- Styles -->
    <link href="{{asset("css/bootstrap.css")}}" rel="stylesheet">
    <link href="{{asset("css/app.css")}}" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset("css/styles.css")}}">
    <script src="https://kit.fontawesome.com/e0462e4fee.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="layoutSidenav" style="min-height: 100vh">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <br>
                    <a class="nav-link {{Request::is("products") ? "active" : ""}}" href="{{route("products.index")}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-line"></i></div>
                        Dashboard
                    </a>
                    <hr>
                    <a class="nav-link {{Request::is("products/create") ? "active" : ""}}" href="{{route("products.create")}}" >
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-sitemap"></i></div>
                        Producten toev...
                    </a>
                    <hr>
                    <a class="nav-link" href="/admin/bestellingen" >
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-folder-open"></i></div>
                        Bestellingen
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="fs-5">Jelle socrates <i class="fa-brands fa-jedi-order"></i></div>
            </div>
        </nav>
    </div>
    <main class="w-100">
        <br>
        {{$slot}}
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
