<?php
/**
 * Created by dh2y.
 * Blog: http://blog.csdn.net/sinat_22878395
 * Date: 2018/4/26 0026 16:26
 * For: 登录模块
 */

namespace joeStudio\admin\logic;

use filter\Output;
use joeStudio\admin\model\AdminAdminRole;

class AdminAdmin extends Output
{

    public function __construct(){

    }

    public function insert($data){

        $res = $this->validate->scene('insert')->batch()->check($data);

        if($res == false){

            $this
                ->scene('form')
                ->setStatus(false)
                ->setMsg($this->validate->getError())
                ->output();
        }

        $res = $this->model->save($data);

        $res ?
            $this->scene('form')->setStatus(true)->setMsg('新增成功')->output()
            :
            $this->scene('form')->setStatus(false)->setMsg('插入数据失败')->output();
    }

    public function search($data){
        //筛选条件
        $map = [];
        $rows = isset($data['rows']) ? $data['rows'] : 10;

        isset($data['category_name']) && $map['category_name'] = ['like', "%{$data['category_name']}%"];
        isset($data['status']) && $data['status'] ? $map['status']  = 0 : $map['status']  = 1;

        //从数据库查询数据
        $adminList = $this->model->where($map)->paginate($rows,false,['query'=>$data]);

        //模板分页效果
        $page = $adminList->render();

        $output = [
            'adminList' =>  $adminList,
            'page'      =>  $page
        ];

        return $output;
    }

    public function update($data){

        $res = $this->validate->scene('update')->batch()->check($data);

        if($res == false){

            $this
                ->scene('form')
                ->setStatus(false)
                ->setMsg($this->validate->getError())
                ->output();
        }

        $res = $this->model->save($data,['admin_id'=>$data['admin_id']]);

        $res ?
            $this->scene('form')->setStatus(true)->setMsg('编辑成功')->output()
            :
            $this->scene('form')->setStatus(false)->setMsg('更新数据失败')->output();
    }

    public function getAdminById($admin_id){
        $admin = $this->model->where(['admin_id'=>$admin_id])->find();

        $output = [
            'admin'  =>  $admin
        ];

        return $output;
    }

    public function trueDel($data)
    {

        $res = $this->model->destroy($data['id'],TRUE);

        $res ?
            $this->scene('form')->setStatus(true)->setMsg('删除成功')->output()
            :
            $this->scene('form')->setStatus(false)->setMsg('删除失败')->output();
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

            //登录日志更新
            $update['last_login_time'] = time();
            $update['login_ip'] = LoginHelper::get_client_ip(0,true);

            $res = $this->model->save($update,['admin_id'=>$admin['admin_id']]);

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

            $res = $this->model->insertData($data);

            $this->scene('form');

            $res ? $this->setStatus(true)->setMsg('注册成功') : $this->setStatus(false)->setMsg('插入数据失败');

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

    public function bindAdminRole($data){
        $insertData = [];

        $adminRoleList_original = db('adminAdminRole')->where([
            'admin_id'   =>  $data['admin_id']
        ])->column('role_id');

        $role_ids = isset($data['role_ids']) ? $data['role_ids'] : [];

        if($role_ids){
            foreach($role_ids as $key => $value){
                $role_ids[$key] = (int)$value;
            }
        }

        $role_ids_public = array_intersect($role_ids,$adminRoleList_original);

        $role_ids_insert = array_diff($role_ids,$role_ids_public);

        $role_ids_delete = array_diff($adminRoleList_original,$role_ids_public);

        $res = false;

        if($role_ids_insert){

            foreach($role_ids_insert as $key => $value){
                $insertData[$key]['admin_id'] = $data['admin_id'];
                $insertData[$key]['role_id'] = $value;
            }

            $res = (new AdminAdminRole())->saveAll($insertData);
        }

        if($role_ids_delete){
            foreach($role_ids_delete as $role_id){
                $res = db('adminAdminRole')->where([
                    'admin_id'       =>  $data['admin_id'],
                    'role_id'    =>  $role_id
                ])->delete();
            }
        }

        $res ?
            $this->scene('form')->setStatus(true)->setMsg('更新成功')->output()
            :
            $this->scene('form')->setStatus(false)->setMsg('更新失败')->setData($insertData)->output();
    }

    public function getTemplateParamsRole($data){
        $adminRoleList = db('adminRole')->where([
            'role_status' =>  1
        ])->select();

        if($adminRoleList){
            foreach($adminRoleList as $k => $v){
                $is_bind = db('adminAdminRole')->where([
                    'admin_id'   =>  $data['admin_id'],
                    'role_id' =>  $v['role_id']
                ])->count();

                if($is_bind > 0){
                    $adminRoleList[$k]['is_bind'] = 1;
                }else{
                    $adminRoleList[$k]['is_bind'] = 0;
                }
            }
        }

        $output = [
            'adminRoleList'   =>  $adminRoleList
        ];

        return $output;
    }
}