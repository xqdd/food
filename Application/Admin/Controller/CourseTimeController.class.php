<?php
namespace Admin\Controller;
use  Think\Controller;
        //原创文章类
class CourseTimeController extends BaseController{
	public function index(){
		$list = D("date")->find('1');
		$this -> assign('list',$list);
		$this->display();
	}
	//修改选课时间
	public function add(){
		
		if (IS_POST) {
			
			$data['da_start_time'] = strtotime(I('dt_start_time'));
			$data['da_end_time'] = strtotime(I('dt_end_time'));
			//echo date('Y-m-d H:i',strtotime(I('dt_start_time')));
			$map['da_id'] = 1;
			$Dao = D('date')->where($map)->save($data);
			if($Dao){
				$this->redirect('CourseTime/index');
			}else{
				$this->error('修改失败');
			}
			return;
		}
		$list = D("date")->find('1');
		$this -> assign('list',$list);
		$this->display();
	}
}