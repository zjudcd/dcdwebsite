<?php
class PaperAction extends Action{
	public function index(){
		$type = $_GET["type"];
		if($type == "jour")
			$table = "journalpaper";
		else
			$table = "conferencepaper";
		$cond["id"] = $_GET["id"];
		$p = M($table)->where($cond)->select;
		$this->assign(paper,$p[0]);
		$this->display("Public:paper");
	}
}
?>