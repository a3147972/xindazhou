<?php 
class KeywordModel extends BaseModel{
	protected $_validate = array(
		array('keywords','require','请输入关键词',1),
		array('title','require','请输入标题',1),
		array('descption','require','请输入描述',1),
		array('thumb','require','请上传图片',1),
		array('link','require','请输入跳转链接',1),
		array('keywords','','关键词已存在',1,'unique'),
	);

	protected $_auto = array(
		array('create_time','now',1,'function'),
		array('modification_time','now',3,'function'),
	);
}