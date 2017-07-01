<?php
    require_once "./verificar.php";
    var_dump($_SESSION["usuario"]);   
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Panel de administracio</title>
        <script type="text/javascript" src="./js/jquery.js"></script>
        <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script type="text/javascript" src="./js/funciones.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>

    <body>
       	<nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Panel de administracion</a>
                </div>
   
                <ul class="nav navbar-nav navbar-right">
                
                <?php
                    echo "<li>
                            <a href='#'><span class='glyphicon glyphicon-user'></span>". $_SESSION['usuario']->nombre . "</a>
                         </li>";
                    echo"<li>
                            <a href='javascript:logout();'><span class='glyphicon glyphicon-log-in'></span> Desloguearse</a>
                         </li>";   
                ?>	
                </ul>
            </div>
        </nav>

        <div class='container'> 
				<div class='row'>
					<div class='col-sm-3'></div>
				        <div class='col-sm-5'>
                        <?php 
                        
                            if(isset($_SESSION['usuario']) != true) 
                            {
                                        
                                echo "  <h4>Ingresar al sistema</h4>";
                                echo "	<ul class='nav nav-pills nav-stacked' role='tablist'>";
                                echo " <a class='btn btn-custom btn-lg btn-block' id='btnLogin' href='login.php' role='button'>Log in</a>";
                                echo "	 <br>       ";
                                echo "  <a class='btn btn-custom btn-lg btn-block' id='btnLogin' href='registro.html' role='button'>Crear Cuenta</a> ";
                                echo "	</ul>";
                                    
                            }
                        ?>	
                        </div>
		                <div class='col-sm-3'></div>
				    </div>
                </div>

        </div>



        <button onclick="logout()">Salir</button>
        <input type="color" name="color" id="color">
        <button onclick="color()">Aceptar</button>

        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <p>Estacionamiento 2017</p> 
                            <p>Powered by <strong><a href="" target="_blank">Ezequiel A. Freire</a></strong></p> 
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>