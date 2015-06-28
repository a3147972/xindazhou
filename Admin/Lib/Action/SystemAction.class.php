<?php 
/**
 * 系统设置
 *
 * @package default
 * @author 
 **/
class SystemAction extends BaseAction{
	
	const SITE_CONF_PATH = './Conf/site.php';		//站点配置文件路径

	function index(){
		$this->display();
	}

	function insert(){
		$config = I('post.');
		$str = "<?php \n";
		$str .= "return ";
		$str .= var_export($config,true);
		$str .= ';';

		$result = file_put_contents(self::SITE_CONF_PATH, $str);
		if($result){
			$this->success('保存成功');
		}else{
			$this->error('保存失败');
		}
	}
} 