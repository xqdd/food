<?php
namespace Admin\Controller;
use Think\Controller;
//课程内容类
class SCController extends BaseController {
    public function index(){
    	$Model = new \Admin\Model\SCModel();
    	$list = $Model->dealWithIndex();
    	$this->assign('arrayList',$list['data']);
		$this->assign('page',$list['page']);
    	$this->display();
    }
	//导出excel
	public function expExcel(){
		$Model = new \Admin\Model\SCModel();
    	$Model->expUser();
	}
	public function search(){
		$keyword1 = I('ct_teacher');
		$keyword2 = I('sd_class');
		$keyword3 = I('sd_num');
	    if($keyword1 != ''){
	    	$studentMap['ct_teacher'] = array (
				'like',
				"%{$keyword1}%" 
		);
		$this->assign('marksContent',marksContent);
	    }
		if($keyword2 != ''){
			$studentMap['sd_class'] = array (
				'like',
				"%{$keyword2}%" 
		);
		$this->assign('marksContent',marksClass);
		}
		if($keyword3 != ''){
			$studentMap['sd_num'] = array (
				'like',
				"%{$keyword3}%" 
		);
		$this->assign('marksContent',marksNum);
		}
		
		$Model = new \Admin\Model\SCModel();
    	$list = $Model->search($studentMap);
    	$this->assign('arrayList',$list);
		$this->assign('num',sizeof($list));
    	$this->display('index');
	}
}