<?php
class ProductsAction extends BaseAction{
	public function index(){
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
	public function batch(){
		$this->_batch();
	} 
}
?>