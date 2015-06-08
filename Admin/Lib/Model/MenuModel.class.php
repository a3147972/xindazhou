<?php 
class MenuModel extends BaseModel{
	protected $_validate = array(
		array('name','require','请输入自定义菜单名称',1),
		array('url','validate_url','请输入跳转链接',1,'callback')
	);
	protected $_auto = array(
		array('create_time','now',1,'function'),
		array('modification_time','now',3,'function'),
	);

	protected function validate_url($v){
		$pid = I('pid');
		if($pid != 0 && empty($v)){
			return false;
		}
		return true;
	}
}