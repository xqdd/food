<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {
	public function publicFun(){
		//获取时间
		$date = D("date")->find('1');
		$this -> assign('date',$date);
		
		//获取公告的id或名字
		$announce = M('announce')->field('an_id,an_title')->select();
		$this->assign('announce',$announce);
        //获取课程内容
    	$Model = new \Home\Model\IndexModel();
    	$list = $Model->dealWithIndex();
    	$this->assign('arrayList',$list['data']);
		$this->assign ( 'p', I( 'p' ) ? I( 'p' ) : 1 );
		$this->assign('page',$list['page']);
		$this->assign('length',$list['length']);
	}
    public function index(){
    	$this->publicFun();
    	$this->display();
    }
	public function announce(){
		//获取时间
		$date = D("date")->find('1');
		$this -> assign('date',$date);
		//获取公告的id或名字
		$announce = M('announce')->field('an_id,an_title')->select();
		$this->assign('announce',$announce);
		$an_id = I('an_id');
		$list = M('announce')->find($an_id);
		$this->assign('list',$list);
		$this->display();
	}
	
	public function search(){
		$keyword1 = I('ct_teacher');
		
	    if($keyword1 != ''){
	    	$studentMap['ct_teacher'] = array (
				'like',
				"%{$keyword1}%" 
		);
	    }
		$list = M('Content')->field('ct_name,ct_teacher,ct_nandu,ct_gongzuoliang,ct_lab,ct_seletctd_num,ct_id')->where($studentMap)->select();
		//dump($list);
    	$this->assign('arrayList',$list);
		//获取时间
		$date = D("date")->find('1');
		$this -> assign('date',$date);
		
	  $map['sc_student_id'] = $_SESSION['sdSession']['sd_id'];
        $Model1 = D('studentcontent');
        $howlong = null;
        $howlong = $Model1->where($map)->select();
        //dump($howlong);
        $list[length] = count($howlong);
	 $this->assign('length',$list['length']);

    	$this->display('index');
	}
}
