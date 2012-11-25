<?php

class ProductsAction extends BaseAction{
	
	public function index()
	{
		$this->display("Public:product");
	}
	
	public function prodlist(){
	
		$Products = D("Products");
		import("ORG.Util.Page");
		$count = $Products->count();
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
		$db_prefix = C("DB_PREFIX");
		$products = $Products->join($db_prefix.'categroy ON '.$db_prefix.'categroy.cid = '.$db_prefix.'products.cid')->where($map)->order('pid desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$cats = D("Categroy")->select();
		$this->assign('pages',$show);
		$this->assign("products",$products);
		$this->assign("cats",$cats);
	
		$this->display("Public:products");
	}
	public function add(){
		$cats = D("Categroy")->select();
		$this->assign("cats",$cats);
		$this->assign('uid',Session::get(C('USER_AUTH_KEY')));
		$this->assign("dsp","add");
		$this->display("Public:products");
	}
	public function adds(){
		$data = $_POST;
		if(!$data['cid']) $this->error("如果还没有产品分类，请先添加产品分类！");
		$Products = D("Products");
		if(!empty($_FILES['attachment']['name'])) $data['attachment'] = $this->_upload("Products",true,360,240,true);
		$data['parameters'] = nl2br($data['parameters']);
		$data['postdate'] = time();
		if($Products->Create()){
			if($Products->add($data)){
				$this->assign("jumpUrl","__URL__");
				$this->success("发布成功！");
			}else{
				//$this->error("发布失败！");
				echo $Products->getLastSql();
			}
		}else{
			$this->error($Products->getError());
		}
	}
	public function edit(){
		if($_GET['pid']){
			$products = D("Products")->getByPid($_GET['pid']);
			$cats = D("Categroy")->select();
			$this->assign("cats",$cats);
			$this->assign($products);
			$this->assign("dsp","edit");
			$this->display("Public:products");
		}else{
			$this->assign("jumpUrl","__URL__");
			$this->error("数据不存在！");
		}
	}
	public function edits(){
		$data = $_POST;
		$data['parameters'] = nl2br($data['parameters']);
		if(!empty($_FILES['attachment']['name'])) $data['attachment'] = $this->_upload("Products",true,360,240,true);
		$data['postdate'] = strtotime($_POST['postdate']);
		if(D("Products")->save($data)){
			$this->success("修改成功！");
		}else{
			$this->error("资料无改变或修改失败！");		
		}
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
	
	// add journal paper to database
	public function addjour()
	{
		$M=M("Journalpaper");
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
	

	// add conference paper to database
	public function addconf()
	{
		$M=M("Conferencepaper");
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

	// add patent to database
	public function addpatent()
	{
		$M=M("Patent");
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
	
	// add software copyright to database
	public function addright()
	{
		$M=M("Softwareright");
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
	
	// add  techreport to database
	public function addtechreport()
	{
		$M=M("Techreport");
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
	
	// add  inner report to database
	public function addinreport()
	{
		$M=M("Innerreport");
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
	
	// add thesis to database
	public function addthesis()
	{
		$M=M("Thesis");
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
	
	
	public function addprod()
	{
		$tablename=$_GET["tablename"];
		if(!empty($_FILES['photo']['name'])){
			$_POST['image1'] = $this->_upload("photo",false,300,400,true);
		}
		else{
			$_POST['image1'] = 'default.jpg';
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