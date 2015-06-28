<?php 
class ActivityModel extends BaseModel{
	protected $tableName = 'activity';
	protected $_validate = array(
		array('name','require','请输入活动名称',1),
		array('content','require','请输入活动描述',1),
		array('answer','require','请输入正确答案',1),
	);
	protected $_auto = array(
		array('create_time','now',1,'function'),
		array('modification_time','now',3,'function'),
	);
}