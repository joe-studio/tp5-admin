<?php
namespace joeStudio\admin\validate;

use think\Validate;

class AdminMenu extends Validate
{
    protected $output;

    protected $rule = [
        'menu_name'             =>  'require',
    ];

    protected $message = [
        'menu_name.require'         =>  '菜单名必须填写',
    ];

    protected $scene = [
        'insert'     =>  ['menu_name'],
        'update'     =>  ['menu_name'],
    ];

}