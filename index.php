<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <script type="text/javascript" src="./js/jquery.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script type="text/javascript" src="./js/funciones.js"></script>
        <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
        <link rel="stylesheet" href="./css/login.css">
    </head>

    <body>
        <header>
            <h1>CONTROL DE ESTACIONAMIENTO</h1>
        </header>

        <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
        <section>
            <div id="id01" class="modal">
                <div class="modal-content animate">
                    <div class="imgcontainer">
                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span><br>
                    <!--  <img src="img_avatar2.png" alt="Avatar" class="avatar"> -->
                    </div>

                    <div class="container">
                        <!--<label><b>Nombre</b></label>-->
                        <input type="text" placeholder="Ingrese su nombre" id="txtNombre" name="txtNombre" required>

                        <!--<label><b>Password</b></label>-->
                        <input type="password" placeholder="Ingrese su Password" id="txtPassword" name="txtPassword" required>

                        <button onclick="login()">Login</button>
                    <!--  <input type="checkbox" checked="checked"> Remember me -->
                    </div>

                    <div class="container" style="background-color:#f1f1f1">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancelar</button>
                    <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
                    </div>
                </div>
            </div>

            <script>
            // Get the modal
            var modal = document.getElementById('id01');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
            </script>
        </section>
        

        <!--<footer class="container-fluid text-center">
            <p>Copyright © 2017 - UTN</p>
        </footer>-->
    </body>
</html>