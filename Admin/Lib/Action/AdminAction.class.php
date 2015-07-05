<?php

class AdminAction extends BaseAction
{
    //新增管理员表单处理
    public function insert()
    {
        $add=D('Admin');
        $data=array(
            'username'=>I('username', '', 'htmlspecialchars'),
            'password'=>I('password', '', 'sha1')
        );

        if ($add->checkUser($data['username'])) {
            $this->error('用户名已暂用');
        }
        $result=$add->insert($data);
        if ($result) {
            $this->success('添加成功', U('Admin/index'));
        } else {
            $this->error('添加失败');
        }
    }

    public function update()
    {
        $model = D('Admin');
        if (!$model->create()) {
            $this->error($model->getError());
        }
        $username = I('username');
        $password= I('password');

        if ($model->checkUser($username)) {
            $this->error('用户名已暂用');
        }
        
        $map['id'] = I('id');
        $info = $model->_get($map);

        if (empty($password)) {
            $model->password = $info['password'];
        } else {
            $model->password = sha1($password);
        }

        $update_result = $model->where($map)->save();

        if ($update_result) {
            $this->success('修改成功');
        } else {
            $this->error('修改失败');
        }
    }
}
