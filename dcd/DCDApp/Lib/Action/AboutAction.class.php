<?php
class AboutAction extends BaseAction{
	public function index()
	{
		$Pages=M("Pages");
		$cond["type"] = 1; // ҳ������ 1 ʵ���ҽ���
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
		$this->assign("cpn",$id);//�ĸ�����
		$this->assign("intros",$pages);// 
		$this->assign("curpage",$curpage);
		$this->assign("menu","About");
		$this->display("Public:about");
	}
	
	public function direction()
	{
		$Pages=M("Pages");
		$cond["type"] = 2; // ҳ������ 2 ���гɹ�
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
		$this->assign("cpn",$id);//�ĸ�����
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
		$cond["type"] = $type; // �о����� ��Ŀ�£�ƽ̨����(5) �񽱳ɹ�(3) ����������
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
		
		
		
		$this->assign("cpn",$id);// �ĸ�����
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
		$cond["type"] = 4; // ҳ������ 4 ѧ���
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
		$this->assign("cpn",$id);//�ĸ�����
		$this->assign("intros",$pages);// 
		$this->assign("curpage",$curpage);
		$this->assign("menu","Activity");
		$this->display("Public:activity");
	}
	
	// ����������
	public function typical()
	{
		$cond["istypical"] = 1;
		// ������ �ڿ�����
		$Jour = M("Journalpaper")->where($cond)->select();
		$this->assign("tjour",$Jour);
		// ������ ��������
		$Conf = M("Conferencepaper")->where($cond)->select();
		$this->assign("tconf",$Conf);
		
		// ������ ��Ŀ
		
		//
		$this->assign("menu","Prodlist");
		$this->display("Public:prodlist");
	}
}
?>