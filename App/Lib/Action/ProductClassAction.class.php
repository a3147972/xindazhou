<?php 
class ProductClassAction extends BaseAction{
	function index(){
		$id = I('get.id','');
		if(empty($id)){
			$info['name'] = '新大洲本田车型';
			$list = D('ProductClass')->select();
		}else{
			//获取车型信息
			$map['id'] = $id;
			$info = D('ProductClass')->where($map)->find();

			$model = D('Product');
			$product_map['class_id'] = $id;
			$list = $model->where($product_map)->order('id desc')->select();
			$this->assign('product_list',1);
		}
		
		$this->assign('info',$info);
		$this->assign('list',$list);
		$this->display();
	}
}