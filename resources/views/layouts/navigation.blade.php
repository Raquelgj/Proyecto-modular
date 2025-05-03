<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <!-- Nombre de la página -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">AquaTethys</a>

        <!-- Botón responsive -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido colapsable -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Categorías centradas -->
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        Categorías
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Peces</a></li>
                        <li><a class="dropdown-item" href="#">Plantas</a></li>
                        <li><a class="dropdown-item" href="#">Accesorios</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Derecha: búsqueda, carrito, perfil -->
            <form class="d-flex me-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-primary" type="submit">Buscar</button>
            </form>

            <button class="btn btn-outline-secondary me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartSidebar" aria-controls="cartSidebar">
    🛒 
</button>

            <!-- Perfil y Cerrar sesión -->
            @auth
                <div class="dropdown">
                    <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
            @endauth
        </div>
    </div>
</nav>
<!-- Sidebar del carrito -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="cartSidebar" aria-labelledby="cartSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="cartSidebarLabel">Carrito de Compras</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body">
        @php
            $cart = session('cart', []);
        @endphp

        @if(count($cart) > 0)
            <ul class="list-group">
                @foreach($cart as $productId => $item)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="me-2">
                            <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" width="50">
                        </div>
                        <div class="flex-fill">
                            <div>{{ $item['name'] }}</div>
                            <div class="text-muted">Cant: {{ $item['quantity'] }} | ${{ $item['price'] }}</div>
                        </div>
                        <form action="{{ route('cart.remove', $productId) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">&times;</button>
                        </form>
                    </li>
                @endforeach
            </ul>
            <div class="mt-3">
                <strong>Total: ${{ array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)) }}</strong>
                <a href="{{ route('cart.index') }}" class="btn btn-primary btn-sm w-100 mt-2">Ir al carrito</a>
            </div>
        @else
            <p>Tu carrito está vacío.</p>
        @endif
    </div>
</div>

