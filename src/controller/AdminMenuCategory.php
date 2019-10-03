<?php
namespace joeStudio\admin\controller;

class AdminMenuCategory extends Admin
{

    public function __construct()
    {
        parent::__construct();

    }

    public function add()
    {
       return $this->view->fetch('admin_menu_category/add');
    }

    public function insert(){
        $this->logic->insert($this->input);
    }

    public function show(){

        $output = $this->logic->search($this->input);

        return $this->view->fetch('admin_menu_category/show',$output);
    }

    public function edit()
    {

        $output = $this->logic->getCategoryById($this->input['category_id']);

        return $this->view->fetch('admin_menu_category/edit',$output);
    }

    public function update(){
        $this->logic->update($this->input);
    }
}
