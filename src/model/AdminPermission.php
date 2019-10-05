<?php


namespace joeStudio\admin\model;


use joeStudio\admin\helper\LoginHelper;
use joeStudio\admin\logic\Login;
use think\Model;
use traits\model\SoftDelete;

class AdminPermission extends Model
{
    use SoftDelete;

    protected $field = true;

    protected $auto = [];
    protected $insert = [];
    protected $update = ['permission_status'];

    protected $pk = 'permission_id';
    protected $delete_time = "delete_time";

    protected function setPermissionStatusAttr($value){
        return $value ? 1 : 0;
    }
}