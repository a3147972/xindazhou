<?php 

class AdminAction extends BaseAction{



    //新增管理员页显示
    public function add(){
        $this->display();
    }

    //新增管理员表单处理
    public function insert(){

        $add=D('Admin');
        $data=array(
            'username'=>I('username','','htmlspecialchars'),
            'password'=>I('password','','sha1')
        );

        if($add->checkUser($data['username'])) $this->error('用户名已暂用');
        $result=$add->insert($data);
        if($result){
            $this->success('添加成功',U('Admin/index'));
        } else{
            $this->error('添加失败');
        }
    }
	
}