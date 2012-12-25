<?php
/*
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
		$Page = new Page($count,100);
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
*/

class PeopleAction extends BaseAction{
	public function index()
	{
		//确定硕士博士一共是哪些年级
		$phdgra = Array();
		$masgra = Array();
		$gradecond['category'] = "博";
		$gradecond['status'] = "在校";
		$r = M("Student")->where($gradecond)->order('entrancedate')->select();
		$year = $r[0]['entrancedate'];
		$year = substr($year,0,4);
		$phdgra[] = $year;
		foreach($r as $k => $v)
		{
			$y = substr($v['entrancedate'],0,4);
			if($y != $year)
			{
				$year = $y;
				$phdgra[] = $year;
			}
		}
		$gradecond['category'] = "硕";
		$gradecond['status'] = "在校";
		$r = M("Student")->where($gradecond)->order('entrancedate')->select();
		$year = $r[0]['entrancedate'];
		$year = substr($year,0,4);
		$masgra[] = $year;
		foreach($r as $k => $v)
		{
			$y = substr($v['entrancedate'],0,4);
			if($y != $year)
			{
				$year = $y;
				$masgra[] = $year;
			}
		}

		//搜索数据
		if(isset($_GET["category"]))
			$cate = $_GET["category"];
		else
			$cate = "teacher";
		if($_GET["category"] != "teacher")
			$grade = $_GET["grade"];
		import("ORG.Util.Page");
		if($_POST['keyword']){	//搜索关键字
			$kmap = $_POST['keyword'];
			$map['name'] = array('like','%'.$kmap.'%');
		}elseif($_GET['keyword']){
			$kmap = $_GET['keyword'];
			$map['name'] = array('like','%'.$kmap.'%');
		}
		if($cate == "teacher")		//老师列表条件
		{
			$table = "teacher";
			$orderkey = "rank";
			$map['status'] = "在校";
		}
		else if($cate == "phd")		//博士列表条件
		{
			$table = "student";
			$orderkey = "entrancedate";
			$map['status'] = "在校";
			$map['category'] = "博";
			$map['entrancedate'] = array('like',$grade.'/%');
		}
		else if($cate == "master")	//硕士列表条件
		{
			$table = "student";
			$orderkey = "entrancedate";
			$map['status'] = "在校";
			$map['category'] = "硕";
			$map['entrancedate'] = array('like',$grade.'/%');
		}
		else if($cate == "grastudent")	//毕业学生列表条件
		{
			$table = "student";
			$map['isshow'] = 1;
			$map['status'] = '离校';
		}
		// 分页代码
		$count = M($table)->where($map)->count();
		$Page = new Page($count,16);
		$Page -> parameter .= "keyword=".urlencode($kmap)."&";
		$show = $Page->show();
		$people = M($table)->where($map)->order($orderkey)->limit($Page->firstRow.','.$Page->listRows)->select(); //查询
		$this->assign("phdgra",$phdgra);
		$this->assign("g",$grade);
		$this->assign("masgra",$masgra);
		$this->assign("pages",$show);
		$this->assign("cate",$cate);
		$this->assign("type",$table);	//用于生成个人主页链接
		$this->assign("people",$people);
		$this->assign("menu","People");
		$this->display("Public:people");
	}
}
?>