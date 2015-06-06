<?php

class BaseAction extends Action{
    /**
     *  自动运行的方法
     */
    Public function _initialize () {

        //判断用户是否已登录

        if (!isset($_SESSION['id'])) {

            $this->redirect('admin.php/Login/index');
        }
    }

}