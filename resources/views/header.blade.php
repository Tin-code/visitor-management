<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>SHOPABOOK</title>
    <link rel="icon" href="{{asset("assets/images/SHOPABOOK.png")}}" type="image/icon type">

    <!-- Custom styles for this template -->
    <!-- <link href="{{asset ('assets/css/dashboard.css') }}" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">

    <!-- Bootstrap links (icons and css ) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body class="light-blu">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" defer> </script>

    <!-- La div contenant tout le contenu de la page  -->
    <div class="container-fluid mb-5">
        <div class="row">
            <!-- La barre latérale gauche avec le menu de navigation  -->
            <nav id="sidebarMenu" class="sidebar col-md-3 p-0 col-lg-2 d-md-block bg-yellow collapse">
                <img src="{{asset("assets/images/SHOPABOOK.png")}}" class="marg-left mt-3 " alt="logo de mtn" height="70px">
                <hr class="text-white">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        {{-- <li class="nav-item">
                            <a class="nav-link text-white" aria-current="page" href="{{ route('mtn.dashboard') }}">
                                <span class="text-white" data-feather="home"></span>
                                Dashboard
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('mtn.visitors') }}">
                                <span class="text-white" data-feather="users"></span>
                                Visiteurs
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('mtn.agents') }}">
                                <span class="text-white" data-feather="file-text"></span>
                                Agents
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('mtn.reception') }}">
                                <span class="text-white" data-feather="file-text"></span>
                                Reception
                            </a>
                        </li> --}}
                    </ul>

                </div>
            </nav>