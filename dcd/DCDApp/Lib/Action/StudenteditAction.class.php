<?php
class StudenteditAction extends Action{
	public function _initialize(){
		if($_SESSION["usertype"] != "student")
			$this->error("对不起，您无权访问这个页面！");
	}
	public function index(){
		$cond["id"] = $_SESSION["userid"];
		$person = M("Student")->where($cond)->select();
		if($person[0]["gender"] == "男"){
			$this->man = "selected";
			$this->woman = "";
		}
		else{
			$this->man == "";
			$this->woman = "selected";
		}
		$condt["id"] = $person[0]["teacher"];
		$teacher = M("Teacher")->where($condt)->select();
		$this->teachername = $teacher[0]["name"];
		$person[0]['introduction'] = str_replace("<br/>","\n",$person[0]['introduction']);
		$person[0]['introduction'] = str_replace("&nbsp;"," ",$person[0]['introduction']);
		$this->p = $person[0];
		$this->display("Public:studentedit");
	}
	public function edits(){
		if(!empty($_FILES['photo']['name'])){
			$_POST['photo'] = $this->_upload("photo",false,300,400,true);
		}
		$data["personid"] = $_POST["id"];
		$data["name"] = $_POST["name"];
		if(M('Student')->save($_POST))
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