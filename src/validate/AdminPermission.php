<?php
namespace joeStudio\admin\validate;

use think\Validate;

class AdminPermission extends Validate
{
    protected $output;

    protected $rule = [
        'permission_name'             =>  'require',
        'category_id'                 =>  'require',
    ];

    protected $message = [
        'permission_name.require'         =>  '菜单名必须填写',
        'category_id.require'             =>  '分组必须选择,没有分组请先创建',
    ];

    protected $scene = [
        'insert'     =>  ['permission_name','category_id'],
        'update'     =>  ['permission_name','category_id'],
    ];

}