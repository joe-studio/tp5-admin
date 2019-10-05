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

class AdminPermissionCategory extends Output
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

        isset($data['category_name'])   && $map['category_name'] = ['like', "%{$data['category_name']}%"];
        isset($data['category_status']) && $data['category_status'] ? $map['category_status']  = 0 : $map['category_status']  = 1;

        //从数据库查询数据
        $categoryList = $this->model->where($map)->paginate($rows,false,['query'=>$data]);

        //模板分页效果
        $page = $categoryList->render();

        $output = [
            'categoryList'          =>  $categoryList,
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

        $res = $this->model->save($data,['category_id'=>$data['category_id']]);

        $res ?
            $this->scene('form')->setStatus(true)->setMsg('编辑成功')->output()
            :
            $this->scene('form')->setStatus(false)->setMsg('更新数据失败')->output();
    }

    public function getRole($data){

        $category = $this->model->where($data)->find();

        $output = [
            'category'          =>  $category
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