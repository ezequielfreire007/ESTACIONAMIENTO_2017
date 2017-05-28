<?php
    session_start();

    $queHago = isset($_POST["queHago"]) ? $_POST["queHago"]:NULL;
    $res = "no ok";

    switch ($queHago) {
        case "1":
            if(isset($_POST["txtNombre"]) && isset($_POST["txtPassword"])){
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
            }
            break;
        case "2":
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
        default:
            echo "No se logro la solicitud";
            break;
    }

    echo $res;
?>