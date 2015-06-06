<?php 
class DocumentModel extends BaseModel{
	protected $_validate = array(
		array('title','require','标题不可为空',1),
		array('content','require','内容不可为空',1),
	);	

	protected $_auto = array(
		array('create_time','now',1,'function'),
		array('modification_time','now',3,'function'),
	);
}