
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

        {{-- Message d'alerte ajout de nouveau visiteur --}}
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="text-black-70">{{ session('success')}}</div>
        </div>
        @endif

        {{-- Message d'alerte modification éffectuée --}}
        @if(session()->has('update'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="text-black-70">{{ session('update')}}</div>
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter un visiteur </button>

      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ajouter un visiteur</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('mtn.visitors') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="nom" class="col-form-label">Nom</label>
                  <input type="text" class="form-control" id="nom" name="nom" required>
                  @error('nom') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                  <label for="prenom" class="col-form-label">Prénoms</label>
                  <input type="text" class="form-control" id="prenom" name="prenom" required>
                  @error('prenom') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                  <label for="telephone" class="col-form-label">Numéro de téléphone</label>
                  <input type="phone" class="form-control" id="telephone" name="telephone" required>
                  @error('telephone') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                  <label for="num_piece" class="col-form-label">Numéro de piéce</label>
                  <input type="text" class="form-control" id="num_piece" name="num_piece">
                  @error('num_piece') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                  <label for="type_piece" class="col-form-label">Type de piéce</label>
                  <select class="form-select" aria-label="Default select example" id="type_piece" name="type_piece">
                    <option selected>Veillez selectionner le type de piéce</option>
                    <option>Attestation d'identite</option>
                    <option>Carte national d'identite (CNI)</option>
                    <option>Passeport</option>
                  </select>
                  @error('type_piece') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                  <label for="image" class="col-form-label">Photo de piéce</label>
                  <input type="file" class="form-control" id="image" name="image" required>
                  @error('image') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
      <!-- La table contenant les informations du visiteurs  -->
      <table class="table mt-5 table-striped table-bordered">
        <thead>
          <tr>

            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>N° pièce</th>
            <th>Type piéce</th>
            <th>Opérations</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($visitors as $visitor)
          <tr>
            <td>{{$visitor->nom}}</td>
            <td>{{$visitor->prenom}}</td>
            <td>{{$visitor->telephone}}</td>
            <td>{{$visitor->num_piece}}</td>
            <td>{{$visitor->type_piece}}</td>
            <td>
              <a href="/edit/{{$visitor->id}}" class="btn btn-primary text-white">Modifier</a>
              <a href="/delete/{{$visitor->id}}" class="btn btn-danger text-white">Supprimer</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
     

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