
      <!-- La barre latérale gauche avec le menu de navigation  -->
      @include('header')
    </div>

    <!-- Tout ce qui se trouve dans la partie droite de la page -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 bg-light">

      <!-- NavBar contenant le nom de l'admin et sa photo -->
      <nav class="navbar navbar-expand-lg nav-bg-on-min d-flex flex-end navbar-light bg-white">
        @include('add')
      </nav>

      <!-- Affichage de la date et de la barre de recherche  -->
      <div class="d-flex mt-3 justify-content-between">
        <h4>{{ date('D:M:Y') }}</h4>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="text-black-70">{{ session('success')}}</div>
        </div>
        @endif

        @if ($errors->any())

        <div class="alert alert-danger alert-dismissible alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form action="" method="POST" class="form d-flex">
          <input class="form-control bi bi-search" type="search" name="search" id="searchBar" placeholder="Recherche">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
          </svg>
        </form>
      </div>
      <!-- La table contenant les informations du visiteurs  -->
      <table class="table mt-5 table-striped table-bordered table-hover">
        <thead>
          <tr>

            <th>Nom et prénom de l'agent</th>
            <th>Nom et prénom du visiteur </th>
            <th>Motif</th>
            <th>Heure d'arrive</th>
            <th>Heure de depart</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($receptions as $reception)
          <tr>
            <td>{{$reception->user_name}} {{$reception->user_prenom}}</td>
            <td>{{$reception->visitor_name}} {{$reception->visitor_prenom}}</td>
            <td>{{$reception->motif}}</td>
            <td>{{$reception->date_day}}</td>
            <td>{{$reception->date_coming}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">

        </ul>
      </nav>

    </main>
  </div>
  </div>


  <script src="{{asset ('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
  <script src="{{asset ('assets/js/dashboard.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>