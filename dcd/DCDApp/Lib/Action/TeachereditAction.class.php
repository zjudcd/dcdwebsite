﻿<?php
class TeachereditAction extends Action{
	public function _initialize(){
		if($_SESSION["usertype"] != "teacher")
			$this->error("对不起，您无权访问这个页面！");
	}
	public function index(){
		$cond["id"] = $_SESSION["userid"];
		$person = M("Teacher")->where($cond)->select();
		if($person[0]["gender"] == "男"){
			$this->man = "selected";
			$this->woman = "";
		}
		else{
			$this->man == "";
			$this->woman = "selected";
		}
		if($person[0]["ismarried"] == 1){
			$this->ismarried = "selected";
			$this->notmarried = "";
		}
		else{
			$this->ismarried = "";
			$this->notmarried = "selected";
		}
		$p = Array();
		switch($person[0]["position"])
		{
			case "教授":
				$p[0] = "selected";
				$p[1] = "";
				$p[2] = "";
				$p[3] = "";
				$p[4] = "";
				break;
			case "副教授":
				$p[0] = "";
				$p[1] = "selected";
				$p[2] = "";
				$p[3] = "";
				$p[4] = "";
				break;
			case "讲师":
				$p[0] = "";
				$p[1] = "";
				$p[2] = "selected";
				$p[3] = "";
				$p[4] = "";
				break;
			case "博士后":
				$p[0] = "";
				$p[1] = "";
				$p[2] = "";
				$p[3] = "selected";
				$p[4] = "";
				break;
			default:
				$p[0] = "";
				$p[1] = "";
				$p[2] = "";
				$p[3] = "";
				$p[4] = "selected";
				break;
		}
		$person[0]['introduction'] = str_replace("<br/>","\n",$person[0]['introduction']);
		$person[0]['introduction'] = str_replace("&nbsp;"," ",$person[0]['introduction']);
		$this->assign(position,$p);
		$this->assign(p,$person[0]);
		$this->display("Public:Teacheredit");
	}
	public function edits(){
		if(!empty($_FILES['photo']['name'])){
			$_POST['photo'] = $this->_upload("photo",false,300,400,true);
		}
		$data["personid"] = $_POST['id'];
		$data["name"] = $_POST['name'];
		if(M('Teacher')->save($_POST))
		{
			M("Person")->save($data);
			$this->success("修改成功！");
		}
		else
			$this->error("数据无变化或修改失败！");
	}
	public function _upload($path,$thumb = false,$width,$height,$autosub = false,$maxsize){
        import("ORG.Net.UploadFile"); 
        $upload = new UploadFile();  
        isset($maxsize) ? $upload->maxSize = $maxsize : $upload->maxSize = 1048576; //1M
		isset($path) ? $upload->savePath = $savepath = "./Attachments/".$path."/" : $upload->savePath = "./Attachments/Others/";
		if(!is_dir($savepath)) @mk_dir($savepath);
        $upload->allowExts = explode(',','gif,png,jpg,jpeg,pdf,doc,docx'); 
		if($thumb){
			$upload->thumb = true; 
			$upload->thumbPrefix = '';
			$upload->thumbSuffix = '_thumb';
			isset($wideh) ? $upload->thumbMaxWidth = $width : $upload->thumbMaxWidth = "300"; 
			isset($height) ? $upload->thumbMaxHeight = $height : $upload->thumbMaxHeight = "400"; 
		}
    	if($autosub){
			$upload->autoSub = true;
			$upload->subType = 'date';
        	$upload->saveRule = time; 
			$upload->dateFormat = 'Y/m/d'; 	
		}
        if(!$upload->upload()){ 
           	$this->error($upload->getErrorMsg()); 
        }else{ 
			$imginfo = $upload->getUploadFileInfo();
			$imginfo = $imginfo[0]['savename'];
        }
		return $imginfo;
    }
}
?>