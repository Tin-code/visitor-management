<x-guest-layout class="">
    <div class="container">
    <div class=" text-center form-signin">
        <x-jet-validation-errors class="mb-2 text-white custum-bg p-2" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{route('login') }}" method="post" class="box_shaddow p-5 " id="form">
            @csrf
            <img class="mb-4" src="{{asset('assets/images/SHOPABOOK.png')}}" alt="logo" width="100" >
            <h1 class="h3 mb-3 fw-normal text-white">Connectez-vous</h1>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                <label for="email">Adresse email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                <label for="password">Mot de passe</label>
            </div>

            <div class="mb-3 marg-top-10 d-flex justify-content-between">
                <a href="{{route('register')}}"><u class="text-white text-bold"> Créer un compte </u></a>
                @if (Route::has('password.request'))
                <a href="#"><u class="text-white text-bold"> Mot de passe oublié ?</u></a>
                @endif

            </div>
            <div class="row">
                <button class="mtn_bg_blue text-white radius-5 px-2 py-3" type="submit">Connexion</button>
            </div>
        </form>

    </div>
    </div>
</x-guest-layout>