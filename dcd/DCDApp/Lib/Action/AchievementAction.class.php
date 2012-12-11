<?php
class AchievementAction extends BaseAction{
	public function index()
	{
		
		$Pages=M("Achievementpages");
		$pages=$Pages->order("id")->select();
		if(isset($_GET["id"]))
		{
			
			$id=$_GET["id"];
			foreach($pages as $n=>$page)
			{
				if($page["id"]==$id)
				{
					$curpage=$page;
					break;
				}
			}
		}
		else $curpage=$pages[0];
		$this->assign("cpn",$id);
		$this->assign("intros",$pages);
		$this->assign("curpage",$curpage);
		$this->assign("menu","Achievement");
		$this->display("Public:Achievement");
	}
}
?>