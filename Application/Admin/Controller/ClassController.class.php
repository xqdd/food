<?php
namespace Admin\Controller;
use Think\Controller;
//选课班级管理
class  ClassController extends BaseController {
    public function index(){
    	$D = D('class');
    	$array = $D->dealWithIndex();	
		$this->assign('class',$array['data']);
		$this->assign('page',$array['page']);
    	$this->display();
    }
	public function add(){
		if(IS_POST) {
		    $data['cl_name'] = I('cl_name');
			$data['cl_faculty'] = I('cl_faculty');
			$data['cl_num'] = I('cl_num');
			$Dao = M('class');
				if ($Dao->add($data)) {
					$this->success('添加成功',U('index'),1);
				} else {
					$this->error('添加失败');
				}
			
			return;
		}
		$Dao = D('class')->dealWith();	
		$this->assign('faculty',$Dao);	 
		$this->display();
	}
	public function delete(){
		$D = D('class');
    	$array = $D->dealWithIndex();	
		$this->assign('class',$array['data']);
		$this->assign('page',$array['page']);
    	$this->display();
	}
	public function deleteIndex(){
		$id = $_GET['valueDel'];
		$Nowpic = M('class')->find($id);
		if (M('class')->delete($id)) {
			$this->ajaxReturn(1);
		} else {
			$this->ajaxReturn(0);
		}
	}
}