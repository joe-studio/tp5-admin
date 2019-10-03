<?php


namespace joeStudio\admin\model;


use joeStudio\admin\helper\LoginHelper;
use joeStudio\admin\logic\Login;
use think\Model;
use traits\model\SoftDelete;

class AdminAdmin extends Model
{
    use SoftDelete;

    protected $field = true;

    protected $pk = 'admin_id';
    protected $delete_time = "delete_time";

    public function insertData($data){

        return $this->save([
            'user_name'         =>  $data['user_name'],
            'password'          =>  (new Login())->encryption($data['password']),
            'mobile'            =>  $data['mobile'],
            'login_ip'          =>  LoginHelper::get_client_ip(0,true),
            'last_login_time'   =>  time(),
            'create_time'       =>  time(),
            'update_time'       =>  time(),
        ]);
    }

}