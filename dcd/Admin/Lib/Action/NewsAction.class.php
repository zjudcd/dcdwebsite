<?php
class NewsAction extends BaseAction{
	public function index(){
		$News = D("News");
		// 分页
		import("ORG.Util.Page");
		if($_POST['keyword']){
			$kmap = $_POST['keyword'];
			$map['title'] = array('like','%'.$kmap.'%');
		}else if($_GET['keyword']){
			$kmap = $_GET['keyword'];
			$map['title'] = array('like','%'.$kmap.'%');
		}
		$count = $News->where($map)->count();
		$Page = new Page($count,20);
		$Page -> parameter .= "keyword=".urlencode($kmap)."&";
		$show = $Page->show();
		$news = $News->where($map)->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('pages',$show);
		$this->assign("news",$news);
		$this->display("Public:news");
	}
	public function add(){
		$newstype = M("Newstype");
		$types= $newstype->order('id')->select();
		$this->assign("types",$types);
		$this->assign("dsp","add");
		$this->display("Public:news");
	}
	public function adds(){
		$News = D("News");
		if($News->Create()){
			if($News->add()){
				$this->assign("jumpUrl","__URL__");
				$this->success("发布成功！");
			}else{
				$this->error("发布失败！");
			}
		}else{
			$this->error($News->getError());
		}
	}
	public function edit(){
		if($_GET["newsid"]){
			$cond["id"]=$_GET["newsid"];
			$news = D("News")->where($cond)->select();
			$this->assign($news[0]);
			
			$newstype = M("Newstype");
			$types= $newstype->order('id')->select();
			$this->assign("types",$types);
			
			$this->assign("dsp","edit");
			$this->display("Public:news");
		}else{
			$this->assign("jumpUrl","__URL__");
			$this->error("数据不存在！");
		}
	}
	public function edits(){
		$data = $_POST;
		if(D("News")->save($data)){
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
