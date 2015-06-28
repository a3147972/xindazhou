<?php 
class DocumentAction extends BaseAction{
	function index(){
		$id = I('get.id');

		$model = D('Document');

		$map['id'] = $id;

		$info = $model->where($map)->find();

		$this->assign('vo',$info);

		$this->display();
	}
}