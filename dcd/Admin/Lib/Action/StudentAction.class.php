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
		$this->assign(menu,"Members");
		$this->display("Public:student");
	}
	public function add(){
		$Teac = M("Teacher")->select();
		$s = Array();
		$s["photo"] = "default.jpg";
		$this->assign(student,$s);
		$this->assign(action,"adds");
		$this->assign(title,"添加");
		$this->assign("teacher",$Teac);
		$this->assign("dsp","detail");
		$this->assign(menu,"Members");
		$this->display("Public:student");
	}
	public function adds(){
		if(!empty($_FILES['photo']['name'])){
			$_POST['photo'] = $this->_upload("photo",false,300,400,true);
		}
		else{
			$_POST['photo'] = 'default.jpg';
		}
		$data = $_POST;
		$Student = D("Student");
		$Person = M("Person");
		$per["personid"] = $_POST["id"];
		$per["name"] = $_POST["name"];
		$per["category"] = "学生";
		if($Student->Create() && $Person->Create()){
			if($Student->add($data) && $Person->add($per)){
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
			$cond1["personid"] = $_GET["studentid"];
			$status = M("person")->where($cond1)->select();
			//替换个人简介
			$Stu[0]['introduction'] = str_replace("<br/>","\n",$Stu[0]['introduction']);
			$Stu[0]['introduction'] = str_replace("&nbsp;"," ",$Stu[0]['introduction']);
			//替换入学日期
			$date = split('/',$Stu[0]['entrancedate']);
			$Stu[0]['enyear'] = $date[0];
			$Stu[0]['enmonth'] = $date[1];
			$Stu[0]['enday'] = $date[2];
			$this->assign(title,"编辑");
			$this->assign(action,"edits");
			$this->assign("teacher",$Teac);
			$this->assign("student",$Stu[0]);
			$this->assign("teacherid",$Stu[0]['teacher']);
			$this->assign("dsp","detail");
			$this->assign(menu,"Members");
			$this->display("Public:student");
		}else{
			$this->assign("jumpUrl","__URL__");
			$this->error("数据不存在！");
		}
	}
	public function edits(){
		$data = $_POST;
		if($_POST['show'] == on)
			$data["isshow"] = 1;
		else
			$data["isshow"] = 0;
		if(!empty($_FILES['photo']['name'])){
			$data['photo'] = $this->_upload("photo",false,300,400,true);
		}
		$per["personid"] = $_POST["id"];
		$per["name"] = $_POST["name"];
		
		$s = D("Student")->save($data);
		$p = M("Person")->save($per);
		if($s == true || $p == true)
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
		$data["personid"] = $_GET["studentid"];
		$data["password"] = md5("123456");
		if(M("person")->save($data)){
			$this->success("修改成功！");
		}else{
			$this->success("密码本来就是初始密码或修改失败！");
		}
	}
}
?>