<?php
class AboutAction extends BaseAction{
	public function index()
	{
		$Pages=M("Pages");
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
		$this->assign("cpn",$id);//ÄÄ¸öÁ´½Ó
		$this->assign("intros",$pages);// 
		$this->assign("curpage",$curpage);
		$this->assign("menu","About");
		$this->display("Public:about");
	}
}
?>