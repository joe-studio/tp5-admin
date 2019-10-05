<?php
namespace joeStudio\admin\behavior;

use think\Controller;
use think\Request;
use think\Session;

class CheckPermission extends Controller
{
    public function run(&$params)
    {
        $roleInfo = Request::instance()->routeInfo();

        if(Session::get('admin_level')){
            if($roleInfo['rule'][1] != 'Login' && $roleInfo['rule'][1] != 'Index'){
                $permission = implode('/',$roleInfo['rule']);

                $adminId = Session::get('authId');

                $roleList = db('adminAdminRole')->where([
                    'admin_id'  =>  $adminId
                ])->select();

                $permissionList = [];

                foreach($roleList as $key => $value){
                    $rolePermissionList = db('adminRolePermission')->where([
                        'role_id'   =>  $value['role_id']
                    ])->select();

                    foreach($rolePermissionList as $k =>  $v ){

                        $permission_tmp = db('adminPermission')->where([
                            'permission_id' =>  $v['permission_id']
                        ])->column('permission_path');

                        $permissionList[] = $permission_tmp[0];
                    }

                }

                $is_access = in_array($permission,$permissionList);

                if(!$is_access){
                    echo "<script>alert('您没有权限访问')</script>";exit;
                }
            }
        }


    }
}