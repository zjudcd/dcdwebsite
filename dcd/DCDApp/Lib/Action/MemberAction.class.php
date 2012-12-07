<?php
class MemberAction extends Action{
	public function index(){
		$cond["id"] = $_SESSION["userid"];
		$person = M("Student")->where($cond)->select();
		if($person[0]["gender"] == "男"){
			$this->man = "selected";
			$this->woman = "";
		}
		else{
			$this->man == "";
			$this->woman = "selected";
		}
		$condt["id"] = $person[0]["teacher"];
		$teacher = M("Teacher")->where($condt)->select();
		$this->teachername = $teacher[0]["name"];
		$this->p = $person[0];
		$this->display("Public:Member");
	}
}
?>