<?php 
    class kernelRoute {

        private static $Param = null, $Route = null, $Brackets = null;
        
        public function get($url, $controller = null, $method = null){
            self::$Route = isset($_GET['url']) ? $_GET['url'] : null ;
            self::$Route = rtrim(self::$Route, '/');

            #Solo incluye el dominio entonces esta accediendo a la página inicial
            if(self::$Route == null){
                $controller =require_once 'controllers/home.php';
                $controller = new Home();
                $controller->render();
                die();
            }

            #Existen parametros en las URL definidas
            $strpos = strpos($url, '{');
            if ($strpos !== false) {
                $explodeUrl = explode('/', $url);
                $explodeRoute = explode('/', self::$Route);

                #Sus parametros despues de / son mayor o igual que la URL definida
                if (count($explodeRoute) >= count($explodeUrl)) {
                    kernelRoute::getParam($explodeUrl, $explodeRoute);
                    $url = kernelRoute::reemplazar_ultimo($explodeUrl[self::$Brackets], '', $url);
                    $url = rtrim($url, '/');
                }
            }
            
            if($url == self::$Route){
                if($controller != null){
                    require_once 'controllers/'.$controller.'.php';
    
                    $strposClass = strpos($controller, '/');
                    
                    if($strposClass !== false){
                        $clase = explode('/', $controller);
                        $longitud = sizeof($clase);
                        $controller = $clase[$longitud-1];
                    }

                    $controllers = new $controller();

                    if (self::$Param != null) {
                        $controllers->{$method}(self::$Param); 
                       die();
                    }
                    
                    if($method != null){
                        
                        $controllers->{$method}();
                    }
                }
                $controllers->render();
                die();
            }
        }

        private function getParam($explodeUrl, $explodeRoute) {
            foreach ($explodeUrl as $key => $value) {
                $pos = strpos($value, '{');
                if ($pos !== false) {
                    self::$Brackets = $key;
                }
            }
            self::$Param = array_slice($explodeRoute, self::$Brackets);
            self::$Param  = implode('/', self::$Param);

            self::$Route = array_slice($explodeRoute, 0, self::$Brackets);
            self::$Route = implode('/',self::$Route);
        }

        private function reemplazar_ultimo($buscar, $remplazar, $texto) {
            $pos = strrpos($texto, $buscar);
            if ($pos !== false) {
                $texto = substr_replace($texto, $remplazar, $pos, strlen($buscar));
            }
            return $texto;
        }

    }
?>