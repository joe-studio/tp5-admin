<?php
namespace joeStudio\admin\validate;

use think\Validate;

class AdminRole extends Validate
{
    protected $output;

    protected $rule = [
        'role_name'             =>  'require',
    ];

    protected $message = [
        'role_name.require'         =>  '角色名必须填写',
    ];

    protected $scene = [
        'insert'     =>  ['role_name'],
        'update'     =>  ['role_name'],
    ];

}