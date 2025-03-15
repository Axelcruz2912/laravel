<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos</title>
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    color: #333;
}

.contact-us {
    text-align: center;
    padding: 40px 20px;
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

header {
    margin-bottom: 20px;
}

header h1 {
    font-size: 2.5rem;
    color: #2c3e50;
}

header p {
    font-size: 1.1rem;
    color: #7f8c8d;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 20px;
}

.contact-form label {
    font-size: 1rem;
    color: #34495e;
    text-align: left;
}

.contact-form input, .contact-form textarea {
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    width: 100%;
    box-sizing: border-box;
}

.contact-form button {
    padding: 10px 20px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.contact-form button:hover {
    background-color: #2980b9;
}

footer {
    margin-top: 30px;
    font-size: 1.1rem;
    color: #2c3e50;
}

</style>
<body>
    <section class="contact-us">
        <header>
            <h1>Contáctanos</h1>
            <p>¡Nos encantaría saber de ti! Completa el formulario y nos pondremos en contacto contigo.</p>
        </header>

        <form id="contact-form" class="contact-form">
            <label for="name">Nombre:</label>
            <input type="text" id="name" name="name" required placeholder="Ingresa tu nombre">

            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" required placeholder="Ingresa tu correo">

            <label for="message">Mensaje:</label>
            <textarea id="message" name="message" required placeholder="Escribe tu mensaje"></textarea>

            <button type="submit">Enviar</button>
        </form>

        <footer>
            <p>¡Esperamos tu mensaje pronto!</p>
        </footer>
    </section>

    <script>

        document.getElementById("contact-form").addEventListener("submit", function(event) {

            event.preventDefault();



            event.target.reset();

            setTimeout(function() {
                location.reload();
            }, 500);
        });
    </script>
</body>
</html>

