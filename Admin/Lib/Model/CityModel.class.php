<?php 
class CityModel extends BaseModel{
	protected $_validate = array(
		array('name','require','请输入城市名称',1),
	);
	protected $_auto = array(
		array('create_time','now',1,'function'),
		array('modification_time','now',3,'function'),
	);
}