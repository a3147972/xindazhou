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

	/**
	 * 生成菜单
	 */
	function create(){
		$options = array(
			'token'=>C('WEIXIN_OPTIONS.TOKEN'), //填写你设定的key
 			'encodingaeskey'=>C('WEIXIN_OPTIONS.ENCODINGAESKEY'), //填写加密用的EncodingAESKey
 			'appid'=>C('WEIXIN_OPTIONS.APPID'), //填写高级调用功能的app id
 			'appsecret'=>C('WEIXIN_OPTIONS.APPSECRET') //填写高级调用功能的密钥
		);

		$wechat = new wechat($options);
		$model = D('Menu');
		$list = $model->select();
		
		$_list = array();
		foreach($list as $_k=>$_v){
			if($_v['pid'] == 0){
				$_list[$_v['id']]['name'] = $_v['name'];
			}else{
				$_list[$_v['pid']]['sub_button'][$_v['id']] = array('name'=>$_v['name'],'type'=>'view','url'=>$_v['url']);
			}
		}
		$keys = range(0,2);
		$_list = array_combine($keys,$_list);
		foreach($_list as $_k=>$_v){
			$keys = range(0,count($_v['sub_button'])-1);
			$_list[$_k]['sub_button'] = array_combine($keys, $_v['sub_button']);
		}
		unset($list);
		$list['button'] = $_list;

		$create_result = $wechat->createMenu($list);
		if($create_result){
			$this->success('创建自定义菜单成功,请等待24小时');
		}else{
			print_r($wechat->errCode);exit();
			$this->error('创建失败');
		}
	}	
}