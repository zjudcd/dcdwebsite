<?php
	class TestAction extends BaseAction
	{
		public function index(){
			$this->display("Public:test");
		}
		public function upload(){
			print_r($_POST);
			print_r($_FILES);
			$this->_upload("photo",false,300,400,false,1048576);
		}
	}
?>