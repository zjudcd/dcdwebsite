<?php
class AboutAction extends BaseAction{
	public function index()
	{
		$News=M("News");
		$cond["typeid"]=9;//ʵ���ҽ��� ��News���е�����IDΪ0
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