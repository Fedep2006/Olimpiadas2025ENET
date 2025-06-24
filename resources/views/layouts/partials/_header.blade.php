<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="fas fa-plane text-primary"></i> Frategar
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/"><i class="fas fa-home"></i> Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/paquetes"><i class="fas fa-box-open"></i> Paquetes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/hospedajes"><i class="fas fa-hotel"></i> Hospedajes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/vehiculos"><i class="fas fa-car"></i> Vehículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/nosotros"><i class="fas fa-info-circle"></i> Sobre Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-headset"></i> Ayuda</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                @if(Auth::check())
                    <li class="nav-item dropdown">
                        <div class="d-flex align-items-center gap-4">
                            <a href="{{ route('carrito') }}" class="btn btn-link p-0 m-0 position-relative" style="font-size:1.2rem;" title="Carrito">
                                <i class="fas fa-shopping-cart"></i>
                                @php
                                    $cartCount = session('cart_count', 0);
                                @endphp
                                @if($cartCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $cartCount }}
                                        <span class="visually-hidden">items en el carrito</span>
                                    </span>
                                @endif
                            </a>
                            <a class="nav-link d-flex align-items-center dropdown-toggle p-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                    </a>
                                </li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Ingresar</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-headset"></i> Ayuda</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
