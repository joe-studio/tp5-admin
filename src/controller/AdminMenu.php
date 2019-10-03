<?php
namespace joeStudio\admin\controller;

class AdminMenu extends Admin
{

    public function __construct()
    {
        parent::__construct();

    }

    public function add()
    {
        $params = $this->logic->getTemplateParamsAdd();

        return $this->view->fetch('admin_menu/add',$params);
    }

    public function insert(){
        $this->logic->insert($this->input);
    }

    public function show(){

        $output = $this->logic->search($this->input);

        return $this->view->fetch('admin_menu/show',$output);
    }

    public function edit()
    {

        $output = $this->logic->getTemplateParamsEdit($this->input);

        return $this->view->fetch('admin_menu/edit',$output);
    }

    public function update(){
        $this->logic->update($this->input);
    }
}
