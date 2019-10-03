<?php
namespace joeStudio\admin\behavior;

use filter\Output as outputObject;

class Output
{
    public function run(&$params)
    {
        //实例化视图引擎
        $params =  new outputObject();
    }
}