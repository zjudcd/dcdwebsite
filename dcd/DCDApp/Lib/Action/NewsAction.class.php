<?php
class NewsAction extends BaseAction{
	
	public function index()
	{
		$News = D("News");
		import("ORG.Util.Page");
		// �Ƿ��ύ�˼����ؼ���
		if($_POST['keyword']){
			$kmap = $_POST['keyword'];
			$map['title'] = array('like','%'.$kmap.'%');
		}else if($_GET['keyword']){
			$kmap = $_GET['keyword'];
			$map['title'] = array('like','%'.$kmap.'%');
		}
		$typeid = 0;// Ĭ��ѡ������
		if($_POST["typeid"])
		{
			$typeid=$_POST["typeid"];//Ŀǰѡ����typeid
			$map["typeid"]=$typeid;
		}
		else if($_GET["typeid"])
		{
			$typeid=$_GET["typeid"];//Ŀǰѡ����typeid
			$map["typeid"]=$typeid;
		}
		$count = $News->where($map)->count();
		$Page = new Page($count,20);
		$Page -> parameter .= "keyword=".urlencode($kmap)."&";
		$show = $Page->show();
		$news = $News->where($map)->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$types=M("Newstype")->select();
		$this->assign("types",$types);
		$this->assign("typeid",$typeid);
		$this->assign('pages',$show);
		$this->assign("news",$news);
		$this->assign("menu","News");
		$this->display("Public:news");
	}
	public function detail()
	{
		$newsid = $_GET["newsid"];
		$cond["id"]=$newsid;
		$news=M("News")->where($cond)->select();
		$this->assign("news",$news[0]);
		$this->assign("menu","News");
		$this->display("Public:newsdetail");
	}
}
?>