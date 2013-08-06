<?php

class ProductsAction extends BaseAction{
	
	public function index()
	{
		$this->assign(menu,"Products");
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
		$products = $M->where($map)->order('submittime desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign(menu,"Products");
		$this->assign('pages',$show);
		$this->assign("product",$products);
		$this->assign("dsp",$sp);
		$this->display("Public:products");
	}
	
	// 代表性成果
	public function typical()
	{
		$cond["istypical"] = 1;
		// 代表性 期刊论文
		$Jour = M("Journalpaper")->where($cond)->select();
		$this->assign("tjour",$Jour);
		// 代表性 会议论文
		$Conf = M("Conferencepaper")->where($cond)->select();
		$this->assign("tconf",$Conf);
		
		$this->assign("dsp","typical");
		
		// 代表性 项目
		$this->display("Public:products");
		// 
	}
	
	static protected function tb2pg($tb)
	{
		$map=array("Journalpaper"=>"jour",
			"Conferencepaper"=>"conf",
			"Softwareright"=>"software",
			"Patent"=>"patent",
			"Techreport"=>"techreport",
			"Project"=>"project",
			"Thesis"=>"thesis");
		return $map[$tb];
	}
	
	static protected function pg2tb($page)
	{
		$map=array("jour"=>"Journalpaper",
			"conf"=>"Conferencepaper",
			"software"=>"Softwareright",
			"patent"=>"Patent",
			"techreport"=>"Techreport",
			"project"=>"Project",
			"thesis"=>"Thesis",
			"editjour"=>"Journalpaper",
			"editconf"=>"Conferencepaper",
			"editsw"=>"Softwareright",
			"editpatent"=>"Patent",
			"edittr"=>"Techreport",
			"editproj"=>"Project",
			"editthesis"=>"Thesis");
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
		$addpage=array("addjour","addconf","addpatent","addsw","addtr","addproj","addthesis");
		$editpage=array("editjour","editconf","editpatent","editsw","edittr","editthesis","editproj");
		if(in_array($page,$addpage) || in_array($page,$editpage))
		{
			// 作者选择下拉框的数据
			$person=M("Person")->order("personid")->select();
			$this->assign("persons",$person);
		}
		if($page == "addproj" || $page=="editproj")
		{
			$types=M("Projecttype")->order("id")->select();
			$this->assign("types",$types);
		}
		if(in_array($page,$editpage))
		{
			// 编辑页面的填充数据
			$tablename=$this->pg2tb($page);
			$cond["id"]=$_GET["id"];
			$product=M($tablename)->where($cond)->select();
			$P=M("Products");// 查询相关作者
			$pcond["productid"]=$cond["id"];
			$pcond["producttype"]=$this->tb2type($tablename);
			$fields=array("personid","number");
			$authors=$P->where($pcond)->order("number")->select($fields);
			$nums=array();
			foreach($authors as $key=>$author)
			{
				$nums[]=$author["number"];
				$name=sprintf("author%d",$author["number"]);
				$pub = sprintf("ispublic%d",$author["number"]);
				$this->assign($name,$author["personid"]);
				$this->assign($pub,$author["ispublic"]);
			}
			for($i=1;$i<=6;++$i)
			{
				if(!in_array($i,$nums))
				{
					$name = sprintf("author%d",$i);
					$this->assign($name,"other");// 默认选择作者other
					$pub = sprintf("ispublic%d",$i); // public 选项
					$this->assign($pub,0); // 
				}
			}
			$this->assign("product",$product[0]);
		}
		$this->assign("dsp",$page);
		$this->assign(menu,"Products");
		$this->display("Public:products");
	}
	
	public function addprod()
	{
		$tablename=$_GET["tablename"];
		$sp=$this->tb2pg($tablename);
		if(!empty($_FILES["image1"]["name"]) || !empty($_FILES["official"]["name"]) || !empty($_FILES["draft"]["name"])){
			$filesinfo= $this->_uploadmul("products",false,300,400,true);// 附件存储在Attachments/products目录下
		}
		
        if(empty($_FILES["image1"]["name"]))
        {
            $_POST["image1"] = "default.jpg";
        }
        
		foreach($filesinfo as $num=>$file)
		{
			$_POST[$file["key"]]=$file["savename"];
		}
		$_POST["submittime"]=time();
		for($i=1;$i<=6;$i++)
		{
			$var = sprintf("author%d",$i);
			$varpub = sprintf("ispublic%d",$i); //是否展现在个人主页
			if(!empty($_POST[$var]) && $_POST[$var]!="other")
			{
				$author[$_POST[$var]]=$i;//$_POST[$var]是作者id，是第$i作者
				if(isset($_POST[$varpub]))
				{
					$public[$_POST[$var]] = 1;// 该作者要展现该成果
				}
			}
		}
		if(isset($_POST["personid"]))
		{
			//说明提交的是毕业论文
			$author[$_POST["personid"]]=1;//
			$cond["personid"]=$_POST["personid"];
			$name=M("Person")->where($cond)->getField("name");
			$_POST["name"]=$name;
		}
		if(isset($_POST["typeid"]))
		{
			// 添加项目
			$ptcond["id"]=$_POST["typeid"];
			$typename=M("Projecttype")->where($ptcond)->getField("name");
			$_POST["typename"]=$typename;
		}
		$M=M($tablename);
		if($M->Create())
		{
			$M->startTrans();// 启动事务
			$success = true;
			if(($id=$M->add())!= false){
				$Product=M("Products");//在成果表里将该成果的作者与成果关联起来
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
						if(array_key_exists($userid,$public))
						{
							$record["ispublic"] = 1;
						}
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
					$jmpUrl="__URL__/prodlist/sp/".$sp;
					$this->assign("jumpUrl",$jmpUrl);
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
	
	// 将修改操作全部放在这里，通过GET中的表名变量来指明所要操作的表
	// 尼玛 这代码需要重构啊，但是没钱，谁去弄他- -
	public function editprod()
	{
		$tablename=$_GET["tablename"];
		$sp=$this->tb2pg($tablename);
		$id=$_GET["id"];
		$type=$this->tb2type($tablename);
		$_POST["id"]=$id;
		if(!empty($_FILES["image1"]["name"]) || !empty($_FILES["official"]["name"]) || !empty($_FILES["draft"]["name"])){
			$filesinfo= $this->_uploadmul("products",false,300,400,true);// 附件存储在Attachments/products目录下
		}
		
		foreach($filesinfo as $num=>$file)
		{
			$_POST[$file["key"]]=$file["savename"];
		}
		//$_POST["submittime"]=time();
		for($i=1;$i<=6;$i++)
		{
			$var = sprintf("author%d",$i);
			$varpub = sprintf("ispublic%d",$i); //是否展现在个人主页
			if(!empty($_POST[$var]) && $_POST[$var]!="other")
			{
				$author[$_POST[$var]]=$i;//$_POST[$var]是作者id，是第$i作者
				if(isset($_POST[$varpub]))
				{
					$public[$_POST[$var]] = 1;// 该作者要展现该成果
				}
			}
		}
		if(isset($_POST["personid"]))
		{
			//说明提交的是毕业论文 或者项目
			$author[$_POST["personid"]]=1;//
			$cond["personid"]=$_POST["personid"];
			$name=M("Person")->where($cond)->getField("name");
			$_POST["name"]=$name;
		}
		if(isset($_POST["typeid"]))
		{
			// 添加项目
			$ptcond["id"]=$_POST["typeid"];
			$typename=M("Projecttype")->where($ptcond)->getField("name");
			$_POST["typename"]=$typename;
		}
		$M=M($tablename);
		$M->startTrans();// 启动事务
		$success = true;
		if(!(($n=$M->save($_POST))=== false)){ // 这里要严格比较，因为如果成果资料本身无修改，save返回值为0
			$Product=M("Products");//在成果表里将该成果的作者与成果关联起来
			$acond["productid"]=$id;
			$acond["producttype"]=$type;
			$fields=array("personid","number");
			$dbauthor=$Product->where($acond)->order("number")->select($fields);
			$indb=array();//记录已经在数据库的作者
			foreach($dbauthor as $n=>$au)
			{
				// 检查作者变化
				// 原先有现在没有的删除
				// 原先有，现在次序改变的，更新
				// 原先没有的，添加
				$personid=$au["personid"];
				$number=$au["number"];
				if(array_key_exists($personid,$author))
				{
					$indb[]=$personid;
					if(array_key_exists($personid,$public))
					{
						$au["ispublic"] = 1;
					}
					else
					{
						$au["ispublic"] = 0; // 修改成不显示
					}
					$au["number"]=$author[$personid];
					$Product->save($au);
				}
				else
				{
					$acond["personid"]=$personid;
					$Product->where($acond)->delete();//该作者不在
				}
			}
			
			$Person=M("Person");
			foreach($author as $userid=>$number)
			{
				if(in_array($userid,$indb))
					continue;// 只要那些新增的作者才需要重新插入记录
				$record["personid"]=$userid;
				$cond["personid"]=$userid;
				$pinfo=$Person->where($cond)->find();// 根据id查找作者更多信息
				if($pinfo)
				{
					$record["personid"]=$userid;
					$record["personname"]=$pinfo["name"];
					$record["persontype"]=$pinfo["category"];
					$record["productid"]=$id;
					$record["producttype"]=$type;
					$record["number"]=$number;
					if(array_key_exists($userid,$public))
					{
						$record["ispublic"] = 1;
					}
					else
					{	
						$record["ispublic"] = 0;
					}
					if($Product->add($record)==false)
					{
						$success = false;
						break;//break foreach
					}
				}
			}
			if($success)
			{
				$M->commit();//提交事务
				$jmpUrl="__URL__/prodlist/sp/".$sp;
				$this->assign("jumpUrl",$jmpUrl);
				$this->success("修改成功！");
			}
			else
			{
				$M->rollback();
				$this->error("更新失败！原因：操作成果总表失败！");
			}
		}else{
			$M->rollback();
			$this->error("成果资料未改动");
		}
	}
	
	public function delete()
	{
		$tablename=$_GET["tablename"];
		$id=$_GET["id"];// 成果id，在tablename中是唯一的，但是在products表中还需要成果类型才能唯一确定某个成果
		$success=false;
		$M=M($tablename);
		$M->startTrans();// 开始事务
		$P=M("Products");// 成果人员对应表也要删除相应记录
		$type=$this->tb2type($tablename);
		$pcond["productid"]=$id;
		$pcond["producttype"]=$type;
		if($P->where($pcond)->delete()==false)
		{
			$success=false;
			$msg="删除成果人员对应表失败！";
		}
		else
		{
			$cond["id"]=$id;
			if($M->where($cond)->delete())
			{
				$success=true;
			}
			else
			{
				$success=false;
				$msg="删除成果失败！";
			}
		}
		if($success)
		{
			$M->commit();
			$msg="删除成功！";
			$this->success($msg);
		}
		else
		{
			$M->rollback();
			$this->error($msg);
		}
		
	}
	
}
?>