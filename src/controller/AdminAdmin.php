<?php
namespace joeStudio\admin\controller;

class AdminAdmin extends Admin
{

    public function __construct()
    {
        parent::__construct();

    }

    public function adminAdd()
    {
       return $this->view->fetch('admin_admin/admin_add');
    }

    public function adminInsert(){
        $this->logic->insert($this->input);
    }

    public function adminShow(){

        $output = $this->logic->search($this->input);

        return $this->view->fetch('admin_admin/admin_show',$output);
    }

    public function adminEdit()
    {

        $output = $this->logic->getAdminById($this->input['admin_id']);

        return $this->view->fetch('admin_admin/admin_edit',$output);
    }

    public function adminUpdate(){
        $this->logic->update($this->input);
    }

    public function adminTrueDel(){
        $this->logic->trueDel($this->input);
    }

    public function bindRole(){

        $output = $this->logic->getTemplateParamsRole($this->input);

        return $this->view->fetch('admin_admin/bind_role',$output);
    }

    public function adminRoleInsert(){
        $this->logic->bindAdminRole($this->input);
    }
}
