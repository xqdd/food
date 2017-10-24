<?php
namespace Admin\Model;
use Think\Model;
class StudentModel extends Model{
	//批量验证
	protected $patchValidate = true;
	protected $_validate = array(
	    array('sd_num','','有相同的学号！',0,'unique',1),
    );
    public function dealWithIndex(){
    	$Model = D('student');
		$count = $Model->count();
		$p=new \Think\Page($count,15);
	    $p->lastSuffix=false;
	    $p->setConfig('header','<div>共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>15</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
	    $p->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$p->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
	    $p->setConfig('last','末页');
	    $p->setConfig('first','首页');
	    $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$page    = $p->show();// 分页显示输出
		$arrayList = $Model->field('sd_id,sd_phone,sd_num,sd_sex,sd_name,sd_political_status,sd_nation,sd_pwd,sd_professional,sd_class,sd_idcar')->order('sd_id desc')->limit($p->firstRow.','.$p->listRows)->select();
		$list['data'] = $arrayList;
		$list['page'] = $page;
		return $list;
    }
}