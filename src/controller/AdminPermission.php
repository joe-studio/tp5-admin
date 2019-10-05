<?php
namespace joeStudio\admin\controller;

class AdminPermission extends Admin
{

    public function __construct()
    {
        parent::__construct();

    }

    public function permissionAdd()
    {
        $params = $this->logic->getTemplateParamsAdd();

        return $this->view->fetch('admin_permission/permission_add',$params);
    }

    public function permissionInsert(){
        $this->logic->insert($this->input);
    }

    public function permissionShow(){

        $output = $this->logic->search($this->input);

        return $this->view->fetch('admin_permission/permission_show',$output);
    }

    public function permissionEdit()
    {

        $output = $this->logic->getTemplateParamsEdit($this->input);

        return $this->view->fetch('admin_permission/permission_edit',$output);
    }

    public function permissionUpdate(){
        $this->logic->update($this->input);
    }

    public function permissionTrueDel(){
        $this->logic->trueDel($this->input);
    }
}
