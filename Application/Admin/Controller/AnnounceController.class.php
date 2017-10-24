<?php
namespace Admin\Controller;
use  Think\Controller;
        //原创文章类
class AnnounceController extends BaseController{
	public function index(){
		$Model = D("announce");
		$count = $Model->count();
		$p=new \Think\Page($count,20);
	    $p->lastSuffix=false;
	    $p->setConfig('header','<div>共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>15</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
	    $p->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$p->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
	    $p->setConfig('last','末页');
	    $p->setConfig('first','首页');
	    $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$page    = $p->show();// 分页显示输出
		//distinct选出唯一的id
		$arrayList = $Model->distinct(true)->field('an_title,an_summary,an_create_time,an_id')->limit($p->firstRow.','.$p->listRows)->select();
		$this -> assign('arrayList',$arrayList);
		$this -> assign('page',$page);
		$this -> assign('p',I('p')?I('p'):1);
		$this->display();
	}
	public function add(){
		if (IS_POST) {
			$data['an_title'] = I('an_title');
			$data['an_author'] = I('an_author');
			$data['an_summary'] = I('an_summary');
			$data['an_create_time'] = time();
			$data['an_status'] = I('an_status');
			$data['an_content'] = I('an_content','',false);//不转码保留原来的html	
			//调用模型完成入库
			$Dao = D('announce');
				if($Dao->add($data)){
				$this->success("添加成功",U('add'),1);
			}else{
				$this->success('添加失败',U('add'),1);
			}
			return;
		}
		$this->display();
	}
    public function edit(){
		$singleID = I('get.singleID');
		if (IS_POST) {
			$data['an_id'] = I('an_id');
			$data['an_title'] = I('an_title');
			$data['an_author'] = I('an_author');
			$data['an_summary'] = I('an_summary');
			$data['an_create_time'] = time();
			$data['an_content'] = I('an_content','',false);//不转码保留原来的html
			
			//调用模型完成入库
			$Dao = D('announce');
			if($Dao->save($data)){
				$this->success("修改成功",U('index'),1);
			}else{
				$this->error();
			}		
			return;
		}
		$list = D('announce')->find($singleID);
		$this->assign('list',$list);
		$this->display();
	}
	public function delete(){
		$Model = D("announce");
		$count = $Model->count();
		$p=new \Think\Page($count,20);
	    $p->lastSuffix=false;
	    $p->setConfig('header','<div>共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>15</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
	    $p->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$p->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
	    $p->setConfig('last','末页');
	    $p->setConfig('first','首页');
	    $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$page    = $p->show();// 分页显示输出
		//distinct选出唯一的id
		$arrayList = $Model->distinct(true)->field('an_title,an_summary,an_create_time,an_id')->limit($p->firstRow.','.$p->listRows)->select();
		$this -> assign('arrayList',$arrayList);
		$this -> assign('page',$page);
		$this -> assign('p',I('p')?I('p'):1);
		$this->display();
	}
    public function deleteSingle(){
    	$singleID = I('singleID');
		if (M('announce')->delete($singleID)) {
			$this->success('删除成功',U('delete'),1);
		} else {
			$this->error('删除失败');
		}
    }
}