<style>
    .active{
        color: white;
    }
</style>
<nav id="main_nav" class="navbar navbar-expand-lg navbar-light bg-white shadow">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand h1" href="{{url('welcome')}}">
            <img src="{{ asset('main/assets/img/logo-ct.png') }}" style="position:absolute; width: 50px; height:50px; z-index:1;" alt="">
            <span class="text-white h4">
                SPAN
            </span>
            <span class="text-primary h4">DISBUDPARSU</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler-success" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="navbar-toggler-success">
            <div class="flex-fill mx-xl-5 mb-2">
                <ul class="nav navbar-nav d-flex justify-content-between mx-xl-5 text-center text-dark">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('welcome/wisata')) ? 'active' : '' }} btn-outline-primary rounded-pill px-3" href="{{url('welcome/wisata')}}">Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('welcome/rute')) ? 'active' : '' }} btn-outline-primary rounded-pill px-3" href="{{url('welcome/rute')}}">Rute</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('welcome/peta')) ? 'active' : '' }} btn-outline-primary rounded-pill px-3" href="{{route('landing.peta')}}">Peta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('welcome/about')) ? 'active' : '' }} btn-outline-primary rounded-pill px-3" href="{{route('landing.about')}}">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>