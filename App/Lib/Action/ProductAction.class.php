<?php 
class ProductAction extends BaseAction{
	function info(){
		$id = I('id');

		$map['id'] = $id;

		$info = D('Product')->where($map)->find();

		$this->assign('vo',$info);
		$this->display();
	}
}