<?php
namespace joeStudio\admin\config;

class Route
{
    public static $route = [
        //配置登录模块的路由**
        '/'                 =>  ['\joeStudio\admin\controller\Login@index',['method'=>'get']],
        '[admin]'   =>  [
            'login/index'         =>  ['\joeStudio\admin\controller\Login@index',['method'=>'get']],
            'login/register'      =>  ['\joeStudio\admin\controller\Login@register',['method'=>'get']],
            'login/home'          =>  ['\joeStudio\admin\controller\Login@home',['method'=>'get']],
            'login/logout'        =>  ['\joeStudio\admin\controller\Login@logout',['method'=>'get']],
            'login/checkInput'    =>  ['\joeStudio\admin\controller\Login@checkInput',['method'=>'post']],
            'login/doLogin'       =>  ['\joeStudio\admin\controller\Login@doLogin',['method'=>'post']],
            'login/doRegister'    =>  ['\joeStudio\admin\controller\Login@doRegister',['method'=>'post']],
        ]

    ];

}