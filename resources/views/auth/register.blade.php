<x-guest-layout class="">
    <div class="container">
        <div class=" text-center form-signin">            
            @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
            @endif
            
            @if ($errors->any())

                @foreach($errors->all() as $error)

                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{"Le mot de passe doit dépasser 8 caractères"}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
           @endif
            <img class="mb-2 mt-2" src="{{asset('assets/images/SHOPABOOK.png')}}" alt="logo" height="80">
            <form action="{{route('register') }}" method="POST" class="box_shaddow p-3 " enctype="multipart/form-data" id="form">
                @csrf
                <h1 class="h3 mb-3 fw-normal text-white">Inscrivez-vous</h1>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="nom" required>
                    <label for="name">Nom</label> 
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control form-control-sm" id="prenom" name="prenom" placeholder="prenom" required>
                    <label for="prenom">Prenom(s)</label>
                    @error('prenom')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="phone" class="form-control form-control-sm" id="telephone" name="telephone" placeholder="telephone" required>
                    <label for="telephone">Téléphone</label>
                    @error('telephone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                                    </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="name@example.com" required>
                    <label for="email">Adresse email</label>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Mot de passe" required>
                    <label for="password">Mot de passe</label>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-2">
                    <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                    <label for="password">Confirmer le mot de passe</label>
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <button class="mtn_bg_blue text-white radius-5 p-3" type="submit">Inscription</button>
                </div>
                <p class="text-white">Si vous avez déjà un compte,<a href="{{route('login')}}"><u class="text-white text-bold"> Connectez-vous</u></a></p>

            </form>

        </div>
    </div>
</x-guest-layout>