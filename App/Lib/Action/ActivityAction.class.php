<?php 
class ActivityAction extends BaseAction{
	function index(){
		$model = D('Activity');
		$map['is_lottery'] = 0;
		$info = $model->order('id desc')->find();
		$this->assign('vo',$info);

		//获取选项
		$options_map['activity_id'] = $info['id'];
		$options_list = D('ActivityOptions')->where($options_map)->order('id desc')->limit(9)->select();
		$this->assign('options_list',$options_list);

		//获取奖项
		$psize_list = D('ActivityPsize')->where($options_map)->select();
		$this->assign('psize_list',$psize_list);
		$this->display();
	}
}