<?php
class PeopleAction extends BaseAction{
	public function index()
	{
		$this->assign("menu","People");
		$this->assign("category","teacher");
		$this->display("Public:people");
	}
	public function choose()
	{
		$cate = $_GET["category"];
		$p = M($cate)->select();
		$this->assign("people",$p);
		$this->assign("category",$cate);
		$this->display("Public:people");
	}
}
?>