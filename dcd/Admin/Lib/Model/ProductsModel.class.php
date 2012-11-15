<?php
class ProductsModel extends Model{
	protected $_validate=array(
		array('title','require','产品名称必填！',0,'',3),
		array('content','require','产品介绍必填！',1,'',3),
	);
	protected $_auto = array(
		array('createtime','time',1,'function'),
	);
}
?>