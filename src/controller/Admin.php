<?php
namespace joeStudio\admin\controller;

use filter\Output;
use joeStudio\admin\helper\CreateTable;
use joeStudio\admin\helper\LoginHelper;
use joeStudio\admin\logic\Login as loginObject;
use think\Controller;
use think\Hook;
use think\Request;
use think\View;

class Admin extends Controller
{

    protected $view;    //视图
    protected $input;
    protected $logic;

    public function __construct()
    {

        Hook::listen('check_login');
        Hook::listen('check_permission');
        Hook::listen('init_input',$this->input);
        Hook::listen('init_view',$this->view);
//        Hook::listen('init_output',$this->output);
        Hook::listen('init_logic',$this->logic);
//        Hook::listen('init_model',$this->model);
//        Hook::listen('init_validate',$this->validate);

    }

}
