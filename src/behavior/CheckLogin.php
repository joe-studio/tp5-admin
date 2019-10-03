<?php
namespace joeStudio\admin\behavior;

use think\Controller;
use joeStudio\admin\logic\Login;
use think\Request;

class CheckLogin extends Controller
{
    public function run(&$params)
    {



        $dispatch = Request::instance()->dispatch();

        if($dispatch['method'][0] == "\joeStudio\admin\controller\Login"){

            if($dispatch['method'][1] == 'index' || $dispatch['method'][1] == 'register'){
                ( new Login() )->checkLogin() && $this->success('已登录',url('admin/index/index'));
            }

        }else{
            !( new Login() )->checkLogin() && $this->error('请登录',url('admin/login/index'));
        }

    }
}