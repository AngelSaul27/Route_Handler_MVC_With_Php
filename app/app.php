<?php 
    class App{

        function __construct(){
            //$URL = isset($_GET['url']) ? $_GET['url'] : null;
            //echo 'LA URL ES: '.$URL.'<br>';
            //$URL = rtrim($URL, '/');
            //echo 'LA URL CON RTRIM ES: ' . var_dump($URL). '<br>';
            //$URL = explode('/', $URL);
            //echo 'LA URL CON EXPLODE ES: '.var_dump($URL). '<br>';

            require_once 'route/route.php';
            $ruta = new Route();

        }

    }
?>