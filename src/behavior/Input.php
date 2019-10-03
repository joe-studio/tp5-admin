<?php
namespace joeStudio\admin\behavior;

use think\Request;
use think\View as viewObject;

class Input
{
    public function run(&$params)
    {
        $require = Request::instance();

        //实例化视图引擎
        $params =  strtolower($require->method()) == 'post' ? input('post.') : input();
    }
}