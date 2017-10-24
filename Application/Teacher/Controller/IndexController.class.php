<?php
namespace Teacher\Controller;
use Think\Controller;
class IndexController extends BaseController {
	
    public function index(){
    	$map['ct_teacherAdmin'] = (int)session('tcSession')['mg_id'];
		$result = M('content')->where($map)->select();
		$sizeof1 =(12-sizeof($result));
		$this->assign('sizeof',$sizeof1);
    	$this->display();
    }

}