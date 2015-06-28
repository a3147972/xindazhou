<?php 
class AddressModel extends BaseModel{
	protected $_validate = array(
		array('company_name','require','请输入公司名称',1),
		array('address','require','请输入公司地址',1),
		array('phone','require','请输入公司电话',1)
	);
	protected $_auto = array(
		array('create_time','now',1,'function'),
		array('modification_time','now',3,'function'),
	);
}