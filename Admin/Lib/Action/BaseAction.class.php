<?php

class BaseAction extends Action{
    /**
     *  自动运行的方法
     */
    Public function _initialize () {

        //判断用户是否已登录

        if (!isset($_SESSION['id'])) {
            redirect(U('Login/index'));
        }
    }

	/**
	 * 默认首页带分页
	 */
    function index(){
    	$model = D(MODULE_NAME);
    	$map = array();
    	$list = array();
    	if(method_exists($this,'_map')){
    		$map = $this->_map();
    	}

    	$page = I('p',1);
    	$page_size = I('page_size',10);

    	$count = $model->_count($map);
    	if($count >0){
    		$list = $model->_list($map,$page,$page_size);
    	}
    	$this->assign('list',$list);

        $Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
    	$this->display();
    }

    function add(){
        $this->display();
    }

    /**
     * 默认新增
     */
    function insert(){
    	$model = D(MODULE_NAME);

    	if(!$model->create()){
    		$this->error($model->getError());
    	}

    	$insert_result = $model->add();

    	if($insert_result){
    		$this->success('新增成功',U(MODULE_NAME.'/index'));
    	}else{
    		$this->error('新增失败');
    	}
    }

    /**
     * 默认编辑
     */
    function edit(){
    	$model = D(MODULE_NAME);

    	$pk = $model->getPk();
    	$map[$pk] = I('get.'.$pk);

    	$info = $model->_get($map);
    	$this->assign('vo',$info);
    	$this->display();
    }

    /**
     * 默认更新数据
     */
    function update(){
    	$model = D(MODULE_NAME);

    	if(!$model->create()){
    		$this->error($model->getError());
    	}

    	$pk = $model->getPk();
    	$map[$pk] = I($pk);

    	$update_result = $model->where($map)->save();

    	if($update_result !== false){
    		$this->success('更新成功',U(MODULE_NAME.'/index'));
    	}else{
    		$this->error('更新失败');
    	}
    }

    /**
     * 默认禁用
     */
    function disabled(){
    	$model = D(MODULE_NAME);

    	$pk = $model->getPk();
    	$map[$pk] = I('get.'.$pk);

    	$data['status'] = 0;

    	$update_result = $model->where($map)->save($data);

    	if($update_result !== false){
    		$this->success('禁用成功');
    	}else{
    		$this->error('禁用失败');
    	}
    } 

    /**
     * 默认禁用
     */
    function recover(){
    	$model = D(MODULE_NAME);

    	$pk = $model->getPk();
    	$map[$pk] = I('get.'.$pk);

    	$data['status'] = 1;

    	$update_result = $model->where($map)->save($data);

    	if($update_result !== false){
    		$this->success('启用成功');
    	}else{
    		$this->error('启用失败');
    	}
    } 

    /**
     * 删除
     */
    function del(){
        $model = D(MODULE_NAME);

        $pk = $model->getPk();
        $map[$pk] = I('get.'.$pk);

        $del_result = $model->where($map)->delete();

        if($del_result){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    /**
     * 图片上传
     */
    function uploadImg(){
        import('ORG.Net.UploadFile');

        $upload = new UploadFile();// 实例化上传类
        $upload->maxSize  = 3145728 ;// 设置附件上传大小
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath =  './Uploads/';// 设置附件上传目录

        if(!$upload->upload()) {// 上传错误提示错误信息
            $info['status'] = 0;
            $info['info'] = $upload->getErrorMsg();
        }else{// 上传成功 获取上传文件信息
            $file = $upload->getUploadFileInfo();
            $info['status'] = 1;
            $info['info'] = $file[0]['savepath'].$file[0]['savename'];
        }
        die(json_encode($info));
    }
}