<?php
    
    class Route {
        public $route_control;
        public $route;
        public $set404;
        
        public function __construct($route_param) {
            $this->route_control = $route_param;
        }

        public function acc404() {
            require "./Controllers/Error.php";                 

            $control = new Errors();
            $control->get404();
        }

        public function read() {
            $cond = false;
            foreach($this->route as $path => $controllerPath) {
                if($path == $this->route_control) {
                    $controller = explode("@", $controllerPath);
                    require "./Controllers/$controller[0]".".php";
                    
                    $controllerString = $controller[0];
                    $methodString = $controller[1];

                    $control = new $controllerString();
                    $control->$methodString();
                    $cond = true;
                    break;
                } else {
                    continue;
                }                
            }

            if(!$cond) {
                $this->acc404();
            }
        }

        
    }

    $route = isset($_GET['page']) ? $_GET['page'] : "default";

    $r = new Route($route);
    $r->route['default'] = "Home@index";
    $r->route['api.mapel'] = "Home@api_get";

    $r->set404 = "Error@get404";
    $r->read();
    

?>
