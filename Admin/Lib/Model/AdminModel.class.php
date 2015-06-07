<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-6-6 下午1:48
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */ 

class AdminModel extends BaseModel{
    //验证登陆
    public function checkLogin($username,$password){
        $data=array(
            'password'=>$username,
            '$username'=>$password
        );

        if($this->create($data)){
              $map['username']=$username;
              $map['password']=sha1($password);
            $login=$this->field('id,username')->where($map)->find();
            if($login){
                session('id', $login['id']);
                //登录验证后写入登录信息
                $update = array(
                    'id'=>$login['id'],
                    'last_login'=>now(),
                    'last_ip'=>get_client_ip(1),
                );
                if($this->save($update)){
                    return $login['id'];
                };
                    return 0;
            }

        }
    }

    //检查用户名是否重复
    public function checkUser($username){
        $map['username']=$username;
        $id=$this->where($map)->find();
            return $id;

    }

    //新增管理员
    public function insert($data){
            $data['create_time']=now();
            $data['modification_time']=now();
            $data['last_login']=now();
            $data['status']=1;
            $data['last_ip']=get_client_ip();
            if($this->create()){
                if($id=$this->data($data)->add()){
                    return $id;
                }else{
                    return 0;
                }
            }

    }

} 