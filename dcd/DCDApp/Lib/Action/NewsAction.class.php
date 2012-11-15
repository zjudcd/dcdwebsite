<?php
class NewsAction extends BaseAction{
	
	public function index()
	{
		$fields='id,title,date';
		$news = M("News")->order('date desc')->limit(10)->select();
		$this->assign("news",$news);
		if($news == null)
			$debug = "null";
		else
			$debug = "ok";
		$this->assign("debug",$debug);
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