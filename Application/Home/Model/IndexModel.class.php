<?php
namespace Home\Model;
use Think\Model\ViewModel;
class IndexModel extends ViewModel{
	public $viewFields = array(
	    'Classcontent' => array('cc_id','cc_class_id','cc_content_id'),
	    'Class' => array('cl_id'=>'cc_class_id','cl_name','_on'=>'Class.cl_id=Classcontent.cc_class_id'),
	    'Content' =>array('ct_id'=>'cc_content_id','ct_lab','ct_name','ct_teacher','ct_limit_num','ct_num','ct_seletctd_num','ct_gongzuoliang','ct_nandu',
	                      '_on'=>'Content.ct_id=Classcontent.cc_content_id'),
	);
	public function dealWithIndex(){
		$Model = D("Content");
		$count = $Model->count();
		$Page = new \Think\Page($count,20);
		$Page->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$Page->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
		$page  = $Page->show();// 分页显示输出
		
		$map['sc_student_id'] = $_SESSION['sdSession']['sd_id'];
		$Model1 = D('studentcontent');
		$howlong = null;
		$howlong = $Model1->where($map)->select();
		//dump($howlong);
		$list[length] = count($howlong);
		
		//$map1['ct_faculty'] = $_SESSION['sdSession']['sd_professional'];
		//distinct选出唯一的id
		//$arrayList = $Model->where($map1)->field('ct_id,ct_gongzuoliang,ct_nandu,ct_lab,ct_name,ct_teacher,ct_limit_num,ct_num,ct_seletctd_num')->order('ct_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$arrayList = $Model->field('ct_id,ct_gongzuoliang,ct_nandu,ct_lab,ct_name,ct_teacher,ct_limit_num,ct_num,ct_seletctd_num')->order('ct_id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$list[data] = $arrayList;
		$list[page] = $page;
		return $list;
	}
}