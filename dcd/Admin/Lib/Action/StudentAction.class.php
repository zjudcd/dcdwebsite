<?php
class StudentAction extends BaseAction{
	function _initialize(){
		$map['uid'] = $_SESSION[C('USER_AUTH_KEY')];
		$map['privilege'] = "1";
		$comp = D("Administrator")->where($map)->select();
		if(!$comp) $this->error("对不起，您没有权限！");
	}
	public function index(){
		$Member = D("Student");
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
		$user = $Member->where($map)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('pages',$show);
		$this->assign("user",$user);
		$this->display("Public:student");
	}
	public function add(){
		$Teac = M("Teacher")->select();
		$this->assign("teacher",$Teac);
		$this->assign("dsp","add");
		$this->display("Public:student");
	}
	public function adds(){
		if(!empty($_FILES['photo']['name'])){
			$_POST['photo'] = $this->_upload("photo",false,300,400,true);
		}
		else{
			$_POST['photo'] = 'default.jpg';
		}
		$Student = D("Student");
		$Person = M("Person");
		$per["personid"] = $_POST["id"];
		$per["name"] = $_POST["name"];
		$per["category"] = "学生";
		$per["status"] = "在校"; 
		if($Student->Create() && $Person->Create()){
			if($Student->add() && $Person->add($per)){
				$this->assign("jumpUrl","__URL__");
				$this->success("发布成功！");
			}else{
				$this->error("发布失败！");
			}
		}else{
			$this->error($Student->getError());
		}
	}
	public function edit(){
		if($_GET["studentid"]){
			$cond["id"]=$_GET["studentid"];
			$Stu = D("student")->where($cond)->select();
			$Teac = M("Teacher")->select();
			if($Stu[0]["gender"] == "男")
			{
				$this->man = "selected";
				$this->woman = "";
			}
			else
			{
				$this->man = "";
				$this->woman = "selected";
			}
			$this->assign("teacher",$Teac);
			$this->assign("student",$Stu[0]);
			$this->assign("teacherid",$Stu[0]['teacher']);
			$this->assign("dsp","edit");
			$this->display("Public:student");
		}else{
			$this->assign("jumpUrl","__URL__");
			$this->error("数据不存在！");
		}
	}
	public function edits(){
		$data = $_POST;
		if(!empty($_FILES['photo']['name'])){
			$data['photo'] = $this->_upload("photo",false,300,400,true);
		}
		if(D("Student")->save($data)){
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