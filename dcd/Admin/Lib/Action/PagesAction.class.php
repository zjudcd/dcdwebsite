<?php
class PagesAction extends BaseAction{
	public function index(){
		$Pages = D("Pages");
		import("ORG.Util.Page");
		if($_POST['keyword']){
			$kmap = $_POST['keyword'];
			$map['title'] = array('like','%'.$kmap.'%');
		}elseif($_GET['keyword']){
			$kmap = $_GET['keyword'];
			$map['title'] = array('like','%'.$kmap.'%');
		}
		$count = $Pages->where($map)->count();
		$Page = new Page($count,20);
		$Page -> parameter .= "keyword=".urlencode($kmap)."&";
		$show = $Page->show();
		$pages = $Pages->where($map)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign(menu,"Pages");
		$this->assign('pages',$show);
		$this->assign("pgs",$pages);
		$this->display("Public:pages");
	}
	public function add(){
		$this->assign("dsp","add");
		$this->assign(menu,"Pages");
		$this->display("Public:pages");
	}
	public function adds(){
		$Pages = D("Pages");
		if($Pages->Create()){
			if($Pages->add()){
				$this->assign("jumpUrl","__URL__");
				$this->success("发布成功！");
			}else{
				$this->error("发布失败！");
			}
		}else{
			$this->error($Pages->getError());
		}
	}
	public function edit(){
		if($_GET['id']){
			$pgs = D("Pages")->getById($_GET['id']);
			$this->assign($pgs);
			$this->assign("dsp","edit");
			$this->assign(menu,"Pages");
			$this->display("Public:pages");
		}else{
			$this->assign("jumpUrl","__URL__");
			$this->error("数据不存在！");
		}
	}
	public function edits(){
		$data = $_POST;
		$data['submittime'] = strtotime($_POST['submittime']);
		if(D("Pages")->save($data)){
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