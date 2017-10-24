<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class ModuleViewModel extends ViewModel{
	protected $_validate = array(
	    array('md_name','','标题已经存在！',0,'unique',1),
        array('md_name','require','标题已经存在必须填！'),
        array('md_download','number','下载次数应为纯数字！'),
        array('md_score','number','积分应为纯数字！'),
    );
	public $viewFields = array(
	    'Module' => array('md_id','md_name','md_sign','md_date','md_url','md_picture','md_yzm','md_content','md_introduce','md_score','md_download'),
		'Label' => array('lb_id','lb_name','_on'=>'Module.md_lb_id=Label.lb_id'),
	);
	public function getData($sign){
		$map['md_sign'] = $sign;
		$Dao = D('ModuleView');
		$count = $Dao->where($map)->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,16);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$Page->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
		$page    = $Page->show();// 分页显示输出
		$listArray = $Dao->
		field('md_id,md_name,md_date,md_picture,md_score,md_download,lb_id,lb_name')->where($map)->order('md_download desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $userList['list'] = $listArray;
        $userList['page'] = $page;
		return $userList;
	}
	public function getSearch($search,$sign){
		$map['md_sign'] = $sign;
		$Dao = D('ModuleView');
		$count = $Dao->where($map)->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,16);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$Page->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
		$page    = $Page->show();// 分页显示输出
		$map['md_name'] = array('like','%'.$search.'%');
		$listArray = $Dao->
		field('md_id,md_name,md_date,md_picture,md_score,md_download,lb_id,lb_name')->where($map)->order('md_download desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $userList['list'] = $listArray;
        $userList['page'] = $page;
		return $userList;
	}
    public function getDataByid($id){
		$Dao = D('ModuleView');
		$map['md_id'] = $id;
		$listArray = $Dao->
		field('md_id,md_name,md_date,md_picture,md_url,md_score,md_download,lb_id,lb_name,md_content,md_introduce,md_yzm')->where($map)->select();
        $userList = $listArray;
		return $userList;
	}
}