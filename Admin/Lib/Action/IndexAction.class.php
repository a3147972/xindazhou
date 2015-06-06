<?php
class IndexAction extends BaseAction {

    public function index(){

        $this->display();
    }

    //退出登陆
    public function logout(){
        session('id',null);
        $this->redirect('admin.php/Login/index');

    }
}