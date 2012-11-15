<?php
class IndexAction extends BaseAction{
    public function index(){
		Load('extend');
		$nproducts = D("Products")->order("pid desc")->limit(2)->select();
		$this->slide();
		$this->assign("nproducts",$nproducts);
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