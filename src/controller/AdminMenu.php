<?php
namespace joeStudio\admin\controller;

class AdminMenu extends Admin
{

    public function __construct()
    {
        parent::__construct();

    }

    public function menuAdd()
    {
        $params = $this->logic->getTemplateParamsAdd();

        return $this->view->fetch('admin_menu/menu_add',$params);
    }

    public function menuInsert(){
        $this->logic->insert($this->input);
    }

    public function menuShow(){

        $output = $this->logic->search($this->input);

        return $this->view->fetch('admin_menu/menu_show',$output);
    }

    public function menuEdit()
    {

        $output = $this->logic->getTemplateParamsEdit($this->input);

        return $this->view->fetch('admin_menu/menu_edit',$output);
    }

    public function menuUpdate(){
        $this->logic->update($this->input);
    }

    public function menuTrueDel(){
        $this->logic->trueDel($this->input);
    }
}
