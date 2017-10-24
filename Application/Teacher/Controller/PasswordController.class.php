<?php
namespace Teacher\Controller;
use Think\Controller;
class PasswordController extends BaseController {
    public function index(){
    	//dump($_SESSION['tcSession']);
    	$this->assign('use',$_SESSION['tcSession']);
    	$this->display();
    }
    public function alert(){
    	$map['mg_id'] = $_SESSION['tcSession']['mg_id'];
    	$data['mg_pwd'] = I('mg_pwd');
    	$User = M('manager');
    	$flag = $User->where($map)->data($data)->save(); // 根据条件保存修改的数据
    	/*dump($map);
    	echo $flag;*/
    	if($flag == 1){
    		$_SESSION['tcSession']['mg_pwd'] =	I('mg_pwd');
			$this->success('修改成功', U('index'), 1);	
			
				} 
				else {
			$this -> error('添加失败');
    	}
    }
}