<?php
class AboutAction extends BaseAction{
	public function index()
	{
		$Pages=M("Pages");
		$cond["type"] = 1; // 页面类型 1 实验室介绍
		$pages=$Pages->where($cond)->order("id")->select();
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
		$this->assign("cpn",$id);//哪个链接
		$this->assign("intros",$pages);// 
		$this->assign("curpage",$curpage);
		$this->assign("menu","About");
		$this->display("Public:about");
	}
	
	public function direction()
	{
		$Pages=M("Pages");
		$cond["type"] = 2; // 页面类型 2 科研成果
		$pages=$Pages->where($cond)->order("id")->select();
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
		$this->assign("cpn",$id);//哪个链接
		$this->assign("intros",$pages);// 
		$this->assign("curpage",$curpage);
		$this->assign("menu","Direction");
		$this->display("Public:direction");
	}
	
	public function prodlist()
	{		
		$Pages=M("Pages");
		
		if(isset($_GET["type"]))
		{
			$type = $_GET["type"];
		}
		else $type = 5;
		$cond["type"] = $type; // 研究方向 栏目下：平台建设(5) 获奖成果(3) 代表性论著
		$pages=$Pages->where($cond)->order("id")->select();
		
		if(isset($_GET["id"]))
		{
			
			$id=$_GET["id"];
			$found = false;
			foreach($pages as $n=>$page)
			{
				if($page["id"]==$id)
				{
					$curpage=$page;
					$found = true;
					break;
				}
			}
		}
		else
		{
			if($pages)
				$curpage = $pages[0];
			$id=$curpage["id"];
		}
		
		
		
		$this->assign("cpn",$id);// 哪个链接
		if($type == 5)
			$this->assign("platform",$pages);// 
		else if($type == 3)
			$this->assign("award",$pages);// 
		$this->assign("curpage",$curpage);
		$this->assign("menu","Prodlist");
		$this->display("Public:prodlist");
	}
	
	public function activity()
	{
		// type = 4
		$Pages=M("Pages");
		$cond["type"] = 4; // 页面类型 4 学术活动
		$pages=$Pages->where($cond)->order("id")->select();
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
		$this->assign("cpn",$id);//哪个链接
		$this->assign("intros",$pages);// 
		$this->assign("curpage",$curpage);
		$this->assign("menu","Activity");
		$this->display("Public:activity");
	}
	
	// 代表性论著
	public function typical()
	{
		$cond["istypical"] = 1;
		// 代表性 期刊论文
		$Jour = M("Journalpaper")->where($cond)->select();
		$this->assign("tjour",$Jour);
		// 代表性 会议论文
		$Conf = M("Conferencepaper")->where($cond)->select();
		$this->assign("tconf",$Conf);
		
		// 代表性 项目
		
		//
		$this->assign("menu","Prodlist");
		$this->display("Public:prodlist");
	}
}
?>