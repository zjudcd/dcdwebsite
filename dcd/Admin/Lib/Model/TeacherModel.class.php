<?php
class TeacherModel extends Model{
	protected $_validate=array(
		array('name','require','姓名不能为空！',0,'',3),
		array('id','require','工号不能为空',1,'',3),
		array('gender','require','性别不能为空',2,'',3),
	);
}
?>