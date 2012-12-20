<?php
class IndexAction extends BaseAction{
    public function index(){
		$news = M("News")->order('date desc')->limit(10)->select();
		$this->slide();
		$this->assign("menu","Home");
		$this->assign("news",$news);
		
        $this->display("Public:index");
    }
	protected function slide(){
		$slides = M("Slide")->order("postdate desc")->limit(5)->select();
		$this->assign("slide",$slides);
	}
	
	public function about()
	{
		$this-assign("menu","Home");
		$this->display("Public:about");
	}
}
?>