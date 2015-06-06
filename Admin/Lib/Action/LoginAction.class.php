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

         $login=D('Admin');
         $rersult=$login->checkLogin(I('username','','htmlspecialchars'),I('password','','htmlspecialchars'));
         print_r($rersult) ;
    }
}