<?php
class newsAction extends BaseAction{
	
	public function index()
	{
		$News = D("News");
		import("ORG.Util.Page");
		if($_POST['keyword']){
			$kmap = $_POST['keyword'];
			$map['title'] = array('like','%'.$kmap.'%');
		}else if($_GET['keyword']){
			$kmap = $_GET['keyword'];
			$map['title'] = array('like','%'.$kmap.'%');
		}
		$count = $News->where($map)->count();
		$Page = new Page($count,20);
		$Page -> parameter .= "keyword=".urlencode($kmap)."&";
		$show = $Page->show();
		$fields='id,title,date';
		$news = $News->where($map)->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('pages',$show);
		$this->assign("news",$news);
		$this->display("Public:news");
	}
	public function detail()
	{
		$newsid = $_GET["newsid"];
		$cond["id"]=$newsid;
		$news=M("News")->where($cond)->select();
		$this->assign("news",$news[0]);
		$this->display("Public:newsdetail");
	}
}
?>