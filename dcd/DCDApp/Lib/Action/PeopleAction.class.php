<?php
class PeopleAction extends BaseAction{
	public function index()
	{
		$this->assign("menu","People");
		$this->display("Public:people");
	}
}
?>