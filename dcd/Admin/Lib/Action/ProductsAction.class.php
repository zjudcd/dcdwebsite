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
		$M = $M->where($map)->order('submittime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('pages',$show);
		$this->assign("product",$M);
		$this->assign("dsp",$sp);
		$this->display("Public:products");
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
	
	static protected function tb2type($tablename)
	{
		$map=array(
			"Journalpaper"=>"期刊论文",
			"Conferencepaper"=>"会议论文",
			"Softwareright"=>"软件",
			"Patent"=>"专利",
			"Techreport"=>"技术报告",
			"Project"=>"科研项目",
			"Thesis"=>"毕业论文"
		);
		if(array_key_exists($tablename,$map))
			return $map[$tablename];
		else
			return "未知";
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
		$addpage=array("addjour","addconf","addpatent","addsoftware","addtr");
		if(in_array($page,$addpage))
		{
			// 作者选择下拉框的数据
			$person=M("Person")->order("name")->select();
			$this->assign("persons",$person);
		}
		$this->assign("dsp",$page);
		$this->display("Public:products");
	}
	
	public function addprod()
	{
		$tablename=$_GET["tablename"];
		if(!empty($_FILES)){
			$filesinfo= $this->_uploadmul("products",false,300,400,true);// 附件存储在Attachments/products目录下
		}
		
		foreach($filesinfo as $num=>$file)
		{
			$_POST[$file["key"]]=$file["savename"];
		}
		$_POST["submittime"]=time();
		for($i=1;$i<=6;$i++)
		{
			$var = sprintf("author%d",$i);
			if(!empty($_POST[$var]) && $_POST[$var]!="other")
			{
				$author[$_POST[$var]]=$i;//$_POST[$var]是作者id，是第$i作者
			}
		}
		//print_r($author);
		//print_r($_POST);//debug
		//return;
		$M=M($tablename);
		if($M->Create())
		{
			$M->startTrans();// 启动事务
			$success = true;
			if(($id=$M->add())!= false){
				$Product=M("Products");//在成果表里将该成果的作者与成果关联起来
				//$Product->startTrans(); //可能要添加多条记录，确保都添加成功或失败
				$Person=M("Person");
				foreach($author as $userid=>$number)
				{
					$record["personid"]=$userid;
					$cond["personid"]=$userid;
					$pinfo=$Person->where($cond)->find();// 根据id查找作者更多信息
					if($pinfo)
					{
						$record["personid"]=$userid;
						$record["personname"]=$pinfo["name"];
						$record["persontype"]=$pinfo["category"];
						$record["productid"]=$id;
						$record["producttype"]=$this->tb2type($tablename);
						$record["number"]=$number;
						if($Product->add($record)==false)
						{
							$success = false;
							break;//break foreach
						}
					}
				}
				if($success)
				{
					//$Product->commit();
					$M->commit();//提交事务
					$this->assign("jumpUrl","__URL__");
					$this->success("添加成功！");
				}
				else
				{
					//$Product->rollback();
					$M->rollback();
					$this->error("添加失败！原因：操作成果总表失败！");
				}
			}else{
				$M->rollback();
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