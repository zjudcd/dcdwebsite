<?php
class TeacherModel extends Model{
	protected $_validate=array(
		array('name','require','��������Ϊ�գ�',0,'',3),
		array('id','require','���Ų���Ϊ��',1,'',3),
		array('gender','require','�Ա���Ϊ��',2,'',3),
	);
}
?>