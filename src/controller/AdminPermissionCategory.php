<?php
namespace joeStudio\admin\controller;

class AdminPermissionCategory extends Admin
{

    public function __construct()
    {
        parent::__construct();

    }

    public function categoryAdd()
    {
        return $this->view->fetch('admin_permission_category/category_add');
    }

    public function categoryInsert(){
        $this->logic->insert($this->input);
    }

    public function categoryShow(){

        $output = $this->logic->search($this->input);

        return $this->view->fetch('admin_permission_category/category_show',$output);
    }

    public function categoryEdit()
    {

        $output = $this->logic->getRole($this->input);

        return $this->view->fetch('admin_permission_category/category_edit',$output);
    }

    public function categoryUpdate(){
        $this->logic->update($this->input);
    }

    public function categoryTrueDel(){
        $this->logic->trueDel($this->input);
    }
}
