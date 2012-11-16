<?php
class NewsModel extends Model{
	protected $_validate=array(
		array('title','require','通知标题不能为空！',0,'',3),
		array('content','require','通知内容不能为空！',1,'',3),
	);
	protected $_auto = array(
		array('date','time',1,'function'),
	);
}
?>
