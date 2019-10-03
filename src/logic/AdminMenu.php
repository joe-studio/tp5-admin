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

class AdminMenu extends Output
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

        $data['menu_status'] = isset($data['menu_status']) && $data['menu_status'] ? 1 : 0;

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

        isset($data['menu_name'])   && $map['menu_name'] = ['like', "%{$data['menu_name']}%"];
        isset($data['category_id']) && $map['category_id'] = $data['category_id'];
        isset($data['parent_id'])   && isset($data['parent_id']) ? $map['parent_id'] = $data['parent_id'] : $map['parent_id'] = 0;
        isset($data['menu_status']) && $data['menu_status'] ? $map['menu_status']  = 0 : $map['menu_status']  = 1;

        if(isset($data['all_menu']) && $data['all_menu'] == 1) unset($map['parent_id']);

        //从数据库查询数据
        $menuList = $this->model->where($map)->paginate($rows,false,['query'=>$data]);

        $categoryList = db('adminMenuCategory')->select();
        $parentMenuList = $this->model->where([
            'parent_id' =>  0
        ])->select();

        foreach($menuList as $key => $value){

            $parentMenu = db('adminMenu')->where('menu_id',$value['parent_id'])->column('menu_name');

            $menuList[$key]['parent_menu_name'] = $parentMenu ? $parentMenu[0] : '无';
        }

        //模板分页效果
        $page = $menuList->render();

        $output = [
            'menuList'          =>  $menuList,
            'page'              =>  $page,
            'categoryList'      =>  $categoryList,
            'parentMenuList'    =>  $parentMenuList,
        ];

        isset($map['parent_id']) && $output['parent_id'] = $map['parent_id'];

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

        $data['menu_status'] = isset($data['menu_status']) && $data['menu_status'] ? 1 : 0;

        $res = $this->model->save($data,['menu_id'=>$data['menu_id']]);

        $res ?
            $this->scene('form')->setStatus(true)->setMsg('编辑成功')->output()
            :
            $this->scene('form')->setStatus(false)->setMsg('更新数据失败')->output();
    }

    public function getTemplateParamsAdd(){
        $categoryList = db('adminMenuCategory')->select();
        $menuList = $this->model->select();

        $output = [
            'categoryList'  =>  $categoryList,
            'menuList'      =>  $menuList
        ];

        return $output;
    }

    public function getTemplateParamsEdit($data){
        $categoryList = db('adminMenuCategory')->select();
        $menuList = $this->model->select();
        $menu = $this->model->where($data)->find();

        $output = [
            'categoryList'  =>  $categoryList,
            'menuList'      =>  $menuList,
            'menu'          =>  $menu
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