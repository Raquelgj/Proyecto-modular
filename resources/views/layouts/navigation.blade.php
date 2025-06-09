<nav class="navbar navbar-expand-lg navbar-light shadow-sm navbar-custom">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo de AquaTethys" style="height: 40px;">
        </a>



        <!-- Botón hamburguesa para abrir menú lateral izquierdo -->
        <button class="btn btn-outline-secondary me-3 d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuSidebar" aria-controls="menuSidebar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Elementos que se muestran en pantallas grandes (categorías centradas) -->
        <div class="collapse navbar-collapse d-none d-lg-flex justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 d-flex flex-row gap-3">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a>
                </li>
                @foreach ($categorias as $categoria)
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('productos.categoria') && request()->route('id') == $categoria->id ? 'active' : '' }}" href="{{ route('productos.categoria', $categoria->id) }}">
                        {{ $categoria->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <!-- Barra de búsqueda: siempre visible -->
        <form class="d-flex align-items-center me-2" role="search" method="GET" action="{{ route('productos.buscar') }}">
            <input class="form-control form-control-sm search-input" type="search" name="q" placeholder="Buscar" aria-label="Buscar" style="max-width: 180px;">
        </form>


        <!-- Botón carrito -->
        <button class="btn btn-outline-secondary me-3 position-relative" type="button" data-bs-toggle="offcanvas" data-bs-target="#cartSidebar" aria-controls="cartSidebar">
            <i class="bi bi-cart3 fs-5"></i>
            @if(session('cart') && count(session('cart')) > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                {{ collect(session('cart'))->sum('quantity') }}
                <span class="visually-hidden">productos en el carrito</span>
            </span>
            @endif
        </button>

        <!-- Perfil / Login visibles sólo en desktop -->
        <div class="d-none d-lg-block">
            @auth
            <div class="dropdown">
                <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    {{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Perfil</a></li>
                    <li><a class="dropdown-item" href="{{ route('orders.index') }}">Mis pedidos</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
            @else
            <a href="{{ route('login') }}" class="custom-btn-iniciar me-2">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="custom-btn-registrarse">Registrarse</a>
            @endauth
        </div>
    </div>
</nav>

<!-- Sidebar menú izquierdo con categorías y login (visible sólo en móvil) -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="menuSidebar" aria-labelledby="menuSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="menuSidebarLabel">Menú</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
        <ul class="list-unstyled mb-3 flex-grow-1">
            <li><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ url('/') }}">Inicio</a></li>
            @foreach ($categorias as $categoria)
            <li>
                <a class="nav-link {{ request()->routeIs('productos.categoria') && request()->route('id') == $categoria->id ? 'active' : '' }}" href="{{ route('productos.categoria', $categoria->id) }}">
                    {{ $categoria->name }}
                </a>
            </li>
            @endforeach
        </ul>

        <div class="mt-auto">
            @auth
            <div>
                <p class="mb-1">Hola, {{ Auth::user()->name }}</p>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary w-100 mb-2">Perfil</a>
                <a href="{{ route('orders.index') }}" class="btn btn-outline-primary w-100 mb-2">Mis pedidos</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Cerrar sesión</button>
                </form>
            </div>
            @else
            <a href="{{ route('login') }}" class="custom-btn-iniciar  mb-2">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="custom-btn-registrarse">Registrarse</a>
            @endauth
        </div>
    </div>
</div>

<!-- Sidebar del carrito (igual que antes) -->
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
                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" width="50">
                </div>
                <div class="flex-fill">
                    <div>{{ $item['name'] }}</div>
                    <div class="text-muted">
                        Cant: {{ $item['quantity'] }} |
                        {{ number_format($item['price'], 2, ',', '.') }} €
                    </div>
                </div>
                <form action="{{ route('cart.remove', $productId) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">&times;</button>
                </form>
            </li>
            @endforeach
        </ul>

        @php
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        @endphp

        <div class="mt-3">
            <strong>Total: {{ number_format($total, 2, ',', '.') }} €</strong>
            <a href="{{ route('cart.index') }}" class="btn btn-primary btn-sm w-100 mt-2 text-decoration-none" style="background-color: #a3cfbb; color: white;">Ir al carrito</a>
        </div>
        @else
        <p>Tu carrito está vacío.</p>
        @endif
    </div>
</div>
