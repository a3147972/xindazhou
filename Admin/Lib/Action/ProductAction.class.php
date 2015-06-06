<?php 
class ProductAction extends BaseAction{
	function index(){
		$model = D('Product');
		$map['class_id'] = I('get.id');

		$page = I('p',1);
    	$page_size = I('page_size',10);

		$count = $model->_count($map);
		$list = $model->_list($map);

		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
        $show       = $Page->show();// 分页显示输出
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
	}
}