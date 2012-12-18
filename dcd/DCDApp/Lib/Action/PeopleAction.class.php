<?php
class PeopleAction extends BaseAction{
	public function index()
	{
		if(isset($_GET["category"]))
			$cate = $_GET["category"];
		else
			$cate = "teacher";
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
			$table = "teacher";
			$map['status'] = "在校";
		}	
		else if($cate == "student")
		{
			$table = "student";
			$map['status'] = "在校";
		}
		else
		{
			$table = "Student";
			$map['status'] = "离校";
		}
		$Member = M($table);
		$count = $Member->where($map)->count();
		$Page = new Page($count,12);
		$Page -> parameter .= "keyword=".urlencode($kmap)."&";
		$show = $Page->show();
		$p = $Member->where($map)->order('rank')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign("pages",$show);
		$this->assign("category",$table);
		$this->assign("cate",$cate);
		$this->assign("people",$p);
		$this->assign("menu","People");
		$this->display("Public:people");
	}
}
?>