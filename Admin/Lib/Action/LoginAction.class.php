<?php

class LoginAction extends Action {

    //登陆页显示
    public function index(){

        $this->display();
    }

    /**
     * 判断登陆
     */
    public function checkLogin(){
         if(!IS_POST) $this->error('非法操作');
         $login=D('Admin');
         $result=$login->checkLogin(I('username','','htmlspecialchars'),I('password','','htmlspecialchars'));
         echo $result;
    }
    //退出登陆
    public function logout(){
        session('id',null);
        $this->redirect('admin.php/Login/index');

    }
}