<?php
class PublicAction extends Action{
	function _initialize(){
		$sid = Session::get(C('USER_AUTH_KEY'));
	}
	public function login(){
		$this->display("Public:login");
	}
	public function logins(){
		if($_SESSION['verify']!=md5($_POST['verify'])){
			$this->error('��֤�����');
		}else{
			$Member = D("Person");
			$map['personid'] = $_POST['username'];
			$map['password'] = md5($_POST['password']);
			$checkUser = $Member->where($map)->find();
			if(!$checkUser){
				$this->assign("jumpUrl","__APP__");
				$this->error("�û��������벻��ȷ��");
			}else{
				Session::set(C('USER_AUTH_KEY'),$checkUser['personid']);
				Session::set('admin',$checkUser['personid']);
				$Member->where("personid = ".$checkUser['personid']);
				$this->assign("jumpUrl","__APP__/Index");
				$this->success("��½�ɹ���");
			}
		}
	}
	public function verify(){ 
		$type = isset($_GET['type'])?$_GET['type']:'gif'; 
        import("ORG.Util.Image"); 
        Image::buildImageVerify(4,1,$type,'','20px'); 
    }
	public function logout(){
		if(Session::is_set(C('USER_AUTH_KEY'))){
			Session::clear();
			$this->assign('jumpUrl',__URL__.'/login');
			$this->success("ע���ɹ���");
		}else{
			$this->assign('jumpUrl',__URL__.'/login');
			$this->error('�Ѿ�ע����');
		}
		$this->forward();
	}
}
?><?php
class PublicAction extends Action{
	function _initialize(){
		$sid = Session::get(C('USER_AUTH_KEY'));
	}
	public function login(){
		$this->display("Public:login");
	}
	public function logins(){
		if($_SESSION['verify']!=md5($_POST['verify'])){
			$this->error('��֤�����');
		}else{
			$Member = D("Administrator");
			$map['username'] = $_POST['username'];
			$map['password'] = md5($_POST['password']);
			$checkUser = $Member->where($map)->find();
			if(!$checkUser){
				$this->assign("jumpUrl","__APP__");
				$this->error("�û��������벻��ȷ��");
			}else{
				Session::set(C('USER_AUTH_KEY'),$checkUser['uid']);
				Session::set('admin',$checkUser['username']);
				$Member->where("uid = ".$checkUser['uid'])->setField("lastlogintime",time());
				$this->assign("jumpUrl","__APP__/Index");
				$this->success("��½�ɹ���");
			}
		}
	}
	public function verify(){ 
		$type = isset($_GET['type'])?$_GET['type']:'gif'; 
        import("ORG.Util.Image"); 
        Image::buildImageVerify(4,1,$type,'','20px'); 
    }
	public function logout(){
		if(Session::is_set(C('USER_AUTH_KEY'))){
			Session::clear();
			$this->assign('jumpUrl',__URL__.'/login');
			$this->success("ע���ɹ���");
		}else{
			$this->assign('jumpUrl',__URL__.'/login');
			$this->error('�Ѿ�ע����');
		}
		$this->forward();
	}
}
?>