<?php
namespace joeStudio\admin\behavior;

class Logic
{
    public function run(&$params)
    {

        $route = request()->routeInfo();

        $logic = '';

        if(isset($route['rule'][1]) && !empty($route['rule'][1])){
            $namespace = "\\joeStudio\\admin\\logic\\";
            $class = $route['rule'][1];
            $class = $namespace . $class;

            class_exists($class) && $logic = new $class();

            $namespace = "\\joeStudio\\admin\\model\\";
            $class = $route['rule'][1];
            $class = $namespace . $class;

            class_exists($class) && $logic->model = new $class();

            $namespace = "\\joeStudio\\admin\\validate\\";
            $class = $route['rule'][1];
            $class = $namespace . $class;

            class_exists($class) && $logic->validate = new $class();

            $params = $logic;
        }

    }
}