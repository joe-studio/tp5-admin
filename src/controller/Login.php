<?php
namespace joeStudio\admin\controller;

class Login extends Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
       return $this->view->fetch('login/index');
    }

    public function doLogin(){

        $this->logic->doLogin($this->input);

    }

    public function register(){
        return $this->view->fetch('login/register');
    }

    public function doRegister(){

        $this->logic->register($this->input);
    }

    public function logout(){

        $this->logic->logout();

    }

}
