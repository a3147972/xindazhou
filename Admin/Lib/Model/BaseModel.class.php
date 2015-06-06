<?php 
class BaseModel extends Model{
	/**
	 * 查询数据列表 add by guolei
	 * @param map array 查询条件
	 * @param page int 分页，默认1
	 * @param page_size int 分页条数 默认10
	 * @param order string 排序规则,默认倒序
	 * @param field string|array 查询字段
	 * @return array
	 */
	function _list($map=array(),$page=1,$page_size = 10,$order='',$field=''){
		$pk = $this->getPk();
		$order = empty($order)?$pk.' desc':$order;

		if($page == 0){
			$list = $this->where($map)->order($order)->field($field)->select();
		}else{
			$page_index = ($page-1)*$page_size;
			$list = $this->where($map)->order($order)->field($field)->limit($page_index.','.$page_size)->select();
		}
		if(is_null($list))
			return array();
		return $list;
	}

	/**
	 * 查询单条数据 add by guolei
	 * @param array map 查询条件
	 * @param field string|array 查询字段
	 * @param order string 排序规则
	 * @return array()
	 */
	function _get($map=array(),$field='',$order=''){
		$info = $this->where($map)->field($field)->order($order)->find();

		if(is_null($info))
			return array();
		return $info;
	}

	/**
	 * 计算总数
	 */
	function _count($map=array()){
		$count = $this->where($map)->count();
		if(is_null($count))
			return 0;
		return $count;
	}
}