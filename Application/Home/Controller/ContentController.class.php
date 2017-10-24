<?php
namespace Home\Controller;
use Think\Controller;
        //课程内容类
class ContentController extends BaseController {

	public function index(){
		//获取时间
		$date = D("date")->find('1');
		$this -> assign('date',$date);
		
		$ct_id = I('get.ct_id');
		$modal = M('content');
		$map['ct_id'] = $ct_id;
		$result = $modal->where($map)->select();
		$this->assign('result',$result); 
		//dump($result);
		$this->display();
	}

}