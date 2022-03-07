
      <!-- La barre latérale gauche avec le menu de navigation  -->
      @include('header')
    <!-- Tout ce qui se trouve dans la partie droite de la page -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 bg-light">

      <!-- NavBar contenant le nom de l'admin et sa photo -->
      <nav class="navbar navbar-expand-lg nav-bg-on-min d-flex flex-end navbar-light bg-white">
        @include('add')
      </nav>

      <!-- Affichage de la date et de la barre de recherche  -->
      <div class="d-flex mt-3 justify-content-between">
        <h4>{{ date('D:M:Y') }}</h4>
      </div>
      
      <div class="border p-3">
        <form action="{{ url('/updated') }}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" class="form-control" name="visitor_id" value="{{$visitors->id}}">
            <div class="mb-3">
              <label for="nom" class="col-form-label">Nom</label>
              <input type="text" class="form-control" id="nom" name="nom" value="{{$visitors->nom}}">
              @error('nom') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
              <label for="prenom" class="col-form-label">Prénoms</label>
              <input type="text" class="form-control" id="prenom" name="prenom" value="{{$visitors->prenom}}">
              @error('prenom') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
              <label for="telephone" class="col-form-label">Numéro de téléphone</label>
              <input type="phone" class="form-control" id="telephone" name="telephone" value="{{$visitors->telephone}}">
              @error('telephone') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
              <label for="num_piece" class="col-form-label">Numéro de piéce</label>
              <input type="text" class="form-control" id="num_piece" name="num_piece" value="{{$visitors->num_piece}}">
              @error('num_piece') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
              <label for="type_piece" class="col-form-label">Type de piéce</label>
              <select class="form-select" aria-label="Default select example" id="type_piece" name="type_piece" value="{{$visitors->type_piece}}">
                <option selected>Veillez selectionner le type de piéce</option>
                <option>Attestation d'identite</option>
                <option>Carte national d'identite (CNI)</option>
                <option>Passeport</option>
              </select>
              @error('type_piece') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
              <label for="image" class="col-form-label">Photo de piéce</label>
              <input type="file" class="form-control" id="image" name="image" value="{{$visitors->image}}">
              @error('image') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
          </form>
      </div>

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