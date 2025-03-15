<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros</title>
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    color: #333;
    line-height: 1.6;
    margin: 0;
    padding: 0;
}

.about-us {
    text-align: center;
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

header {
    margin-bottom: 30px;
}

header h1 {
    font-size: 3rem;
    color: #2c3e50;
}

header p {
    font-size: 1.2rem;
    color: #7f8c8d;
}

.team {
    display: flex;
    justify-content: space-around;
    margin-top: 40px;
}

.member {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 250px;
    text-align: center;
    transition: transform 0.3s ease;
}

.member h2 {
    color: #34495e;
    font-size: 1.5rem;
    margin-bottom: 15px;
}

.member p {
    color: #7f8c8d;
    font-size: 1rem;
}

.member:hover {
    transform: translateY(-10px);
}

footer {
    margin-top: 40px;
    font-size: 1.1rem;
    color: #2c3e50;
}

</style>
<body>
    <section class="about-us">
        <header>
            <h1>Sobre Nosotros</h1>
            <p>Somos Axel, Aranza y Gael, desarrolladores universitarios apasionados por la tecnología.</p>
        </header>

        <div class="team">
            <div class="member">
                <h2>Axel</h2>
                <p>Estudiante de ingeniería de software. Me encanta crear soluciones innovadoras que resuelvan problemas reales.</p>
            </div>
            <div class="member">
                <h2>Aranza</h2>
                <p>Apasionada por el diseño web y la programación. Busco mejorar la experiencia del usuario en cada proyecto.</p>
            </div>
            <div class="member">
                <h2>Gael</h2>
                <p>Futuro ingeniero en computación. Me enfoco en la creación de aplicaciones funcionales y eficientes.</p>
            </div>
        </div>

        <footer>
            <p>¡Estamos emocionados por lo que el futuro nos depara!</p>
        </footer>
    </section>
</body>
</html>
