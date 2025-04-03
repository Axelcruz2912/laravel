<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto IoT - Acceso con QR</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: #F5F5DC;
    color: #333;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background: #3C3633;
    position: relative;
}

.logo {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    font-size: 24px;
    font-weight: bold;
    color: #747254;
}

.nav-links {
    list-style: none;
    display: flex;
    gap: 20px;
}

.nav-links li a {
    text-decoration: none;
    color:  #747254;
    font-weight: bold;
    position: relative;
    transition: color 0.3s ease-in-out;
}

.nav-links li a:hover {
    color: white;
}

.container {
    max-width: 900px;
    margin: 40px auto;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
}

h1 {
    color: #3C3633;
    text-align: center;
    font-size: 32px;
    margin-bottom: 20px;
}

h2 {
    color: #3C3633;
    font-size: 24px;
    margin-bottom: 10px;
}

.section {
    margin-bottom: 25px;
}

.section p, .section ul, .section ol {
    font-size: 18px;
    line-height: 1.6;
}

.section ul {
    list-style: none;
    padding: 0;
}

.section ul li {
    background: #FFD700;
    color: #3C3633;
    padding: 10px;
    margin: 5px 0;
    border-radius: 5px;
    font-weight: bold;
}

.section ol {
    padding-left: 20px;
}

.section ol li {
    margin-bottom: 10px;
}

.footer-banner {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #3C3633;
    color: #FFD700;
    padding: 15px 20px;
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

</style>
<body>
    <nav class="navbar">
        <ul class="nav-links">
            @if(session('tipo_usuario') === 'admin')
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @elseif(session('tipo_usuario') === 'visitante')
                <li><a href="{{ route('visitante.dashboard') }}">Dashboard</a></li>
            @elseif(session('tipo_usuario') === 'alumno')
                <li><a href="{{ route('alumno.dashboard') }}"> Dashboard</a></li>
            @endif

            <li><a href="{{ route('about') }}">Sobre Nosotros</a></li>
            <li><a href="{{ route('contactanos') }}">Contáctanos</a></li>
        </ul>
        <div class="logo">IoT QR Access</div>
    </nav>

    <div class="container">
        <h1>Proyecto IoT - Sistema de Acceso con QR</h1>

        <div class="section" id="descripcion">
            <h2>Descripción</h2>
            <p>Este proyecto integra tecnología IoT con autenticación mediante códigos QR dinámicos para gestionar accesos de manera segura y eficiente. Los usuarios generan un código QR desde su dispositivo móvil, el cual cambia tras cada escaneo para evitar fraudes. Al presentar el QR en un torniquete o puerta inteligente, el sistema valida la identidad en tiempo real a través de una API, registrando cada acceso en la base de datos. Ideal para oficinas, gimnasios, eventos y espacios con control de entrada, este sistema optimiza la seguridad y la experiencia del usuario</p>

        <div class="section" id="componentes">
            <h2>Componentes</h2>
            <ul>
                <li><strong>Aplicación Web (Laravel):</strong> Maneja la autenticación de usuarios y la generación de códigos QR.</li>
                <li><strong>API (JavaScript):</strong> Facilita la comunicación entre la web, la base de datos y los dispositivos IoT.</li>
                <li><strong>Dispositivo IoT:</strong> Escanea y valida los códigos QR en los torniquetes.</li>
                <li><strong>Base de Datos:</strong> Registra accesos y controla los permisos de cada usuario.</li>
            </ul>
        </div>

        <div class="section" id="funcionamiento">
            <h2>Funcionamiento</h2>
            <ol>
                <li>El usuario se registra e inicia sesión en la aplicación web.</li>
                <li>Se genera un código QR único y temporal en su móvil.</li>
                <li>El código QR se escanea en el torniquete con el dispositivo IoT.</li>
                <li>El dispositivo IoT consulta la API para validar el acceso.</li>
                <li>Si es válido, se autoriza la entrada y se registra en la base de datos.</li>
            </ol>
        </div>

        <div class="section" id="ventajas">
            <h2>Ventajas</h2>
            <ul>
                <li>Mayor seguridad mediante códigos QR dinámicos.</li>
                <li>Registro en tiempo real de accesos.</li>
                <li>Integración con múltiples dispositivos IoT.</li>
                <li>Fácil implementación en oficinas, eventos y gimnasios.</li>
            </ul>
        </div>
    </div>
</body>
</html>
