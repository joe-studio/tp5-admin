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

class AdminPermission extends Output
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

        isset($data['permission_name'])   && $map['permission_name'] = ['like', "%{$data['permission_name']}%"];
        isset($data['category_id']) && $map['category_id'] = $data['category_id'];
        isset($data['permission_status']) && $data['permission_status'] ? $map['permission_status']  = 0 : $map['permission_status']  = 1;

        if(isset($data['all_permission']) && $data['all_permission'] == 1) unset($map['parent_id']);

        //从数据库查询数据
        $permissionList = $this->model->where($map)->paginate($rows,false,['query'=>$data]);

        $categoryList = db('adminPermissionCategory')->select();

        //模板分页效果
        $page = $permissionList->render();

        $output = [
            'permissionList'          =>  $permissionList,
            'page'              =>  $page,
            'categoryList'      =>  $categoryList,
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

        $res = $this->model->save($data,['permission_id'=>$data['permission_id']]);

        $res ?
            $this->scene('form')->setStatus(true)->setMsg('编辑成功')->output()
            :
            $this->scene('form')->setStatus(false)->setMsg('更新数据失败')->output();
    }

    public function getTemplateParamsAdd(){
        $categoryList = db('adminPermissionCategory')->where([
            'category_status'   =>  1
        ])->select();
        $permissionList = $this->model->select();

        $output = [
            'categoryList'  =>  $categoryList,
            'permissionList'      =>  $permissionList
        ];

        return $output;
    }

    public function getTemplateParamsEdit($data){
        $categoryList = db('adminPermissionCategory')->where([
            'category_status'   =>  1
        ])->select();
        $permissionList = $this->model->select();
        $permission = $this->model->where($data)->find();

        $output = [
            'categoryList'  =>  $categoryList,
            'permissionList'      =>  $permissionList,
            'permission'          =>  $permission
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
}