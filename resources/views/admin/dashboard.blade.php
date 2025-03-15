<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Scankey</title>
  <style>
    /* Reseteo y altura total de la página */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: #F5F5DC;
    }

    /* Contenedor principal para que el footer se quede al fondo */
    .content-wrapper {
      min-height: calc(100vh - 60px);
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
    }

    /* Encabezado / Navbar */
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background: #3C3633;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
      margin: 0;
      padding: 0;
    }

    .nav-links li {
      display: inline;
    }

    .nav-links li a {
      text-decoration: none;
      color: #747254;
      font-weight: bold;
      transition: color 0.3s ease-in-out;
    }

    .nav-links li a:hover {
      color: white;
    }

    .logo {
      flex-grow: 1;
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      color: #747254;
    }

    .user-section {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    .user-section span {
      color: #F5F5DC;
      font-weight: bold;
    }

    /* Botón de Cerrar Sesión */
    .logout-btn {
      padding: 10px 20px;
      background-color: #e74c3c;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .logout-btn:hover {
      background-color: #c0392b;
    }

    /* Sección principal */
    .hero {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 50px;
      background: #F5F5DC;
    }

    .text-content h1 {
      font-size: 36px;
      text-transform: capitalize;
    }

    .text-content p {
      font-size: 16px;
      color: #000000;
    }

    .slider-container {
      position: relative;
      width: 100%;
      max-width: 500px;
      margin: auto;
      overflow: hidden;
    }

    .slider {
      display: flex;
      transition: transform 0.5s ease-in-out;
    }

    .slider img {
      width: 100%;
      object-fit: cover;
      border-radius: 5px;
    }

    /* Pie de página */
    .footer-banner {
      height: 60px;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #3C3633;
      color: #F5F5DC;
      font-size: 14px;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-top: 30px;
    }

    /* Ajustes responsivos */
    @media (max-width: 768px) {
      .hero {
        flex-direction: column;
        text-align: center;
      }

      .slider-container {
        max-width: 300px;
      }

      .navbar {
        flex-direction: column;
      }

      .nav-links {
        flex-direction: column;
        align-items: center;
        padding: 10px 0;
      }
    }
  </style>
</head>
<body>
  <div class="content-wrapper">
    <nav class="navbar">
      <ul class="nav-links">
        <li><a href="{{ route('about') }}">Sobre nosotros</a></li>
        <li><a href="{{ route('contactanos') }}">Contáctanos</a></li>
        <li><a href="{{ route('codigo') }}">Nuestro Proyecto</a></li>
        <li><a href="{{route('usuarios') }}">Lista de Usuarios</a></li>
        <li><a href="{{route('torniquetes') }}">Torniquetes</a></li>
        <li><a href="{{route('accesos')}}">Accesos</a></li>
      </ul>
      <div class="logo">Scankey</div>
      <div class="user-section">
        <span>Admin</span>
        <form action="{{ route('cerrar_sesion') }}" method="POST">
          @csrf
          <button type="submit" class="logout-btn">Cerrar Sesión</button>
        </form>
      </div>
    </nav>

    <section class="hero">
      <div class="text-content">
        <h1>¡Mucho gusto!</h1>
        <h4>Somos Axel, Aranza y Gael, desarrolladores apasionados por la tecnología.</h4>
        <p>En Scankey, llevamos la seguridad y la innovación a otro nivel...</p>
      </div>

      <div class="slider-container">
        <div class="slider">
            <img src="{{ asset('Imagenes/imagen1.jpg') }}" alt="Imagen 1">
            <img src="{{ asset('Imagenes/imagen2.jpg') }}" alt="Imagen 2">
            <img src="{{ asset('Imagenes/imagen3.jpg') }}" alt="Imagen 3">
        </div>
      </div>
    </section>
  </div>

  <div class="footer-banner">
    <p>© 2025 SCANKEY. ALL RIGHTS RESERVED.</p>
  </div>

  <script>
    let currentIndex = 0;
    const slides = document.querySelectorAll(".slider img");
    const totalSlides = slides.length;

    function updateSlider() {
      const offset = -currentIndex * 100;
      document.querySelector(".slider").style.transform = `translateX(${offset}%)`;
    }

    function nextSlide() {
      currentIndex = (currentIndex + 1) % totalSlides;
      updateSlider();
    }

    setInterval(nextSlide, 3000);
  </script>
</body>
</html>
