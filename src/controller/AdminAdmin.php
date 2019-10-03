<?php
namespace joeStudio\admin\controller;

class AdminAdmin extends Admin
{

    public function __construct()
    {
        parent::__construct();

    }

    public function add()
    {
       return $this->view->fetch('admin_admin/add');
    }


}
