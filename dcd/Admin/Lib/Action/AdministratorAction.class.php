<?php
class AdministratorAction extends BaseAction{
	function _initialize(){
		$map['uid'] = $_SESSION[C('USER_AUTH_KEY')];
		$map['privilege'] = "1";
		$comp = D("Administrator")->where($map)->select();
		if(!$comp) $this->error("对不起，您没有权限！");
	}
	public function index(){
		$Member = D("Administrator");
		import("ORG.Util.Page");
		if($_POST['keyword']){
			$kmap = $_POST['keyword'];
			$map['name'] = array('like','%'.$kmap.'%');
		}elseif($_GET['keyword']){
			$kmap = $_GET['keyword'];
			$map['name'] = array('like','%'.$kmap.'%');
		}
		$count = $Member->where($map)->count();
		$Page = new Page($count,20);
		$Page -> parameter .= "keyword=".urlencode($kmap)."&";
		$show = $Page->show();
		$user = $Member->where($map)->order('uid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('pages',$show);
		$this->assign("user",$user);
		$this->display("Public:administrator");
	}
	public function add(){
		$this->assign("dsp","add");
		$this->display("Public:administrator");
	}
	public function adds(){
		$data["privilege"] = $_POST["privilege"];
		$data["username"] = $_POST["username"];
		if($_POST["password"] != "")
			$data["password"] = md5($_POST["password"]);
		$data["name"] = $_POST["name"];
		$data["phone"] = $_POST["phone"];
		$data["cellphone"] = $_POST["cellphone"];
		$data["email"] = $_POST["email"];
		$data["addr"] = $_POST["addr"];
		$Admin = D("Administrator");
		if($Admin->Create()){
			if($Admin->add($data)){
				$this->assign("jumpUrl","__URL__");
				$this->success("发布成功！");
			}else{
				$this->error("发布失败！");
			}
		}else{
			$this->error($Admin->getError());
		}
	}
	public function edit(){
		if($_GET["administratorid"]){
			$cond["uid"]=$_GET["administratorid"];
			$Admin = D("Administrator")->where($cond)->select();
			switch($Admin[0]["privilege"])
			{
			case 1:
				$this->assign("one","selected");
				$this->assign("two","");
				$this->assign("three","");
				break;
			case 2:
				$this->assign("one","");
				$this->assign("two","selected");
				$this->assign("three","");
				break;
			default:
				$this->assign("one","");
				$this->assign("two","");
				$this->assign("three","selected");
			}
			$this->assign("administrator",$Admin[0]);
			$this->assign("dsp","edit");
			$this->display("Public:administrator");
		}else{
			$this->assign("jumpUrl","__URL__");
			$this->error("数据不存在！");
		}
	}
	public function edits(){
		$data["uid"] = $_POST["uid"];
		$data["privilege"] = $_POST["privilege"];
		$data["username"] = $_POST["username"];
		if($_POST["password"] != "")
			$data["password"] = md5($_POST["password"]);
		$data["name"] = $_POST["name"];
		$data["phone"] = $_POST["phone"];
		$data["cellphone"] = $_POST["cellphone"];
		$data["email"] = $_POST["email"];
		$data["addr"] = $_POST["addr"];
		if(D("Administrator")->save($data)){
			$this->success("修改成功！");
		}else{
			$this->error("资料无改变或修改失败！");		
		}
	}
	public function batch(){
		$this->_batch();
	} 
}
?>