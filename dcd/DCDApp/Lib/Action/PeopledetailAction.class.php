<?php
class PeopledetailAction extends BaseAction{
	public function index()
	{
		$cate = $_GET["category"];
		$conf["id"] = $_GET["id"];
		$p = M($cate)->where($conf)->select();
		$this->assign("p",$p[0]);
		$this->display("Public:peopledetail");
	}
	public function choose()		//选择成员分类
	{
		$cate = $_GET["category"];
		$p = M($cate)->select();
		$this->assign("people",$p);
		$this->assign("category",$cate);
		$this->display("Public:people");
	}
}
?>