<?php
/**
 * Created by dh2y.
 * Blog: http://blog.csdn.net/sinat_22878395
 * Date: 2018/4/26 0026 16:26
 * For: 登录模块
 */

namespace joeStudio\admin\logic;

use filter\Output;
use joeStudio\admin\model\Admin;
use joeStudio\admin\model\AdminRolePermission;

class AdminRole extends Output
{

    public function __construct(){

    }

    public function insert($data){

        $res = $this->validate->scene('insert')->batch()->check($data);

        if($res == false){

            $this
                ->scene('form')
                ->setStatus(false)
                ->setMsg($this->validate->getError())
                ->output();
        }

        $res = $this->model->save($data);

        $res ?
            $this->scene('form')->setStatus(true)->setMsg('新增成功')->output()
            :
            $this->scene('form')->setStatus(false)->setMsg('插入数据失败')->output();
    }

    public function search($data){
        //筛选条件
        $map = [];
        $rows = isset($data['rows']) ? $data['rows'] : 10;

        isset($data['role_name'])   && $map['role_name'] = ['like', "%{$data['role_name']}%"];
        isset($data['role_status']) && $data['role_status'] ? $map['role_status']  = 0 : $map['role_status']  = 1;

        //从数据库查询数据
        $roleList = $this->model->where($map)->paginate($rows,false,['query'=>$data]);

        //模板分页效果
        $page = $roleList->render();

        $output = [
            'roleList'          =>  $roleList,
            'page'              =>  $page
        ];

        return $output;
    }

    public function update($data){

        $res = $this->validate->scene('update')->batch()->check($data);

        if($res == false){

            $this
                ->scene('form')
                ->setStatus(false)
                ->setMsg($this->validate->getError())
                ->output();
        }

        $res = $this->model->save($data,['role_id'=>$data['role_id']]);

        $res ?
            $this->scene('form')->setStatus(true)->setMsg('编辑成功')->output()
            :
            $this->scene('form')->setStatus(false)->setMsg('更新数据失败')->output();
    }

    public function getRole($data){

        $role = $this->model->where($data)->find();

        $output = [
            'role'          =>  $role
        ];

        return $output;
    }

    public function getTemplateParamsPermission($data){
        $permissionCategoryList = db('adminPermissionCategory')->where([
            'category_status' =>  1
        ])->select();

        foreach($permissionCategoryList as $key => $value){
            $permissionList = db('adminPermission')->where([
                'category_id'   =>  $value['category_id'],
                'permission_status' =>  1
            ])->select();

            foreach($permissionList as $k => $v){
                $is_bind = db('adminRolePermission')->where([
                    'role_id'   =>  $data['role_id'],
                    'permission_id' =>  $v['permission_id']
                ])->count();

                if($is_bind > 0){
                    $permissionList[$k]['is_bind'] = 1;
                }else{
                    $permissionList[$k]['is_bind'] = 0;
                }
            }

            $permissionCategoryList[$key]['permissionList'] =  $permissionList;
        }

        $output = [
            'permissionCategoryList'   =>  $permissionCategoryList
        ];

        return $output;
    }

    public function trueDel($data)
    {

        $res = $this->model->destroy($data['id'],TRUE);

        $res ?
            $this->scene('form')->setStatus(true)->setMsg('删除成功')->output()
            :
            $this->scene('form')->setStatus(false)->setMsg('删除失败')->output();
    }

    public function bindRolePermission($data){

        $insertData = [];

        $rolePermissionList_original = db('adminRolePermission')->where([
            'role_id'   =>  $data['role_id']
        ])->column('permission_id');

        $permission_ids = isset($data['permission_ids']) ? $data['permission_ids'] : [];

        if($permission_ids){
            foreach($permission_ids as $key => $value){
                $permission_ids[$key] = (int)$value;
            }
        }

        $permission_ids_public = array_intersect($permission_ids,$rolePermissionList_original);

        $permission_ids_insert = array_diff($permission_ids,$permission_ids_public);

        $permission_ids_delete = array_diff($rolePermissionList_original,$permission_ids_public);

        $res = false;

        if($permission_ids_insert){

            foreach($permission_ids_insert as $key => $value){
                $insertData[$key]['role_id'] = $data['role_id'];
                $insertData[$key]['permission_id'] = $value;
            }

            $res = (new AdminRolePermission())->saveAll($insertData);
        }

        if($permission_ids_delete){
            foreach($permission_ids_delete as $permission_id){
                $res = db('adminRolePermission')->where([
                    'role_id'       =>  $data['role_id'],
                    'permission_id'    =>  $permission_id
                ])->delete();
            }
        }

        $res ?
            $this->scene('form')->setStatus(true)->setMsg('更新成功')->output()
            :
            $this->scene('form')->setStatus(false)->setMsg('更新失败')->setData($insertData)->output();
    }
}