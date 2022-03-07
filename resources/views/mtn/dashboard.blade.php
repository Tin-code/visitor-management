@include('header')

            <!-- NavBar contenant le nom de l'admin et sa photo -->
            <nav class="navbar navbar-expand-lg nav-bg-on-min d-flex flex-end navbar-light bg-white">
                <div class="container-fluid reverse-row">
                    <button class="navbar-toggler border position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <li class="nav-link nav-item text-decoration-none display-none"></li>
                    <li class="nav-item dropdown disp-none nav-link text-decoration-none border left-on-min">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <img src="https://eu.ui-avatars.com/api/?name={{Auth::user()->name}} {{Auth::user()->prenom}}&background=random" width="30px" height="auto" alt="avatar admin" class="rounded-avatar">
                            {{Auth::user()->name}}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                            <li><a class="dropdown-item" href="#">Modifier le profil</a></li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <li><a class="dropdown-item bg-danger-soft-hover" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();"><i class="bi bi-power fa-fw me-2"></i>Déconnexion</a></li>
                            </form>
                            {{-- <li><a class="dropdown-item" href="#">Déconnexion</a></li> --}}
                        </ul>
                    </li>

                </div>

            </nav>

            <!-- Tout ce qui se trouve dans la partie droite de la page -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 light-blue">

                <div class="container-fluid mt-3">
                    <div class="row justify-content-between">

                        <!-- Les deux premiers graphiques  -->
                        <div class="col-sm-7 m-2 col-12">
                            <div class="row">
                                <div class="row col-12 align-items-center">

                                    <!-- Rechercher une période  -->
                                    <div class="dropdown mt-4 col-12 col-md-4">
                                        <button class="btn bg-white marg-right-20 w-100 dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Choisir une période
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="#" id="aujourdhui">Aujourd hui</a></li>
                                            <li><a class="dropdown-item" href="#" id="hier">Hier</a></li>
                                            <li><a class="dropdown-item" href="#" id="sem_enours">La semaine encours</a></li>
                                            <li><a class="dropdown-item" href="#" id="sem_dernier">La semaine dernière</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 col-12">
                                        <form action="" method="POST" class=" marg-left-50 d-flex justify-content-between align-items-center">
                                            <div class="form-group marg-right">
                                                <label for="debut" class="text-white">Du</label>
                                                <input type="date" id="debut_date" name="debut_date" class="form-control" oninput="buildPie(this);">
                                            </div>
                                            <div class="form-group">
                                                <label for="fin" class="text-white">Au</label>
                                                <input type="date" id="fin_date" name="fin_date" class="form-control" oninput="buildPie(this);">
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Nombre de visiteurs  -->
                                <div class="row justify-content-between p-2">
                                    <div class="bg-white text-center text-dark d-flex flex-column justify-content-center box-shaddow rounded-3 m-2 marg-left col-sm-4" style="height: 260px;">
                                        <h1 id="nb_visitor"></h1>
                                        <h1 class="">VISITEURS</h1>
                                    </div>
                                    <div class="col-sm-7 m-2 box-shaddow bg-white border rounded-3 col-12">
                                        <div id="chartContainer" style="height: 262px; width:425px"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- La courbe des visiteurs de la semaine  -->
                            <div class="row">

                                <div class="box-shaddow rounded-3 m-2 mt-5 col-12 col-sm-12 bg-white" style="width: 750px;">
                                    <h2 class="text-dark text-center">Nombres de Visiteurs des 7 derniers jours</h2>
                                    <canvas class="my " id="myChart" width="1200" height="480"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Tableau des visiteurs présents  -->
                        <div class="col-sm-4 p-3 box-shaddow bg-white mt-4 rounded-3 col-12">
                            <div class="col-md-5 m-2 mt-3 overflow-auto h-550 w-100 col-12">
                                <table class="table table-striped table-bordered table-hover">
                                    <h1 class="text-dark">Visiteurs présents</h1>
                                    <thead>
                                        <tr>

                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Téléphone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ( $lespresents as $present)
                                        @if ($present->date_coming =='0000-00-00 00:00:00')
                                        <tr>
                                            <td>{{$present->nom}}</td>
                                            <td>{{$present->prenom}}</td>
                                            <td>{{$present->motif}}</td>
                                            <td>{{$present->date_day}}</td>
                                        </tr>
                                        
                                        @else
                                        <p> Aucun visiteur present </p>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Lien javascript de bootstrap  -->
    <!-- <script src="../{{asset ('assets/bootstrap/bootstrap.bundle.min.js') }}"></script> -->

    <!-- Lien canvas.js pour l'affichage des graphiques  -->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

    <script src="{{asset ('assets/js/dashboard.js') }}"></script>
    <!-- <script src="{{asset ('assets/js/jquery.js') }}"></script> -->
    <!-- <script src="assets/js/dashboard.js"></script> -->


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>