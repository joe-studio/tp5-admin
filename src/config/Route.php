<?php
namespace joeStudio\admin\config;

class Route
{
    public static $route = [
        //配置登录模块的路由**
        '/'                 =>  ['\joeStudio\admin\controller\Login@index',['method'=>'get']],

        '[admin]'   =>  [

            //登录控制器路由
            'Login/index'                   =>  ['\joeStudio\admin\controller\Login@index',['method'=>'get']],
            'Login/register'                =>  ['\joeStudio\admin\controller\Login@register',['method'=>'get']],
            'Login/logout'                  =>  ['\joeStudio\admin\controller\Login@logout',['method'=>'get']],
            'Login/checkInput'              =>  ['\joeStudio\admin\controller\Login@checkInput',['method'=>'post']],
            'Login/doLogin'                 =>  ['\joeStudio\admin\controller\Login@doLogin',['method'=>'post']],
            'Login/doRegister'              =>  ['\joeStudio\admin\controller\Login@doRegister',['method'=>'post']],

            //管理员首页
            'Index/index'                   =>  ['\joeStudio\admin\controller\Index@index',['method'=>'get']],

            //管理员控制器路由
            'AdminAdmin/add'                =>  ['\joeStudio\admin\controller\AdminAdmin@add',['method'=>'get']],

            //管理员菜单控制器路由
            'AdminMenuCategory/add'         =>  ['\joeStudio\admin\controller\AdminMenuCategory@add',['method'=>'get']],
            'AdminMenuCategory/insert'      =>  ['\joeStudio\admin\controller\AdminMenuCategory@insert',['method'=>'post']],
            'AdminMenuCategory/show'        =>  ['\joeStudio\admin\controller\AdminMenuCategory@show',['method'=>'get']],
            'AdminMenuCategory/edit'        =>  ['\joeStudio\admin\controller\AdminMenuCategory@edit',['method'=>'get']],
            'AdminMenuCategory/update'        =>  ['\joeStudio\admin\controller\AdminMenuCategory@update',['method'=>'post']],

            //管理员菜单控制器路由
            'AdminMenu/add'         =>  ['\joeStudio\admin\controller\AdminMenu@add',['method'=>'get']],
            'AdminMenu/insert'      =>  ['\joeStudio\admin\controller\AdminMenu@insert',['method'=>'post']],
            'AdminMenu/show'        =>  ['\joeStudio\admin\controller\AdminMenu@show',['method'=>'get']],
            'AdminMenu/edit'        =>  ['\joeStudio\admin\controller\AdminMenu@edit',['method'=>'get']],
            'AdminMenu/update'        =>  ['\joeStudio\admin\controller\AdminMenu@update',['method'=>'post']],
        ]

    ];

}