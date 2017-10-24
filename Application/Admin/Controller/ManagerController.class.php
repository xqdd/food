<?php
namespace Admin\Controller;
use Think\Controller;
date_default_timezone_set('PRC'); //东八时区 
class ManagerController extends BaseController {
	//显示邮件列表
	public function index(){
		$Model = new \Admin\Model\ManagerModel();
        $list = $Model->dealWith();
		$this->assign('list',$list);
		$this->assign('whatNum',0);
		$this->display();
	}	
	public function index1(){
		$Model = new \Admin\Model\ManagerModel();
        $list = $Model->dealWith1();
		$this->assign('list',$list);
		$this->assign('whatNum',1);
		$this->display(index);
	}
	public function index2(){
		$Model = new \Admin\Model\ManagerModel();
        $list = $Model->dealWith2();
		$this->assign('list',$list);
		$this->assign('whatNum',2);
		$this->display(index);
	}
	public function add(){
		$mg_sign = I('get.mg_sign');
		if (IS_POST) {
			$data['mg_name'] = I('mg_name');
			$data['mg_pwd'] = I('mg_pwd');
			$data['mg_sign'] = $mg_sign;
			$ManagerModel = D('Manager');
			if ($ManagerModel->create($data)) {
				if ($ManagerModel->add()) {
					if($mg_sign == 1){
					$this->success('添加成功',U('index1'),1);
					}else if($mg_sign == 2){
					$this->success('添加成功',U('index2'),1);
					}else{
					$this->success('添加成功',U('index'),1);	
					}
				} else {
					$this->error('添加失败');
				}
			} else {
				$this->error($ManagerModel->getError());
			}

			return;
		} 
		$this->display();
	}
	 
	
	public function delete(){
		$id = $_GET['valueDel'];
		$admin_now = session('admin');
        if($id == $admin_now['mg_id']){
        	$this->ajaxReturn(2);
        }else if(M('manager')->delete($id)){
        	$this->ajaxReturn(1);
        }else{
        	$this->ajaxReturn(0);
        }
	}
}