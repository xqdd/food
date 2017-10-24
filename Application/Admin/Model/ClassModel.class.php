<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class ClassModel extends ViewModel{
	public $viewFields = array(
	    'Class' => array('cl_id','cl_num','cl_name','cl_faculty'),
		'Faculty' => array('fct_id','fct_name','_on'=>'Class.cl_faculty=Faculty.fct_id'),
	);
	public function dealWith(){
		$Dao = M('faculty');
		$list = $Dao->select();
		return $list;
	}
	//通过视图来进行合并两张表的数据
	public function dealWithIndex(){
		$Dao = D('class');
		$count = $Dao->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$Page->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
		$page    = $Page->show();// 分页显示输出
		$listArray = $Dao->
		field('cl_id,cl_num,cl_name,cl_faculty,fct_name')->limit($Page->firstRow.','.$Page->listRows)->order('cl_name')->select();
		$list[data] = $listArray;
		$list[page] = $page;
		return $list;
	}
}