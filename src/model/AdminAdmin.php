<?php


namespace joeStudio\admin\model;

use joeStudio\admin\logic\Login;
use think\Model;
use traits\model\SoftDelete;

class AdminAdmin extends Model
{
    use SoftDelete;

    protected $field = true;

    protected $auto = ['login_ip','last_login_time'];
    protected $insert = ['create_time','update_time'];
    protected $update = [];

    protected $pk = 'admin_id';
    protected $delete_time = "delete_time";

    protected function setLoginIpAttr(){
        return request()->ip();
    }

    protected function setPasswordAttr($value){
        return (new Login())->encryption($value);
    }

    protected function setLastLoginTimeAttr(){
        return time();
    }

    protected function setCreateTimeAttr(){
        return time();
    }

    protected function setUpdateTimeAttr(){
        return time();
    }

    protected function setStatusAttr($value){
        return $value ? 1 : 0;
    }
}