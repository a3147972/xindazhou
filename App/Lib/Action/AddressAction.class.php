<?php 
class AddressAction extends BaseAction{
	function index(){
		$city_id = I('city_id','');

		if(empty($city_id)){
			$map['pid'] = 0;
		}else{
			$map['pid'] = $city_id;
		}
		$model = D('City');
		$list = $model->where($map)->select();
		$this->assign('list',$list);

		$this->display();
	}

	function lists(){
		$model = D('Address');

		$city_id = I('city_id');

		$map['city_id'] = $city_id;

		$list = $model->where($map)->select();
		$this->assign('list',$list);
		$this->display();
	}
}