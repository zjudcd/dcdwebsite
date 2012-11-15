<?php
class SettingAction extends BaseAction{
	public function index(){
		$siteinfo = D("Options")->findall();
		foreach($siteinfo as $key){
			$this->assign($key['types'],$key['values']);
		}
		$this->display("Public:setting");
	}
	public function update(){
		$data = $_POST;
		foreach($data AS $key => $value) {
            $result = D("Options")->query("REPLACE INTO __TABLE__ VALUES ('$key', '$value');");
        }
		$this->assign("jumpUrl","__URL__");
		$this->success("更新成功！");
	}
}
?>