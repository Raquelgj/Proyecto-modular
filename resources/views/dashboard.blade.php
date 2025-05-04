@extends('layouts.app')

@section('content')
<div class="container mb-5 pb-5"> <!-- Aquí se añadió mb-5 para margen inferior -->
    <h1>Dashboard</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h2>Bienvenido </h2>
    <p>

    
    </p>

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
                        En Aquatethys, somos apasionados por la acuariofilia y nos dedicamos a ofrecer productos de alta calidad para todos los amantes de los acuarios. Nuestra misión es hacer que tu experiencia con los acuarios sea más fácil y agradable, brindándote productos de calidad, asesoría y atención al cliente excepcionales.
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
                    <li><strong>Soporte</strong>: +34 695233333</li>
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
            </div>
        </div>
    </div>
</section>
@endsection