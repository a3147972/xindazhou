<?php 
class MenuAction extends BaseAction{
	function add(){
		$pid = I('pid',0);

		$map['pid'] = $pid;
		$model=D('Menu');
		$count = $model->where($map)->count();
		if($pid == 0 && $count >=3)
			$this->error('一级菜单只能添加三个');
		if($pid !== 0 && $count >=5){
			$this->error('二级菜单只能添加五个');
		}
		$this->display();
	}
	function index(){
		$model = D('Menu');

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