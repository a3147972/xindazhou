<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-6-6 下午1:48
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */ 

class AdminModel extends Model{

    //用户表自动验证
    protected $_validate = array(
        //-1,'帐号长度不合法！'
        array('username', '/^[^@]{2,20}$/i', '帐号长度不合法', self::EXISTS_VALIDATE),
        //-2,'密码长度不合法！'
        array('password', '6,30', '密码长度不合法', self::EXISTS_VALIDATE,'length'),

    );
    //用户表自动完成
    protected $_auto = array(
        array('password', 'sha1', self::MODEL_BOTH, 'function'),
        array('create', 'd', self::MODEL_INSERT, 'function'),
    );

    //验证登陆
    public function checkLogin(){

    }

} 