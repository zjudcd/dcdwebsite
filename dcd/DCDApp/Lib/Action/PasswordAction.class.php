<?php
class PasswordAction extends Action{
	public function index(){
		$this->display("Public:password");
	}
	public function edits(){
		$cond['personid'] = $_SESSION["userid"];
		$person = M("person")->where($cond)->select();
		if($person[0]['password'] == md5($_POST['oldpw']))
		{
			$data["personid"] = $_SESSION["userid"];
			$data["password"] = md5($_POST['newpw']);
			M("person")->save($data);
			$this->success("修改成功！");
		}
		else
		{
			$this->error("原密码错误！");
		}
	}
}
?>