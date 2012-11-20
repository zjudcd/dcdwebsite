<?php
class IndexAction extends BaseAction{
    public function index(){
		$news = M("News")->order('date desc')->limit(1)->select();
		if($news != null)
			$newest=$news[0];
		else
			$newest = null;
		$this->assign("newest",$newest);
		
		$cond['typeid']=2;//学术通知
		$news = M("News")->where($cond)->order('date desc')->limit(5)->select();
		$this->assign("news",$news);
		
		$this->slide();
        $this->display("Public:index");
    }
	protected function slide(){
		$slide = D("Slide")->select();
		$this->assign("slide",$slide);
	}
	
	public function about()
	{
		$this->display("Public:about");
	}
}
?>