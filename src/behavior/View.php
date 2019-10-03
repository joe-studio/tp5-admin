<?php
namespace joeStudio\admin\behavior;

use think\View as viewObject;

class View
{
    public function run(&$params)
    {
        //实例化视图引擎
        $params =  new viewObject([
            // 模板路径
            'view_path'    => dirname(__FILE__) . '/../view/',

        ],[
            '__URL__'    =>  'http://hplus.static.com/'
        ]);
    }
}