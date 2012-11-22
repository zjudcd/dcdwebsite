<?php
class AboutAction extends BaseAction{
	public function index()
	{
		$this->assign("menu","About");
		$this->display("Public:about");
	}
}
?>