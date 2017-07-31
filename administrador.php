<?php
    session_start();
    require_once "clases/Fichada.php";
    $queHago = isset($_POST["queHago"]) ? $_POST["queHago"]:NULL;
    $res = "bad";

    switch ($queHago) {
        case "1":
           /* if(isset($_POST["txtNombre"]) && isset($_POST["txtPassword"])){
                if($_POST["txtNombre"] == "pepe" && $_POST["txtPassword"] == "123")
                {
                    $_SESSION["usuario"] = $_POST["txtNombre"];
                    $res = "ok";
                }
                if($_POST["txtNombre"] == "fulanito" && $_POST["txtPassword"] == "123")
                {
                    $_SESSION["usuario"] = $_POST["txtNombre"];
                    $res = "ok";
                }
            }*/

            
            break;
        case "2":
            date_default_timezone_set("America/Argentina/Buenos_Aires");
			$hora = date("Y-m-d H:i:s");
            Fichada::salida($_SESSION["usuario"]->legajo,$hora);
            session_destroy();
            $res = "ok";
            break;
        case "3":
            //genero una cookie
            if(isset($_POST["color"])){
                $usuario = $_SESSION["usuario"];
                setcookie($usuario,$_POST["color"],0,"/");
            }
            $res = "ok";
            break;
        case "4":
            break;
        case "5":
            break;
        case "6":
            break;
        case "7":
            break;
        case "8":
            break;
        case "9":
            break;
        case "10":
            break;
        default:
            echo "No se logro la solicitud";
            break;
    }

    echo $res;
?>