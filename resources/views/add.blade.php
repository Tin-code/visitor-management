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
