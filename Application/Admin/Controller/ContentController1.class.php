<?php
namespace Admin\Controller;
use Think\Controller;
        //课程内容类
class ContentController extends BaseController {
    public function index(){
    	$Model = new \Admin\Model\ContentModel();
    	$list = $Model->dealWithIndex();
    	$this->assign('arrayList',$list['data']);
		//var_dump($list['page']);
		$this->assign('page',$list['page']);
    	$this->display();
    }
	public function index1(){
		$ct_id = I('get.ct_id');
    	$Model = new \Admin\Model\ContentModel();
    	$list = $Model->dealWithIndex1($ct_id);
    	$this->assign('arrayList',$list);
    	$this->display();
    }
    	//添加课题内容
	public function add(){
		$Dao = D('content');
		$class = $Dao->dealWithAdd();
		$this->assign('class',$class);
		if (IS_POST) {
			$data['ct_name'] = I('ct_name');
			$data['ct_teacher'] = I('ct_teacher');
			$data['ct_limit_num'] = I('ct_limit_num');		
			$data['ct_num'] = I('ct_num');
			$Dao1 = M('content');
			//添加成功的话会自动返回添加哪一行的id号$contentId
				if ($contentId = $Dao1 -> add($data)) {
					/*for($i = 0; $i < sizeof($_POST['checkboxWho']); $i++){
						//批量写入Classcontent
						$dataList[] = array('cc_class_id'=>$_POST['checkboxWho'][$i],'cc_content_id'=>$contentId);
					}//批量写入Classcontent
					if(M('classcontent')->addAll($dataList)){
						$this -> success('添加成功', U('index'), 1);
					}else{
						$this -> error('添加失败');
					}*/		
					$this -> success('添加成功', U('index'), 1);		
				} else {
					$this -> error('添加失败');
				}
				
			return;
		}
		
		$this->display();
	}

	public function delete(){
		$Model = new \Admin\Model\ContentModel();
    	$list = $Model->dealWithIndex();
    	$this->assign('arrayList',$list['data']);
		$this->assign('page',$list['page']);
		//var_dump($list['data']);
    	$this->display();
	}
	
	public function deleteAll(){
		if(I('deleteAll')== '999'){
			M('studentcontent')->where(1)->delete();
                       // M('content')->where(1)->delete();
		}
		$this->display('delete');
	}
	
	public function deleteIndex(){
		$id = $_GET['valueDel'];
		/*$map['cc_content_id'] = $id;
		$flag = M('classcontent')->where($map)->delete();*/
		/*if($flag){
			if(M('content')->delete($id)){
				$this->ajaxReturn("1");
			}else{
				$this->ajaxReturn("0");
			}
		}else{
			$this->ajaxReturn("0");
		}*/
		if(M('content')->delete($id)){
				$this->ajaxReturn("1");
			}else{
				$this->ajaxReturn("0");
			}
	}
	public function showByID(){
		$ct_id = I('get.ct_id');
		$modal = M('content');
		$map['ct_id'] = $ct_id;
		$result = $modal->where($map)->select();
		$this->assign('result',$result); 
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
/*		$Model = new \Admin\Model\SCModel();
    	$list = $Model->search($studentMap);
*/		$list = M('Content')->where($studentMap)->select();
		//dump($list);
    	$this->assign('arrayList',$list);
		
		$Model = new \Admin\Model\ContentModel();
    	$list = $Model->dealWithIndex();
    	$this->assign('arrayList',$list['data']);
		
    	$this->display('index');
	}
}