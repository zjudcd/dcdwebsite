<?php
class PeopleselfAction extends Action{
	public function index(){
		$cond["personid"] = $_SESSION["userid"];
		$person = M("Person")->where($cond)->select();
		if($person[0]['category'] == "教师"){
			$_SESSION["cate"] = "Teacher";
			$condteacher["id"] = $_SESSION["userid"];
			$per = M("Teacher")->where($condteacher)->select();
		}
		else{
			$_SESSION["cate"] = "Student";
			$condstudent["id"] = $_SESSION["userid"];
			$per = M("Student")->where($condstudent)->select();
		}
		$this->p = $per[0];
		$this->display("Public:peopleself");
	}
}
?>