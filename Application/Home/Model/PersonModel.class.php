<?php
namespace Home\Model;
use Think\Model\ViewModel;
class PersonModel extends ViewModel{
	public $viewFields = array(
	    'Studentcontent' => array('sc_id','sc_student_id','sc_content_id'),
	    'Content' =>array('ct_id','ct_name','ct_lab','ct_teacher','ct_phone','ct_limit_num','ct_num','ct_seletctd_num',
	                      '_on'=>'Content.ct_id=Studentcontent.sc_content_id'),
	);
	public function dealWithIndex($mapStr){
		$map['sc_student_id'] = $mapStr;
		$Model = D("Person");
		//distinct选出唯一的id
		$arrayList = $Model->field('ct_id,sc_content_id,ct_lab,ct_phone,ct_name,ct_teacher,ct_limit_num,ct_num,ct_seletctd_num')->where($map)->select();
		return $arrayList;
	}
}