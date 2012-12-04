<?php
class AboutAction extends BaseAction{
	public function index()
	{
		$News=M("News");
		$cond["typeid"]=9;//实验室介绍 在News表中的类型ID为0
		$pages=$News->where($cond)->order("id")->select();
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
		$this->assign("intros",$pages);
		$this->assign("curpage",$curpage);
		$this->assign("menu","About");
		$this->display("Public:about");
	}
}
?>