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
                        <form action="index.php" method="post">
                            <input type="text" placeholder="Ingrese su legajo" id="txtLegajo" name="txtLegajo" required>

                            <input type="password" placeholder="Ingrese su Password" id="txtPassword" name="txtPassword" required>

                            <button type="submit">Login</button>
                        </form>
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
        
        	<?php
	if(isset($_POST['txtLegajo']) && isset($_POST['txtPassword'])){
///***********************************************************************************************///
///COMO CLIENTE DEL SERVICIO WEB///
///***********************************************************************************************///
		
//1.- INCLUIMOS LA LIBRERIA NUSOAP DENTRO DE NUESTRO ARCHIVO
		require_once('./lib/nusoap.php');
		
//2.- INDICAMOS URL DEL WEB SERVICE
		$host = 'http://localhost/ESTACIONAMIENTO_2017/ws/loginWS.php';
		
//3.- CREAMOS LA INSTANCIA COMO CLIENTE
		$client = new nusoap_client($host . '?wsdl');

//3.- CHECKEAMOS POSIBLES ERRORES AL INSTANCIAR
		$err = $client->getError();
		if ($err) {
			echo '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
			die();
		}

//4.- INVOCAMOS AL METODO SOAP, PASANDOLE EL PARAMETRO DE ENTRADA
		$result = $client->call('Login', array($_POST["txtLegajo"],$_POST["txtPassword"]));
		
//5.- CHECKEAMOS POSIBLES ERRORES AL INVOCAR AL METODO DEL WS 
		/*if($result == "ok"){
            header('Location: home.php');
            echo "ingreso a result";
        }
        else{
            echo '<h2>ERROR EN WEBSERVICE</h2><pre>';
        }*/

        if ($client->fault) {
			echo '<h2>ERROR AL INVOCAR METODO:</h2><pre>';
			print_r($result);
			print_r($result2);
			print_r($result3);
			echo '</pre>';
		} 
		else {// CHECKEAMOS POR POSIBLES ERRORES
			$err = $client->getError();
			if ($err) {//MOSTRAMOS EL ERROR
				echo '<h2>ERROR EN EL CLIENTE:</h2><pre>' . $err . '</pre>';
			} 
			else {//MOSTRAMOS EL RESULTADO DEL METODO DEL WS.
				echo '<h2>Resultado Suma</h2>';
				echo '<pre>' . $result . '</pre>';
				echo '<h2>Resultado Multiplicacion</h2>';
				echo '<pre>' . $result2 . '</pre>';
				echo '<h2>Resultado Multiplicacion</h2>';
				echo '<pre>' . $result3 . '</pre>';
			}
		}
	}
	?>
    </body>
</html>