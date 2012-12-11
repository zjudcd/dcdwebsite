<?php
class PeopleAction extends BaseAction{
	public function index()
	{
		if(isset($_GET["category"]))
			$cate = $_GET["category"];
		else
			$cate = "teacher";
		$Member = M("person");
		import("ORG.Util.Page");
		if($_POST['keyword']){
			$kmap = $_POST['keyword'];
			$map['name'] = array('like','%'.$kmap.'%');
		}elseif($_GET['keyword']){
			$kmap = $_GET['keyword'];
			$map['name'] = array('like','%'.$kmap.'%');
		}
		if($cate == "teacher")
		{
			$map['category'] = "教师";
			$map['status'] = "在校";
		}	
		else if($cate == "student")
		{
			$map['category'] = "学生";
			$map['status'] = "在校";
		}
		else
		{
			$map['category'] = "学生";
			$map['status'] = "离校";
		}
		$count = $Member->where($map)->count();
		$Page = new Page($count,12);
		$Page -> parameter .= "keyword=".urlencode($kmap)."&";
		$show = $Page->show();
		$pp = $Member->where($map)->order('personid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		if($cate == "grastudent")
			$type = "student";
		else
			$type = $cate;
		$p = Array();
		foreach($pp as $k => $v)
		{
			$cond["id"] = $v["personid"];
			$result = M($type)->where($cond)->select();
			array_push($p,$result[0]);
		}
		$this->assign("pages",$show);
		$this->assign("category",$type);
		$this->assign("people",$p);
		$this->assign("menu","People");
		$this->display("Public:people");
	}
}
?>