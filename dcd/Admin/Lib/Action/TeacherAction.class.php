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
		$t = Array();
		$t["photo"] = 'default.jpg';
		$this->assign(teacher,$t);
		$this->assign(title,"添加");
		$this->assign(action,"adds");
		$this->assign("dsp","detail");
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
		$data = $_POST;
		$Teacher = D("Teacher");
		$Person = M("Person");
		$per["personid"] = $_POST["id"];
		$per["name"] = $_POST["name"];
		$per["category"] = "教师";
		if($Teacher->Create() && $Person->Create()){
			if($Teacher->add($data) && $Person->add($per)){
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
			$Teac[0]['introduction'] = str_replace("<br/>","\n",$Teac[0]['introduction']);
			$Teac[0]['introduction'] = str_replace("&nbsp;"," ",$Teac[0]['introduction']);
			$this->assign(title,"编辑");
			$this->assign(action,"edits");
			$this->assign(position,$p);
			$this->assign(menu,"Members");
			$this->assign("teacher",$Teac[0]);
			$this->assign("dsp","detail");
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
		$t = D("Teacher")->save($data);
		$p = M("Person")->save($per);
		if($t == true || $p == true)
		{
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