<?php
session_start();  // Inicia la sesión PHP

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    // Si no hay sesión activa, redirigir al usuario al login
    header("Location: login.html");
    exit();  // Detener la ejecución del código
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div transition-style="in:polygon:opposing-corners">
    <header class="header">
        <div class="menu container">
            <img src="Imagenes/Logo_cordero_Azul.png" width="60" height="60" class="imglogo">
            <input type="checkbox" id="menu" />
            <label for="menu">
                <img src="Imagenes/Ruby1.jpeg" class="menu-icono" alt="menu">
            </label>
            <nav class="navbar">
                <ul>
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="grupos.html">Grupos</a></li>
                    <li><a href="mediciones.html">Mediciones</a></li>
                     <!-- Si el usuario está logueado, mostrar el enlace para cerrar sesión -->
                     <?php if (isset($_SESSION['username'])): ?>
                        <li><a href="logout.php">Cerrar sesión</a></li>
                    <?php else: ?>
                        <!-- Si no está logueado, mostrar el enlace para iniciar sesión -->
                        <li><a href="login.html">Inicio de sesión</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>

        <div class="header-content container">
            <div class="header-txt">
                <h1>Consulta tus mediciones de  <span>Temperatura y pH</span> <br> aqui </h1>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto dolores qui saepe omnis esse, recusandae 
                    earum corporis eaque, quibusdam at sed dolorem maxime? Et, fuga non tempore quidem recusandae harum!                </p>
                <div class="butons">
                    <a href="notfound.html" class="btn-1">Informacion</a>
                    <!--<a href="#" class="btn-1">Personajes</a>-->
                </div>
            </div>
        </div>

    </header>

    </main>

    <section class="contact container">
        <div class="contact-content">
            <h3 class="h3">Suscribete a nuestro blog</h3 class="h3">
            <form>
                <input type="email" placeholder="Escribe tu correo">
                <a href="notfound.html" class="btn-1">Enviar</a>
            </form>

        </div>

    </section>

    <footer class="footer container">
        <div class="link">
            <a href="#" class="logo">Logo</a>
        </div>

        <div class="link">
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="#allpersonajes">Personajes</a></li>
                <li><a href="foro.html">Foro</a></li>
                <li><a href="login.html">Login</a></li>
            </ul>

        </div>

    </footer>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function moveToSelected(element) {

if (element == "next") {
  var selected = $(".selected").next();
} else if (element == "prev") {
  var selected = $(".selected").prev();
} else {
  var selected = element;
}

var next = $(selected).next();
var prev = $(selected).prev();
var prevSecond = $(prev).prev();
var nextSecond = $(next).next();

$(selected).removeClass().addClass("selected");

$(prev).removeClass().addClass("prev");
$(next).removeClass().addClass("next");

$(nextSecond).removeClass().addClass("nextRightSecond");
$(prevSecond).removeClass().addClass("prevLeftSecond");

$(nextSecond).nextAll().removeClass().addClass('hideRight');
$(prevSecond).prevAll().removeClass().addClass('hideLeft');

}

// Eventos teclado
$(document).keydown(function(e) {
  switch(e.which) {
      case 37: // left
      moveToSelected('prev');
      break;

      case 39: // right
      moveToSelected('next');
      break;

      default: return;
  }
  e.preventDefault();
});

$('#carousel div').click(function() {
moveToSelected($(this));
});

$('#prev').click(function() {
moveToSelected('prev');
});

$('#next').click(function() {
moveToSelected('next');
});
    </script>
    </div>
</body>
</html>