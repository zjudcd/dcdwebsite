<?php
class TeacherAction extends BaseAction{
	function _initialize(){
		$map['uid'] = $_SESSION[C('USER_AUTH_KEY')];
		$map['privilege'] = "1";
		$comp = D("Administrator")->where($map)->select();
		if(!$comp) $this->error("对不起，您没有权限！");
	}
	public function index(){
		$Member = D("Teacher");
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
		$this->assign(menu,"Members");
		$this->display("Public:teacher");
	}
	public function add(){
		$this->assign("dsp","add");
		$this->assign(menu,"Members");
		$this->display("Public:teacher");
	}
	public function adds(){
		if(!empty($_FILES['photo']['name'])){
			$_POST['photo'] = $this->_upload("photo",false,300,400,true);
		}
		else{
			$_POST['photo'] = 'default.jpg';
		}
		$Teacher = D("Teacher");
		$Person = M("Person");
		$per["personid"] = $_POST["id"];
		$per["name"] = $_POST["name"];
		$per["category"] = "教师";
		$per["status"] = "在校";
		if($Teacher->Create() && $Person->Create()){
			if($Teacher->add($_POST) && $Person->add($per)){
				$this->assign("jumpUrl","__URL__");
				$this->success("发布成功！");
			}else{
				$this->error("发布失败！");
			}
		}else{
			$this->error($Teacher->getError());
		}
	}
	public function edit(){
		if($_GET["teacherid"]){
			$cond["id"]=$_GET["teacherid"];
			$Teac = D("teacher")->where($cond)->select();
			if($Teac[0]["gender"] == "男")
			{
				$this->man = "selected";
				$this->woman = "";
			}
			else
			{
				$this->man = "";
				$this->woman = "selected";
			}
			if($Teac[0]["ismarried"] == 1)
			{
				$this->married = "selected";
				$this->notmarried = "";
			}
			else
			{
				$this->married = "";
				$this->notmarried = "selected";
			}
			$p = Array();
			switch($Teac[0]["position"])
			{
				case "教授":
					$p[0] = "selected";
					$p[1] = "";
					$p[2] = "";
					$p[3] = "";
					$p[4] = "";
					break;
				case "副教授":
					$p[0] = "";
					$p[1] = "selected";
					$p[2] = "";
					$p[3] = "";
					$p[4] = "";
					break;
				case "讲师":
					$p[0] = "";
					$p[1] = "";
					$p[2] = "selected";
					$p[3] = "";
					$p[4] = "";
					break;
				case "博士后":
					$p[0] = "";
					$p[1] = "";
					$p[2] = "";
					$p[3] = "selected";
					$p[4] = "";
					break;
				default:
					$p[0] = "";
					$p[1] = "";
					$p[2] = "";
					$p[3] = "";
					$p[4] = "selected";
					break;
			}
			$this->assign(position,$p);
			$this->assign(menu,"Members");
			$this->assign("teacher",$Teac[0]);
			$this->assign("dsp","edit");
			$this->display("Public:teacher");
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
		$per["personid"] = $_POST["id"];
		$per["name"] = $_POST["name"];
		if(D("Teacher")->save($data) != false)
		{
			M("Person")->save($per);
			$this->success("修改成功！");
		}else{
			$this->error("修改失败或无修改！");		
		}
	}
	public function batch(){
		$this->_batch();
	} 
	public function reset(){
		$data["personid"] = $_GET["teacherid"];
		$data["password"] = md5("123456");
		if(M("person")->save($data)){
			$this->success("修改成功！");
		}else{
			$this->success("修改失败！");
		}
	}
}
?>