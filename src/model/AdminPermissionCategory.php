<?php


namespace joeStudio\admin\model;


use joeStudio\admin\helper\LoginHelper;
use joeStudio\admin\logic\Login;
use think\Model;
use traits\model\SoftDelete;

class AdminPermissionCategory extends Model
{
    use SoftDelete;

    protected $field = true;

    protected $auto = [];
    protected $insert = [];
    protected $update = ['category_status'];

    protected $pk = 'category_id';
    protected $delete_time = "delete_time";

    protected function setCategoryStatusAttr($value){
        return $value ? 1 : 0;
    }

}