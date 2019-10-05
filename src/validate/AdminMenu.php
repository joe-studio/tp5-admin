<?php
namespace joeStudio\admin\validate;

use think\Validate;

class AdminMenu extends Validate
{
    protected $output;

    protected $rule = [
        'menu_name'             =>  'require',
        'category_id'           =>  'require'
    ];

    protected $message = [
        'menu_name.require'         =>  '菜单名必须填写',
        'category_id'               =>  '必须选择分类'
    ];

    protected $scene = [
        'insert'     =>  ['menu_name','category_id'],
        'update'     =>  ['menu_name','category_id'],
    ];

}