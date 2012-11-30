<?php

class ProductsAction extends BaseAction{
	
	public function index()
	{
		$this->display("Public:product");
	}
	
	public function prodlist(){
		$sp=$_GET["sp"];
		$tablename = $this->pg2tb($sp);// 参数转化为表名
		$M = M($tablename);
		import("ORG.Util.Page");
		$count = $M->count();
		$Page = new Page($count,20);
		$show = $Page->show();
		if($_POST['keyword']){
			$kmap = $_POST['keyword'];
			$map['title'] = array('like','%'.$kmap.'%');
		}elseif($_GET['keyword']){
			$kmap = $_GET['keyword'];
			$map['title'] = array('like','%'.$kmap.'%');
		}
		$Page -> parameter .= "keyword=".urlencode($kmap)."&";
		$M = $M->where($map)->order(' desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('pages',$show);
		$this->assign("product",$M);
		$this->assign("dsp",$sp);
		$this->display("Public:products");
	}
	
	public function edit(){
		if($_GET['id']){
			$M = D("M")->getByPid($_GET['pid']);
			$cats = D("Categroy")->select();
			$this->assign("cats",$cats);
			$this->assign($M);
			$this->assign("dsp","edit");
			$this->display("Public:M");
		}else{
			$this->assign("jumpUrl","__URL__");
			$this->error("数据不存在！");
		}
	}
	public function edits(){
		$data = $_POST;
		$data['parameters'] = nl2br($data['parameters']);
		if(!empty($_FILES['attachment']['name'])) $data['attachment'] = $this->_upload("M",true,360,240,true);
		$data['postdate'] = strtotime($_POST['postdate']);
		if(D("M")->save($data)){
			$this->success("修改成功！");
		}else{
			$this->error("资料无改变或修改失败！");		
		}
	}
	
	static protected function pg2tb($page)
	{
		$map=array("jour"=>"Journalpaper",
			"conf"=>"Conferencepaper",
			"software"=>"Softwareright",
			"patent"=>"Patent",
			"techreport"=>"Techreport",
			"project"=>"Project",
			"thesis"=>"Thesis");
		return $map[$page];
	}
	
	// 批量操作
	public function batch(){
		$tablename = $_GET['tablename'];
		$this->_batch($tablename);
	}
	
	// 指定显示那个页面 由参数showpage指定
	public function showpage()
	{
		// addjour addconf addpatent addsoftware
		// editjour editconf editpatent editsoftware
		$page = $_GET['sp'];// showpage
		$this->assign("dsp",$page);
		$this->display("Public:products");
	}
	
	public function addprod()
	{
		$tablename=$_GET["tablename"];
		if(!empty($_FILES)){
			$filesinfo= $this->_uploadmul("products",false,300,400,true);
		}
		foreach($filesinfo as $num=>$file)
		{
			$_POST[$file["key"]]=$file["savename"];
		}
		$M=M($tablename);
		if($M->Create())
		{
			if($M->add()){
				$this->assign("jumpUrl","__URL__");
				$this->success("添加成功！");
			}else{
				$this->error("添加失败！");
			}
		}
		else{
			$this->error($M->getError());
		}
		
	}
	
	// 将修改操作全部放在这里，通过POST中的表名变量来指明所要操作的表
	public function editprod()
	{
		$tablename=$_POST["tablename"];
		foreach ($_POST as $key => $value)
		{
			if($key != "tablename")
				$data[$key]=$value;
		}
		if(M($tablename)->save($data)){
			$this->success("修改成功！");
		}else{
			$this->error("资料无改变或修改失败！");		
		}
	}
	
}
?>