<?php
    require_once "./verificar.php";
    var_dump($_SESSION["usuario"]);   
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <script type="text/javascript" src="./js/jquery.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script type="text/javascript" src="./js/funciones.js"></script>
    </head>

    <body style="background-color:<?php 
									$usuario = $_SESSION["usuario"];
									echo $_COOKIE[$usuario];
								?>;">
        <button onclick="logout()">Salir</button>
        <input type="color" name="color" id="color">
        <button onclick="color()">Aceptar</button>
    </body>
</html>