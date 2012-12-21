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
		$baseurl="__ROOT__/Attachments/Slide/";
		foreach($slides as $n => $s)
		{
			//นนิ์pics,links,texts
			$pics[] = $baseurl.$s["attachment"];
			$links[]= $s["url"];
			$texts[]= $s["title"];
		}
		$strpics = join("|",$pics);
		$strlinks = join("|",$links);
		$strtexts = join("|",$texts);
		//$this->assign("slide",$slides);
		$this->assign("pics",$strpics);
		$this->assign("links",$strlinks);
		$this->assign("texts",$strtexts);
	}
	
	public function about()
	{
		$this-assign("menu","Home");
		$this->display("Public:about");
	}
}
?>