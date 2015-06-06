<?php

class BaseAction extends Action{
    /**
     *  自动运行的方法
     */
    Public function _initialize () {

        //判断用户是否已登录

        // if (!isset($_SESSION['id'])) {

        //     $this->redirect('admin.php/Login/index');
        // }
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

    	$page = I('page');
    	$page_size = I('page_size');

    	$count = $model->_count($map);
    	if($count >0){
    		$list = $model->_list($map,$page,$page_size);
    	}
    	$this->assign('list',$list);
    	$this->assign('count',$count);

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
    	if($inser_result){
    		$this->success('新增成功');
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
    	$model = D(MODUEL_NAME);

    	if(!$model->create()){
    		$this->error($model->_getError());
    	}

    	$pk = $model->getPk();
    	$map[$pk] = I('get.'.$pk);

    	$update_result = $model->where($map)->save();

    	if($update_result !== false){
    		$this->success('更新成功');
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
}