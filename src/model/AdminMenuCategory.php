<?php


namespace joeStudio\admin\model;


use joeStudio\admin\helper\LoginHelper;
use joeStudio\admin\logic\Login;
use think\Model;
use traits\model\SoftDelete;

class AdminMenuCategory extends Model
{
    use SoftDelete;

    protected $field = true;

    protected $pk = 'admin_id';
    protected $delete_time = "delete_time";

}