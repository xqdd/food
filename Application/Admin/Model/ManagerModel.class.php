<?php
namespace Admin\Model;
use Think\Model;
class ManagerModel extends Model{
		//自动验证
	protected $_validate = array(
		array('mg_name','require','账号不能为空！'),
		array('mg_name','','该账号已经存在',0,'unique',1),
	);
	
	public function dealWith(){
		$Dao = M('manager');
        $userList = $Dao->where('mg_sign=0')->select();
		return $userList;
	}
		public function dealWith1(){
		$Dao = M('manager');
        $userList = $Dao->where('mg_sign=1')->select();
		return $userList;
	}
	public function dealWith2(){
		$Dao = M('manager');
        $userList = $Dao->where('mg_sign=2')->select();
		return $userList;
	}
}