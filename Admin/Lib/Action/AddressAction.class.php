<?php 
class AddressAction extends BaseAction{
	function index(){
		$model = D('Address');
		$map['city_id'] = I('get.city_id');

		$page = I('p',1);
		$page_size = I('page_size',10);

		$count = $model->_count($map);
		$list = $model->_list($map);

		$Page       = new Page($count,$page_size);// 实例化分页类 传入总记录数和每页显示的记录数
		$show       = $Page->show();// 分页显示输出
		$this->assign('page',$show);// 赋值分页输出
		$this->assign('list',$list);
		$this->display();
	}

	function insert(){
		$model = D(MODULE_NAME);

		if(!$model->create()){
			$this->error($model->getError());
		}
		$city_id = I('city_id');
		$insert_result = $model->add();

		if($insert_result){
			$this->success('新增成功',U(MODULE_NAME.'/index',array('city_id'=>$city_id)));
		}else{
			$this->error('新增失败');
		}
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
		$city_id = I('city_id');
		$update_result = $model->where($map)->save();

		if($update_result !== false){
			$this->success('更新成功',U(MODULE_NAME.'/index',array('city_id'=>$city_id)));
		}else{
			$this->error('更新失败');
		}
	}
}