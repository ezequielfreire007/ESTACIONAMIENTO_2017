<?php
    require_once "./verificar.php";
    //var_dump($_SESSION["usuario"]);   
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
        <!-- MENU PRINCIPAL DEL PANEL -->
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

        <!-- MENU DE NAVEGACION -->
        <!-- USUARIO ADMINISTRADOR y EMPLEADO -->
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="#">Operaciones</a>
                </div>
                <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Pisos</a></li>
                </ul>
                <?php
                    if($_SESSION['usuario']->tipo == 0){
                        echo "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#adm'>Operaciones de administrador</button>";
                        echo "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#emp'>Operaciones de playa</button>";
                        echo "<div class='btn-group'>";
                            echo "<div id='adm' class='collapse'>";
                                echo "<button class='btn btn-primary navbar-btn'data-toggle='collapse' data-target='#fich'onclick='traerFichadas()'>Fichadas</button>";
                                echo "<button class='btn btn-primary navbar-btn'>Cantidad de operaciones</button>";
                                echo "<button class='btn btn-primary navbar-btn' data-toggle='collapse' data-target='#altus'>Alta Usuario</button>";
                                echo "<button type='button' class='btn btn-primary navbar-btn' data-toggle='collapse' data-target='#tabus' onclick='traerUsuarios()'>Mostrar Usuarios</button>";//
                            echo "</div>";
                            echo "<div id='emp' class='collapse'>";
                                echo "<button class='btn btn-success navbar-btn' data-toggle='collapse' data-target='#altau'onclick='traerPisos()'>Alta Auto</button>";
                                echo "<button class='btn btn-success navbar-btn'data-toggle='collapse' data-target='#retAut'>Retirar Auto</button>";
                                echo "<button class='btn btn-success navbar-btn' data-toggle='collapse' data-target='#tabEst'onclick='traerEstacionamiento()'>Estacionamiento</button>";
                                echo "<button type='button' class='btn btn-success' data-toggle='collapse' data-target='#tabAut'onclick='traerAutos()'>Traer Autos</button>";
                            echo "</div>";

                        echo "</div>";
                    }else{
                        echo "<button type='button' class='btn btn-info' data-toggle='collapse' data-target='#emp'>Operaciones de playa</button>";
                        echo "<div class='btn-group'>";
                            echo "<div id='emp' class='collapse'>";
                                echo "<button class='btn btn-success navbar-btn' data-toggle='collapse' data-target='#altau' onclick='traerPisos()'>Alta Auto</button>";
                                echo "<button class='btn btn-success navbar-btn'data-toggle='collapse' data-target='#retAut'>Retirar Auto</button>";
                                echo "<button class='btn btn-success navbar-btn' data-toggle='collapse' data-target='#tabEst'onclick='traerEstacionamiento()'>Estacionamiento</button>";
                                echo "<button type='button' class='btn btn-success' data-toggle='collapse' data-target='#tabAut'onclick='traerAutos()'>Traer Autos</button>";
                            echo "</div>";
                        echo "</div>";
                    }
                    
                ?>
            </div>
        </nav>

        <!-- FORMULARIOS DE USUARIO -->
        <div class="container">
             <!-- ALTA USUARIO -->
            <div id="altus" class="collapse"> 
                <h1>Alta de usuario</h1>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="nomb">Nombre:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="leg">Legajo:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="legajo" placeholder="Legajo">
                    </div>
                </div>

                <label class="control-label col-sm-2" for="pwd">Password:</label>
                <div class="col-sm-10">          
                    <input type="password" class="form-control" id="password" placeholder="Password" name="pwd">
                </div>

                <label class="control-label col-sm-2" for="tip">Tipo:</label>
                <select class="form-control" id="tipo">
                    <option value="0" selected="selected">Administrador</option>
                    <option value="1">Usuario</option>
                </select>

                <label class="control-label col-sm-2" for="tur">Turno:</label>
                <select class="form-control" id="turno">
                    <option value="1" selected="selected">Mañana</option>
                    <option value="2">Tarde</option>
                    <option value="3">Noche</option>
                </select>

                <label class="control-label col-sm-2" for="hab">Estado:</label>
                <select class="form-control" id="estado">
                    <option value="1" selected="selected">Habilitado</option>
                    <option value="2">Suspendido</option>
                </select>
                <br>
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-success" onclick="guardarUsuario()">Guardar</button>
                        <!--<button type="button" class="btn btn-success" onclick="traerUsuarios()">Traer</button>-->
                    </div>
                </div>
                
            </div> <!--Fin Alta -->  

            <!-- MOSTRAR USUARIOS -->
            <div id="tabus" class="collapse"> 
                <div id="modtur" class="collapse"> 
                    <h2>Modificar turno</h2> 
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="leg">Legajo:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="legajoMod" placeholder="Legajo" disabled>
                        </div>
                    </div>
                    <label class="control-label col-sm-2" for="tur">Turno:</label>
                    <select class="form-control" id="turnoMod">
                        <option value="1" selected="selected">Mañana</option>
                        <option value="2">Tarde</option>
                        <option value="3">Noche</option>
                    </select>
                    <br>
                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#modtur" onclick="modificarUsuario()">Modificar Turno</button>
                        </div>
                    </div>
                </div>
                <h2>Tabla de usuarios</h2>         
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Legajo</th>
                        <th>Tipo</th>
                        <th>Turno</th>
                        <th>Estado</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                    <tbody id="traerUs">
                    
                    </tbody>
                </table>
            </div><!--Fin mostrar usuarios-->

            <!--FICHADAS-->
            <div id="fich" class="collapse">
                <h2>Fichadas</h2>         
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Legajo</th>
                        <th>Ingreso</th>
                        <th>Salida</th>
                    </tr>
                    </thead>
                    <tbody id="traeFich">
                    
                    </tbody>
                </table>
            </div>

            <!-- FORMULARIOS DE AUTO-->
            <div id="altau" class="collapse">
            <!-- ALTA AUTO-->
                <h1>Alta de auto</h1>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="nomb">Marca:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="marca" placeholder="Marca">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="leg">Patente:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="patente" placeholder="Patente">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="leg">Color:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="color" placeholder="Color">
                    </div>
                </div>

                <label class="control-label col-sm-2" for="tur">Piso:</label>
                <select class="form-control" id="piso" onclick="traerLugar()">
                    <option value="0" >Ninguno</option>
                </select>

                <label class="control-label col-sm-2" for="tur">Lugar:</label>
                <select class="form-control" id="lugar" >
                    <option value="0" selected="selected">Ninguno</option>
                </select>

                <br>
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-success" onclick="guardarAuto()">Guardar Auto</button>
                        <!--<button type="button" class="btn btn-success" onclick="traerUsuarios()">Traer</button>-->
                    </div>
                </div>

            </div><!--Fin Alta Auto-->
            
            <div id="tabEst" class="collapse">
             <h2>Estacionamiento </h2>         
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Piso</th>
                        <th>Lugar</th>
                        <th>Ocupado</th>
                        <th>Discapacitado</th>
                    </tr>
                    </thead>
                    <tbody id="traerEs">
                    
                    </tbody>
                </table>
            </div>

            <!-- Autos ingresados y retirar auto-->
            <div id="tabAut" class="collapse">
                <div id="retAut" class="collapse"> 
                    <h2>Modificar turno</h2> 
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="leg">Patente:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="patenteMod" placeholder="Patente" >
                        </div>
                    </div>
                    <br>
                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#retAut" onclick="retirarAuto()">Retirar auto</button>
                        </div>
                    </div>
                </div>

                <h2>Autos ingresados</h2>         
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Lugar</th>
                        <th>Patente</th>
                        <th>Marca</th>
                        <th>Color</th>
                        <th>Ingreso</th>
                    </tr>
                    </thead>
                    <tbody id="traerAut">
                    
                    </tbody>
                </table>
            </div>
        </div> 


    </body>
</html>