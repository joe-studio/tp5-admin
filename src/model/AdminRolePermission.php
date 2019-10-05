<?php


namespace joeStudio\admin\model;

use think\Model;

class AdminRolePermission extends Model
{

    protected $field = true;

    protected $auto = [];
    protected $insert = [];
    protected $update = [];

    protected $pk = 'role_permission_id';

}