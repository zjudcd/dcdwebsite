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
		print_r($_POST);
		if(!empty($_FILES['photo']['name'])){
			$_POST['photo'] = $this->_upload("photo",false,300,400,true);
		}
		else{
			$_POST['photo'] = 'default.jpg';
		}
		$Admin = D("Administrator");
		if($Admin->Create()){
			if($Admin->add()){
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
		$data = $_POST;
		if($_POST["password1"] != "")
			$data["password"] = md5($_POST["password1"]);
		return;
		if(D("Teacher")->save($data)){
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