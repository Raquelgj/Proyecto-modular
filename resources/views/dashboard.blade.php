@extends('layouts.app')

@section('content')
<div class="container mb-5 pb-5"> <!-- Aquí se añadió mb-5 para margen inferior -->


    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <!-- Sección de Productos Destacados -->
    <section class="featured-products py-5" style="padding-top: 80px;">
        <div class="container">
            <h3 class="text-center mb-4">Productos Destacados</h3>
            <div class="p-4 rounded-4" style="background-color: #ffffff;">
                <div id="featuredProductsCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner text-center">
                        @foreach ($featuredProducts as $index => $product)
                        <div class="carousel-item @if($index === 0) active @endif">
                            <div class="d-flex flex-column align-items-center">
                                <div style="max-width: 500px; height: 400px; overflow: hidden; border-radius: 1rem;">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="d-block w-100" alt="{{ $product->name }}" style="height: 100%; object-fit: cover;">
                                </div>
                                <div class="mt-3 carousel-caption d-block position-static">
                                    <h5 class="text-dark">{{ $product->name }}</h5>
                                    <p class="text-dark"><strong>Precio:</strong> {{ $product->price }}€</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Controles -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" style="filter: invert(100%);"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" style="filter: invert(100%);"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
        </div>
    </section>


    <!-- Sección "Sobre nosotros" -->
    <section class="about-us py-5">
        <div class="container">
            <!-- Imagen de encabezado de "Sobre nosotros" -->
            <div class="mb-4">
                <img src="{{ asset('images/sobreNosotros.png') }}" alt="Sobre nosotros" class="img-fluid w-100 rounded-image">
            </div>
            <div class="row align-items-start">
                <div class="col-md-6">
                    <h3 id="sobre-nosotros-title" class="mb-4">Sobre Nosotros</h3>
                </div>
                <div class="col-md-6">
                    <p>
                       Aqueatethys es una empresa joven y apasionada por el mundo acuático, que ha comenzado a ofrecer una amplia gama de productos especializados para acuarios. Su misión es proporcionar a los entusiastas de los acuarios todo lo necesario para crear ecosistemas saludables y estéticamente impresionantes. Desde alimentos de calidad para gambas y peces a sustratos para plantas y gambas, Aqueatethys se destaca por su compromiso con la sostenibilidad y el bienestar de las especies. La empresa también brinda asesoría personalizada para ayudar a sus clientes a mantener sus acuarios en condiciones óptimas.
                    </p>
                </div>
            </div>


        </div>
    </section>
</div>

<!-- Sección "Contáctanos" al final de la página -->
<section class="contact-us py-5" style="background-color: #ECF4F2; width: 100%; margin-left: 0; margin-right: 0;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Información de contacto (Izquierda) -->
            <div class="col-md-6">
                <p>Si tienes preguntas sobre nuestros productos para gambas, no dudes en contactarnos. Estamos aquí para ayudarte en tu experiencia de compra.</p>
                <ul>
                    <li><strong>Soporte</strong>: +34 661312784</li>
                    <li><strong>Asistencia</strong>: <a href="mailto:Aqueatethys@gmail.com">Aqueatethys@gmail.com</a></li>
                </ul>
            </div>

            <!-- Formulario de contacto (Derecha) -->
            <div class="col-md-6">
                <form method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del cliente</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Enviar consulta</button>
                </form>

                {{-- Aquí va el mensaje de éxito --}}
                @if(session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
@endsection
