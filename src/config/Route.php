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

            //管理员菜单分组控制器路由
            'AdminMenuCategory/add'         =>  ['\joeStudio\admin\controller\AdminMenuCategory@categoryAdd',['method'=>'get']],
            'AdminMenuCategory/insert'      =>  ['\joeStudio\admin\controller\AdminMenuCategory@categoryInsert',['method'=>'post']],
            'AdminMenuCategory/show'        =>  ['\joeStudio\admin\controller\AdminMenuCategory@categoryShow',['method'=>'get']],
            'AdminMenuCategory/edit'        =>  ['\joeStudio\admin\controller\AdminMenuCategory@categoryEdit',['method'=>'get']],
            'AdminMenuCategory/update'      =>  ['\joeStudio\admin\controller\AdminMenuCategory@categoryUpdate',['method'=>'post']],

            //管理员菜单控制器路由
            'AdminMenu/add'                 =>  ['\joeStudio\admin\controller\AdminMenu@menuAdd',['method'=>'get']],
            'AdminMenu/insert'              =>  ['\joeStudio\admin\controller\AdminMenu@menuInsert',['method'=>'post']],
            'AdminMenu/show'                =>  ['\joeStudio\admin\controller\AdminMenu@menuShow',['method'=>'get']],
            'AdminMenu/edit'                =>  ['\joeStudio\admin\controller\AdminMenu@menuEdit',['method'=>'get']],
            'AdminMenu/update'              =>  ['\joeStudio\admin\controller\AdminMenu@menuUpdate',['method'=>'post']],
            'AdminMenu/trueDel'             =>  ['\joeStudio\admin\controller\AdminMenu@menuTrueDel',['method'=>'post']],
        ]

    ];

}