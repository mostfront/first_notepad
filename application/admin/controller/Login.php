<?php
namespace app\admin\controller;

use think\Session;

class Login extends \think\Controller
{
    public function index(){

//        var_dump( password_hash('admin', PASSWORD_DEFAULT));计算密码加密的哈希值把它写入数据中。
        return view();
    }

    //退出登陆页
    public function logout(){
        \think\facade\Session::delete('admin_id');
        return $this->redirect('admin/login/index');
    }

    public function check(){
        $r['username'] = $this->request->post('username');
        $r['password'] = $this->request->post('password');
        $r['__token__'] = $this->request->post('__token__');
// var_dump($r);
        //数据验证
        $validate = new \app\common\validate\AdminLogin();
        if( !$validate->check($r) ){
            return $this->error($validate->getError());
        }

        $adminuser = new \app\common\model\AdminUser;

        $user = $adminuser->where('username', $r['username'])->find();
        if(!$user){
            return $this->error('用户名不存在');
        }

        if( password_verify($r['password'], $user->password) !==true ){
            return $this->error('密码不正确');
        }

        \think\facade\Session::set('admin_id', $user->id);

        return $this->redirect('admin/index/index');
    }
}
