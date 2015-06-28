<?php 
class CityAction extends BaseAction{
	function index(){
		$model = D('City');

		$list = $model->select();

		$list = $this->tree($list,0);
		$this->assign('list',$list);
		$this->display();
	}

	function tree($list,$pid=0){
		static $_tree = array();
		foreach($list as $_k=>$_v){
			if($_v['pid'] == $pid){
				$_tree[$_k] = $_v;
				if($pid !== 0 ){
					$_tree[$_k]['name'] = '|-'.$_v['name'];
				}
				$this->tree($list,$_v['id']);
			}
		}
		return $_tree;
	}
}