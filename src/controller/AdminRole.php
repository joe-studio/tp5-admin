<?php
namespace joeStudio\admin\controller;

class AdminRole extends Admin
{

    public function __construct()
    {
        parent::__construct();

    }

    public function roleAdd()
    {
        return $this->view->fetch('admin_role/role_add');
    }

    public function roleInsert(){
        $this->logic->insert($this->input);
    }

    public function roleShow(){

        $output = $this->logic->search($this->input);

        return $this->view->fetch('admin_role/role_show',$output);
    }

    public function roleEdit()
    {

        $output = $this->logic->getRole($this->input);

        return $this->view->fetch('admin_role/role_edit',$output);
    }

    public function roleUpdate(){
        $this->logic->update($this->input);
    }

    public function roleTrueDel(){
        $this->logic->trueDel($this->input);
    }

    public function bindPermission(){

        $output = $this->logic->getTemplateParamsPermission($this->input);

        return $this->view->fetch('admin_role/bind_permission',$output);
    }

    public function rolePermissionInsert(){
        $this->logic->bindRolePermission($this->input);
    }
}
