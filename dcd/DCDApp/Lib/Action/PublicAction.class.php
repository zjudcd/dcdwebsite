<?php
class PublicAction extends Action{
	function _initialize(){
		$sid = Session::get(C('USER_AUTH_KEY'));
	}
	public function login(){
		$this->display("Public:login");
	}
	public function logins(){
		if($_SESSION['verifyfront']!=md5($_POST['verify'])){
			$this->error('验证码错误！');
		}else{
			$Member = M("Person");
			$map['personid'] = $_POST['username'];
			$map['password'] = md5($_POST['password']);
			$checkUser = $Member->where($map)->find();
			if(!$checkUser){
				$this->assign("jumpUrl","__APP__");
				$this->error("用户名或密码不正确！");
			}else{
				Session::set(C('USER_AUTH_KEY'),$checkUser['personid']);
				Session::set('admin',$checkUser['personid']);
				$Member->where("personid = ".$checkUser['personid']);
				$this->assign("jumpUrl","__APP__/Index");
				$this->success("登陆成功！");
			}
		}
	}
	public function verify(){ 
		$type = isset($_GET['type'])?$_GET['type']:'gif'; 
        import("ORG.Util.Image"); 
        Image::buildImageVerify(4,1,$type,'','20px',verifyfront); 
    }
	public function logout(){
		if(Session::is_set(C('USER_AUTH_KEY'))){
			Session::clear();
			$this->assign('jumpUrl',__URL__.'/login');
			$this->success("注销成功！");
		}else{
			$this->assign('jumpUrl',__URL__.'/login');
			$this->error('已经注销！');
		}
		$this->forward();
	}
}
?>