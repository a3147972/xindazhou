<?php 
class ProductClassModel extends BaseModel{
	protected $_validate = array(
		array('name','require','车型名称不可为空',1),
	);	

	protected $_auto = array(
		array('create_time','now',1,'function'),
		array('modification_time','now',3,'function'),
	);
}