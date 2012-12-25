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
			$orderkey = "rank";
			$table = "teacher";
			$map['status'] = "在校";
		}	
		else if($cate == "phd")
		{
			$orderkey = "entrancedate";
			$table = "student";
			$map['status'] = "在校";
			$map['category'] = "博";
		}
		else if($cate == "master")
		{
			$orderkey = "entrancedate";
			$table = "student";
			$map['status'] = "在校";
			$map['category'] = "硕";
		}
		else
		{
			$orderkey = "entrancedate";
			$table = "Student";
			$map['status'] = "离校";
			$map['isshow'] = 1;
		}
		$Member = M($table);
		$count = $Member->where($map)->count();
		$Page = new Page($count,16);
		$Page -> parameter .= "keyword=".urlencode($kmap)."&";
		$show = $Page->show();
		$p = $Member->where($map)->order($orderkey)->limit($Page->firstRow.','.$Page->listRows)->select();
		if($cate == "phd" || $cate == "master" || $cate == "grastudent")		//如果是硕士或博士
		{
			$res = Array();
			$year = $p[0]['entrancedate'];
			$year = substr($year,0,4);
			$cur = Array();
			foreach($p as $k => $v)
			{
				$y = substr($v['entrancedate'],0,4);
				if($y == $year)
				{
					$cur[] = $v;
				}
				else
				{
					$res[$year] = $cur;
					$cur = Array();
					$year = $y;
				}
			}
			if(count($cur) != 0)
				$res[$year] = $cur;
		}
		$this->assign("students",$res);
		$this->assign("pages",$show);
		$this->assign("category",$table);
		$this->assign("cate",$cate);
		$this->assign("people",$p);
		$this->assign("menu","People");
		$this->display("Public:people");
	}
}
?>