﻿<?php
class StudentdetailAction extends Action{
	public function index(){
		$this->assign("menu","People");
		$condstudent["id"] = $_GET["id"];
		$per = M("Student")->where($condstudent)->select();
		$this->assign(person,$per[0]);
		/*
		$condteacher["id"] = $per[0]['teacher'];
		$teacher = M("teacher")->where($condteacher)->select();
		$this->t = $teacher[0];
		$P=M("Products");
		$cond1="personid='".$_GET["id"]."' and producttype='期刊论文'";
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
		$Conf=M("Conferencepaper");
		$cond1="personid='".$_GET["id"]."' and producttype='会议论文'";
		$prods=$P->where($cond1)->select();
		foreach($prods as $k=>$prod)
		{
			$prodid=$prod["productid"];
			$cond="id =".$prodid;
			$paper=$Conf->where($cond)->select();
			$papers[]=$paper[0];
		}
		$this->assign("papers",$papers);
		
		// project 写在下面
		$resultprojects = Array();
		$productscond["personid"] = $_GET["id"];
		$productscond["producttype"] = "科研项目";
		$products = M("products")->where($productscond)->select();
		foreach($products as $key => $product)
		{
			$people = Array();
			$productcond["productid"] = $product["productid"];
			$productcond["producttype"] = "科研项目";
			$protmp = M("products")->where($productcond)->select();
			foreach($protmp as $k => $v)
			{
				$personcond["personid"] = $v["personid"];
				$person = M("person")->where($personcond)->select();
				array_push($people,$person[0]['name']);
			}
			$projectcond['id'] = $product['productid'];
			$project = M("project")->where($projectcond)->select();
			$result = Array();
			$result["personname"] = implode(",",$people);
			$projecttypecond[id] = $project[0]["typeid"];
			$type = M("projecttype")->where($projecttypecond)->select();
			$result["typename"] = $type[0]["name"];
			$result["title"] = $project[0]["title"];
			array_push($resultprojects,$result);
		}
		$this->assign("projects",$resultprojects);
		*/
		$this->display("Public:studentdetail");
	}
}
?>