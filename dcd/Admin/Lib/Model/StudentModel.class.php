<?php
class StudentModel extends Model{
	protected $_validate=array(
		array('name','require','姓名不能为空！',0,'',3),
		array('id','require','学号不能为空',1,'',3),
	);
}
?>