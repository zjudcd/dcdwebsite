﻿<?php
class TeacherselfAction extends Action{
	public function _initialize(){
		if(!isset($_SESSION["usertype"]) || $_SESSION["usertype"] == "" || $_SESSION["usertype"] == "student")
			$this->error("对不起，您无权访问这个页面！");
	}
	public function index(){
		$condteacher["id"] = $_SESSION["userid"];
		$per = M("Teacher")->where($condteacher)->select();
		$this->p = $per[0];
		$P=M("Products");
		$cond1="personid='".$_SESSION["userid"]."' and producttype='期刊论文'";
		$prods=$P->where($cond1)->select();
		$Jour=M("Journalpaper");
		$papers=array();
		foreach($prods as $k=>$prod)
		{
			$prodid=$prod["productid"];
			//$cond["id"]=$prodid;
			$cond="id =".$prodid;
			$paper=$Jour->where($cond)->select();
			$papers[]=$paper[0];
		}
		$this->assign(jourpapers,$papers);
		$papers = Array();
		$Conf=M("Conferencepaper");
		$cond1="personid='".$_SESSION["userid"]."' and producttype='会议论文'";
		$prods=$P->where($cond1)->select();
		foreach($prods as $k=>$prod)
		{
			$prodid=$prod["productid"];
			$cond="id =".$prodid;
			$paper=$Conf->where($cond)->select();
			$papers[]=$paper[0];
		}
		$this->assign(confpapers,$papers);
		
		// project 写在下面
		$resultprojects = Array();
		$productscond["personid"] = $_SESSION["userid"];
		$productscond["producttype"] = "科研项目";
		$products = M("products")->where($productscond)->select();
		foreach($products as $key => $product)
		{
			$people = Array();
			$productcond["productid"] = $product["productid"];
			$productcond["producttype"] = "科研项目";
			$protmp = M("products")->where($productcond)->select();
			foreach($protmp as $k => $v)	//查项目负责人姓名
			{
				$personcond["personid"] = $v["personid"];
				$person = M("person")->where($personcond)->select();
				array_push($people,$person[0]['name']);
			}
			$projectcond['id'] = $product['productid'];
			$project = M("project")->where($projectcond)->select();//查项目详情
			if(count($project) == 0)
				break;
			$result = Array();
			$result["personname"] = implode(",",$people);
			$projecttypecond[id] = $project[0]["typeid"];
			$type = M("projecttype")->where($projecttypecond)->select();
			$result["typename"] = $type[0]["name"];
			$result["title"] = $project[0]["title"];
			array_push($resultprojects,$result);
		}
		$this->assign("projects",$resultprojects);
		$this->display("Public:teacherdetail");
	}
}
?>