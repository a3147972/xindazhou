<?php

class LoginAction extends Action
{

    //登陆页显示
    public function index()
    {
        $this->display();
    }

    /**
     * 判断登陆
     */
    public function checkLogin()
    {
        if (!IS_POST) {
            $this->error('非法操作');
        }
        
        $model=D('Admin');
        $username = I('username');
        $password = I('password');
        if (empty($username)) {
            $this->error('请输入用户名');
        }
        if (empty($password)) {
            $this->error('请输入密码');
        }
        
        $result=$model->checkLogin($username, $password);
        if ($result) {
            $this->success('登录成功', U('Index/index'));
        } else {
            $this->error('账号或密码错误');
        }
    }
    //退出登陆
    public function logout()
    {
        session(null);
        redirect(U('Login/index'));
    }
}
