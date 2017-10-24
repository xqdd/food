<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class ContentModel extends ViewModel{
	public $viewFields = array(
	    /*'Classcontent' => array('cc_id','cc_class_id','cc_content_id'),
	    'Class' => array('cl_id'=>'cc_class_id','cl_name','_on'=>'Class.cl_id=Classcontent.cc_class_id'),*/
	    'Content' =>array('ct_id'=>'cc_content_id','ct_name','ct_teacher','ct_limit_num','ct_num','ct_seletctd_num',
	                      '_on'=>'Content.ct_id=Classcontent.cc_content_id'),
	);
	public function dealWithAdd(){
		/*$Dao = D('class');
		$listArray = $Dao->
		field('cl_name,cl_id')->select();
		return $listArray;*/
	}
	public function dealWithIndex(){
		$Model = M("Content");
		$count = $Model->count();
		$Page = new \Think\Page($count,15);
		$Page->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$Page->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
		$page    = $Page->show();// 分页显示输出
		//distinct选出唯一的id
		$arrayList = $Model->distinct(true)->field('ct_id,ct_name,ct_teacher,ct_limit_num,ct_num,ct_seletctd_num')->order('ct_teacher asc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$list[data] = $arrayList;
		$list[page] = $page;
		return $list;
	}
    public function dealWithIndex1($ct_id){
    	$Model = D("Content");
		//$map['cc_content_id'] = $ct_id;
		//$arrayList = $Model->field('cl_name,ct_name')->where($map)->select();
		$arrayList = $Model->field('ct_name')->select();
		//var_dump($arrayList);
		return $arrayList;
    }
	//通过视图来进行合并两张表的数据
	public function dealWithIndex2(){
		$Dao = D('class');
		$count = $Dao->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$Page->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
		$page    = $Page->show();// 分页显示输出
		$listArray = $Dao->
		field('cl_id,cl_num,cl_name,cl_faculty,fct_name')->limit($Page->firstRow.','.$Page->listRows)->select();
		$list[data] = $listArray;
		$list[page] = $page;
		return $list;
	}
}