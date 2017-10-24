<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class ArticleViewModel extends ViewModel{
	protected $tableName = 'article'; 	
	protected $_validate = array(
	    array('atc_name','','帐号名称已经存在！',0,'unique',1),
        array('atc_name','require','评论内容必须！'),
        array('atc_click_rate','number','点击次数应为纯数字！'),
        array('atc_reputation','number','被赞次数应为纯数字！'),
    );
	public $viewFields = array(
	    'Article' => array('atc_id','atc_name','atc_date','atc_click_rate','atc_reputation','atc_picture','atc_content','atc_is_show','atc_is_new','atc_from_url','atc_from'),
	    'User' => array('user_id','user_name','_on'=>'Article.atc_owner_id=User.user_id'),
		'Label' => array('lb_id','lb_name','_on'=>'Article.atc_label_id=Label.lb_id'),
	);
	public function getUserid($userName){
		$Dao = D('ArticleView');
		$list = $Dao->field('user_id')->select();
		return $list;
	}
	public function getData(){
		$Dao = D('ArticleView');
		$count = $Dao->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,16);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$Page->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
		$page    = $Page->show();// 分页显示输出
		$listArray = $Dao->
		field('atc_id,atc_name,atc_date,atc_click_rate,atc_reputation,atc_picture,user_id,user_name,lb_id,lb_name')->order('atc_click_rate desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $userList['list'] = $listArray;
        $userList['page'] = $page;
		return $userList;
	}
	public function getSearch($search){
		$Dao = D('ArticleView');
		$count = $Dao->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,16);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$Page->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
		$page    = $Page->show();// 分页显示输出
		$map['atc_name'] = array('like','%'.$search.'%');
		$listArray = $Dao->
		field('atc_id,atc_name,atc_date,atc_click_rate,atc_reputation,atc_picture,user_id,user_name,lb_id,lb_name')->where($map)->order('atc_click_rate desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $userList['list'] = $listArray;
        $userList['page'] = $page;
		return $userList;
	}
    public function getDataByid($id){
		$Dao = D('ArticleView');
		$map['atc_id'] = $id;
		$listArray = $Dao->
		field('atc_id,atc_name,atc_date,atc_click_rate,atc_reputation,atc_picture,user_id,user_name,lb_id,lb_name,atc_content,atc_is_show,atc_is_new,atc_from_url,atc_from')->where($map)->order('atc_click_rate desc')->select();
        $userList = $listArray;
		return $userList;
	}
}