<?php
class MemberAction extends BaseAction{
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
			$map['username'] = array('like','%'.$kmap.'%');
		}elseif($_GET['keyword']){
			$kmap = $_GET['keyword'];
			$map['username'] = array('like','%'.$kmap.'%');
		}
		$count = $Member->where($map)->count();
		$Page = new Page($count,20);
		$Page -> parameter .= "keyword=".urlencode($kmap)."&";
		$show = $Page->show();
		$user = $Member->where($map)->order('uid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('pages',$show);
		$this->assign("user",$user);
		$this->display("Public:member");
	}
	public function add(){
		$this->assign("dsp","add");
		$this->display("Public:member");
	}
	public function adds(){
		$Member = D("Administrator");
		if($Member->Create()){
			$Member->password = md5($_POST['password']);
			if($Member->add()){
				$this->assign("jumpUrl","__URL__");
				$this->success("添加成功！");
			}else{
				$this->error("添加失败！");
			}
		}else{
			$this->error($Member->getError());
		}
	}
	public function edit(){
		if($_GET['uid']){
			$userInfo = D("Administrator")->getByUid($_GET['uid']);
			$this->assign($userInfo);
			$this->assign("dsp","edit");
			$this->display("Public:member");	
		}else{
			$this->assign("jumpUrl","__URL__");
			$this->error("数据不存在！");
		}
	}
	public function edits(){
		$data = $_POST;
		if($data['newpwd']) $data['password'] = md5($data['newpwd']);
		if(D("Administrator")->save($data)){
			$this->success("修改成功！");
		}else{
			$this->error("修改失败！");
		}
	}
	public function batch(){
		$this->_batch();
	}
}
?>