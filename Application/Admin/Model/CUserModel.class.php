<?php
namespace Admin\Model;
use Think\Model;
class CUserModel extends Model{
	public function dealWith(){
		$Dao = M('user');
		$count = $Dao->count();// 查询满足要求的总记录数
		$Page = new \Think\Page($count,9);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$Page->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$Page->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
		$page    = $Page->show();// 分页显示输出
		$list = $Dao->field('user_id,user_name,user_head_sculpture,user_qq,user_ip,user_age')->limit($Page->firstRow.','.$Page->listRows)->select();
        $userList['list'] = $list;
        $userList['page'] = $page;
		return $userList;
	}
}