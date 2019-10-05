<?php
namespace joeStudio\admin\validate;

use think\Validate;

class AdminPermissionCategory extends Validate
{
    protected $output;

    protected $rule = [
        'category_name'             =>  'require',
    ];

    protected $message = [
        'category_name.require'         =>  '角色名必须填写',
    ];

    protected $scene = [
        'insert'     =>  ['category_name'],
        'update'     =>  ['category_name'],
    ];

}