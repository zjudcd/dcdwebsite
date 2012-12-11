<?php
class ActivityAction extends BaseAction{
	public function index()
	{
		$Pages=M("Activitypages");
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
		else 
		{
			$curpage=$pages[0];
			$id=$curpage["id"];
		}
		$this->assign("cpn",$id);
		$this->assign("intros",$pages);
		$this->assign("curpage",$curpage);
		$this->assign("menu","Activity");
		$this->display("Public:Activity");
	}
}
?>