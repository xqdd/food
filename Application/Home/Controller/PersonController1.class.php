<?php
namespace Home\Controller;
use Think\Controller;
class PersonController extends Controller {
    public function index(){
		$map = $_SESSION['sdSession']['sd_id'];
		//获取公告的id或名字
		$announce = M('announce')->field('an_id,an_title')->select();
		$this->assign('announce',$announce);
		if(I('marks')){ 
			$this->assign('marks',I('marks'));
			$this->assign('pwd',I('pwd'));
		}
    	$Model = new \Home\Model\PersonModel();
		$listArray = $Model->dealWithIndex($map);
        //dump($listArray);
		$this->assign('listArray',$listArray);
    	$this->display();
    }
	public function delete(){
/*		echo I('get.content_id');
*/		$map['sc_content_id'] = I('get.content_id');
		$map['sc_student_id'] = $_SESSION['sdSession']['sd_id'];
		$map1['ct_id'] = I('get.content_id');
		$Dao = D('studentcontent')->where($map)->delete();
        if($Dao){
        	if(D('content')->where($map1)->setDec('ct_seletctd_num',1)){
        		$this->redirect('Person/index');
        	}
        }else{
        	$this->error("退选失败");
        }
	}
	public function selectContent(){
		$map = $_SESSION['sdSession']['sd_id'];	
		//找到班级id
		//$mapClass['cl_name'] = $_SESSION['sdSession']['sd_class'];
		//$class = M('class')->field('cl_id')->where($mapClass)->find();
		$contentId = I('content_id');

		//$flag查找是该班级是否有对应的课题
		/*$mapCC['cc_class_id'] = $class['cl_id'];
		$mapCC['cc_content_id'] = $contentId;*/
		$mapContent['ct_id'] = $contentId;
		$mapSC['sc_content_id'] = $contentId;
		$mapSC['sc_student_id'] = $map;
		
		//$flag = M('classcontent')->field('cc_id')->where($mapCC)->find();
		
		$flag1 = M('studentcontent')->field('sc_id')->where($mapSC)->find();
		
		//if($flag){
			if(!$flag1){
				   $data['sc_student_id'] = $map;
				   $data['sc_content_id'] = $contentId;
				    if(M('studentcontent')->add($data)){
					if(D('content')->where($mapContent)->setInc('ct_seletctd_num',1)){
						echo "<script>alert('选课成功')</script>";
					}else{
						echo "<script>alert('选课失败')</script>";
					}
				   }
			}
		/*}else{
			$this->error('该班不能选这门课');
			return;
		}*/
    	$Model = new \Home\Model\PersonModel();
		$listArray = $Model->dealWithIndex($map);
		
		$this->assign('listArray',$listArray);
		$this->display('index');
	}
    public function resetPwd(){
    	$mapId['sd_id'] = $_SESSION['sdSession']['sd_id'];	
    	$model = M('student');
    	$data['sd_pwd'] = I('newPwd');
		$map['sd_pwd'] = $oldPwd = I('oldPwd');
		if($model->field('sd_id')->where($map)->find()){
			if($model->where($mapId)->save($data)){
				$this->redirect('Person/index',array('marks'=>'1111','pwd'=>I('newPwd')));
			}else{
				$this->redirect('Person/index',array('marks'=>'00000'));
			}
		}else{
			$this->redirect('Person/index',array('marks'=>'0000'));
		}
    }
	public function resetPhone(){
		$mapId['sd_id'] = $_SESSION['sdSession']['sd_id'];	
    	$model = M('student');
    	$data['sd_phone'] = I('sd_phone');
			if($model->where($mapId)->save($data)){
				$_SESSION['sdSession']['sd_phone'] = $data['sd_phone'];
				$this->redirect('Person/index');
			}else{
				$this->redirect('Person/index');
			}
	}
}