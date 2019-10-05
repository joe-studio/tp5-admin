<?php
/**
 * Created by dh2y.
 * Blog: http://blog.csdn.net/sinat_22878395
 * Date: 2018/4/26 0026 16:26
 * For: 登录模块
 */

namespace joeStudio\admin\logic;

use filter\Output;
use think\Session;
use joeStudio\admin\helper\LoginHelper;

class Login extends Output
{
    protected $config = [
        'crypt' => 'wstudio',      //Crypt加密秘钥
        'auth_uid' => 'authId',      //用户认证识别号(必配)
    ];

    public function __construct(){

        $this->model = new \joeStudio\admin\model\AdminAdmin();
        $this->validate = new \joeStudio\admin\validate\AdminAdmin();
    }

    public function doLogin($data){

        $result = $this->validate->scene('login')->batch()->check($data);

        if ($result==false){

            $this
                ->scene('form')
                ->setStatus($result)
                ->setMsg($this->validate->getError())
                ->setUrl(url('admin/index/index'))
                ->output();
        }


        $admin = $this->model->where([
            'user_name' =>  $data['user_name']
        ])->find();

        if($admin['password'] == $this->encryption($data['password'])){

            //账号密码验证正确，缓存登录信息
            session($this->config['auth_uid'], $admin['admin_id']);
            session("user_name", $admin['user_name']);
            session("admin_level", $admin['admin_level']);

            $res = $this->model->save([],['admin_id'=>$admin['admin_id']]);

            $this->scene('form');

            $res ?
                $this->setStatus(true)->setMsg('登录成功')->setUrl(url('admin/index/index'))
                :
                $this->setStatus(false)->setMsg('登录失败');

            $this->output();

        }else{

            $this
                ->scene('form')
                ->setStatus(false)
                ->setMsg(['password'=>'密码错误'])
                ->output();
        }

    }

    /**
     * 退出登录
     */
    public function logout(){
        session($this->config['auth_uid'], null);
        session("user_name", null);
        session(null);

        $this->scene('jump')->setStatus(true)->setMsg('退出成功')->setUrl(url('admin/login/index'))->output();
    }

    public function register($data){

        $result = $this->validate->scene('register')->batch()->check($data);

        if($result == false){

            $this
                ->scene('form')
                ->setStatus(false)
                ->setMsg($this->validate->getError())
                ->output();
        }

        if($result == true){

            $res = $this->model->save($data);

            $this->scene('form');

            $res ? $this->setStatus(true)->setMsg('注册成功') : $this->setStatus(false)->setMsg('插入数据失败');
            $this->output();
        }
    }

    /**
     * @param $password
     * @return string
     */
    public function encryption($password){
        return md5($password);
    }

    /**
     * @return bool
     */
    public function checkLogin(){

        return Session::get($this->config['auth_uid'])?true:false;

    }
}