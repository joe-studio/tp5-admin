<?php
namespace joeStudio\admin\controller;

class Index extends Admin
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {

       $admin_menu_list = db('adminMenu')->where([
           'parent_id'      =>  0,
           'category_id'    =>  1,
           'menu_status'    =>  1
       ])->select();

       foreach($admin_menu_list as $key => $value){
           $admin_menu_list[$key]['sub_menu_list']  = db('adminMenu')->where([
               'parent_id'      =>  $value['menu_id'],
               'category_id'    =>  1,
               'menu_status'    =>  1
           ])->select();
       }

       $params = [
           'admin_menu_list'    =>  $admin_menu_list
       ];

       return $this->view->fetch('index/index',$params);
    }

}
