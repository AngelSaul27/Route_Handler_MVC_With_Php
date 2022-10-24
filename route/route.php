<?php 

    require_once 'app/kernelRoute.php';
    class Route extends kernelRoute{

        function __construct()
        {   
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
            }

            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                Route::get('/');
                Route::get('asd/{$id}', 'test/test', 'hello');
                Route::get('asd/example');
                Route::get('asd/asd/{$id}');
                Route::get('asd');
            }


            echo 'INVALIDA';
        }

    }


?>