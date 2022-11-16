<?php
class core__app {
    static function run() {
        $a = $_SERVER['REQUEST_URI'];
        $uri = rtrim(preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']), '/');
        $params = explode('/', trim($uri, '/'));
        $count = count($params);

        if ($count > 1) {
            $controller = $params[0];
            $method = $params[1];
        } else if ($count == 1) {
            $controller = 'index';

            if ($params[0] == '') {
                $method = 'index';
            } else {
                $method = $params[0];
            }
        }

        $filename = WEBROOT . '/controller/' . $controller . '.php';
        $controller = 'controller__'.$controller;

        try {
            if (!file_exists($filename)) {
                throw new Exception('controller ' . $controller . ' is not exists!');
                return;
            }
            include($filename);
            if (!class_exists($controller)) {
                throw new Exception('class ' . $controller . ' is not exists');
                return;
            }
            $obj = new ReflectionClass($controller);
            if (!$obj->hasMethod($method)) {
                throw new Exception('method ' . $method . ' is not exists');
                return;
            }
        } catch (Exception $e) {
            echo $e; //展示错误结果
            return;
        }

        $newObj = new $controller();
        call_user_func_array(array($newObj, $method), $params);
    }
}