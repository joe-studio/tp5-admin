<?php
namespace joeStudio\admin\config;

class Route
{
    public static $route = [
        //配置登录模块的路由**
        '/'                 =>  ['\joeStudio\admin\controller\Login@index',['method'=>'get']],

        '[admin]'   =>  [

            //登录控制器路由
            'Login/index'                       =>  ['\joeStudio\admin\controller\Login@index',['method'=>'get']],
            'Login/register'                    =>  ['\joeStudio\admin\controller\Login@register',['method'=>'get']],
            'Login/logout'                      =>  ['\joeStudio\admin\controller\Login@logout',['method'=>'get']],
            'Login/checkInput'                  =>  ['\joeStudio\admin\controller\Login@checkInput',['method'=>'post']],
            'Login/doLogin'                     =>  ['\joeStudio\admin\controller\Login@doLogin',['method'=>'post']],
            'Login/doRegister'                  =>  ['\joeStudio\admin\controller\Login@doRegister',['method'=>'post']],

            //管理员首页
            'Index/index'                       =>  ['\joeStudio\admin\controller\Index@index',['method'=>'get']],

            //管理员控制器路由
            'AdminAdmin/add'                    =>  ['\joeStudio\admin\controller\AdminAdmin@adminAdd',['method'=>'get']],
            'AdminAdmin/insert'                 =>  ['\joeStudio\admin\controller\AdminAdmin@adminInsert',['method'=>'post']],
            'AdminAdmin/show'                   =>  ['\joeStudio\admin\controller\AdminAdmin@adminShow',['method'=>'get']],
            'AdminAdmin/edit'                   =>  ['\joeStudio\admin\controller\AdminAdmin@adminEdit',['method'=>'get']],
            'AdminAdmin/update'                 =>  ['\joeStudio\admin\controller\AdminAdmin@adminUpdate',['method'=>'post']],
            'AdminAdmin/trueDel'                =>  ['\joeStudio\admin\controller\AdminAdmin@adminTrueDel',['method'=>'post']],
            'AdminAdmin/bindRole'               =>  ['\joeStudio\admin\controller\AdminAdmin@bindRole',['method'=>'get']],
            'AdminAdmin/adminRoleInsert'         =>  ['\joeStudio\admin\controller\AdminAdmin@adminRoleInsert',['method'=>'post']],

            //管理员菜单分组控制器路由
            'AdminMenuCategory/add'             =>  ['\joeStudio\admin\controller\AdminMenuCategory@categoryAdd',['method'=>'get']],
            'AdminMenuCategory/insert'          =>  ['\joeStudio\admin\controller\AdminMenuCategory@categoryInsert',['method'=>'post']],
            'AdminMenuCategory/show'            =>  ['\joeStudio\admin\controller\AdminMenuCategory@categoryShow',['method'=>'get']],
            'AdminMenuCategory/edit'            =>  ['\joeStudio\admin\controller\AdminMenuCategory@categoryEdit',['method'=>'get']],
            'AdminMenuCategory/update'          =>  ['\joeStudio\admin\controller\AdminMenuCategory@categoryUpdate',['method'=>'post']],

            //管理员菜单控制器路由
            'AdminMenu/add'                     =>  ['\joeStudio\admin\controller\AdminMenu@menuAdd',['method'=>'get']],
            'AdminMenu/insert'                  =>  ['\joeStudio\admin\controller\AdminMenu@menuInsert',['method'=>'post']],
            'AdminMenu/show'                    =>  ['\joeStudio\admin\controller\AdminMenu@menuShow',['method'=>'get']],
            'AdminMenu/edit'                    =>  ['\joeStudio\admin\controller\AdminMenu@menuEdit',['method'=>'get']],
            'AdminMenu/update'                  =>  ['\joeStudio\admin\controller\AdminMenu@menuUpdate',['method'=>'post']],
            'AdminMenu/trueDel'                 =>  ['\joeStudio\admin\controller\AdminMenu@menuTrueDel',['method'=>'post']],

            //管理员角色控制器路由
            'AdminRole/add'                     =>  ['\joeStudio\admin\controller\AdminRole@roleAdd',['method'=>'get']],
            'AdminRole/insert'                  =>  ['\joeStudio\admin\controller\AdminRole@roleInsert',['method'=>'post']],
            'AdminRole/show'                    =>  ['\joeStudio\admin\controller\AdminRole@roleShow',['method'=>'get']],
            'AdminRole/edit'                    =>  ['\joeStudio\admin\controller\AdminRole@roleEdit',['method'=>'get']],
            'AdminRole/update'                  =>  ['\joeStudio\admin\controller\AdminRole@roleUpdate',['method'=>'post']],
            'AdminRole/trueDel'                 =>  ['\joeStudio\admin\controller\AdminRole@roleTrueDel',['method'=>'post']],
            'AdminRole/bindPermission'          =>  ['\joeStudio\admin\controller\AdminRole@bindPermission',['method'=>'get']],
            'AdminRole/rolePermissionInsert'    =>  ['\joeStudio\admin\controller\AdminRole@rolePermissionInsert',['method'=>'post']],

            //管理员权限分组控制器路由
            'AdminPermissionCategory/add'       =>  ['\joeStudio\admin\controller\AdminPermissionCategory@categoryAdd',['method'=>'get']],
            'AdminPermissionCategory/insert'    =>  ['\joeStudio\admin\controller\AdminPermissionCategory@categoryInsert',['method'=>'post']],
            'AdminPermissionCategory/show'      =>  ['\joeStudio\admin\controller\AdminPermissionCategory@categoryShow',['method'=>'get']],
            'AdminPermissionCategory/edit'      =>  ['\joeStudio\admin\controller\AdminPermissionCategory@categoryEdit',['method'=>'get']],
            'AdminPermissionCategory/update'    =>  ['\joeStudio\admin\controller\AdminPermissionCategory@categoryUpdate',['method'=>'post']],
            'AdminPermissionCategory/trueDel'   =>  ['\joeStudio\admin\controller\AdminPermissionCategory@categoryTrueDel',['method'=>'post']],

            //管理员权限控制器路由
            'AdminPermission/add'               =>  ['\joeStudio\admin\controller\AdminPermission@permissionAdd',['method'=>'get']],
            'AdminPermission/insert'            =>  ['\joeStudio\admin\controller\AdminPermission@permissionInsert',['method'=>'post']],
            'AdminPermission/show'              =>  ['\joeStudio\admin\controller\AdminPermission@permissionShow',['method'=>'get']],
            'AdminPermission/edit'              =>  ['\joeStudio\admin\controller\AdminPermission@permissionEdit',['method'=>'get']],
            'AdminPermission/update'            =>  ['\joeStudio\admin\controller\AdminPermission@permissionUpdate',['method'=>'post']],
            'AdminPermission/trueDel'           =>  ['\joeStudio\admin\controller\AdminPermission@permissionTrueDel',['method'=>'post']],
        ]

    ];

}