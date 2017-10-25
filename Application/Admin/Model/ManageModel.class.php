<?php
//商品分类模型
namespace Admin\Model;
use Think\Model;
class ManageModel extends Model{
	//自动验证
	protected $_validate = array(
		array('mg_name','require','账号不能为空！'),
		array('mg_name','','该账号已经存在',0,'unique',1),
	);

		//验证用户名和密码
	public function checkUser($username,$password){
		$Dao = D('Manager');
		$condition['mg_name'] = $username;
		$condition['mg_pwd'] = $password;
		if ($admin = $Dao->where($condition)->find()) {
		    if($admin['mg_sign']!=0){
		        return false;
            }
		    //成功，保存session标识，并跳转到首页
			session('admin',$admin);
			return true;
		} else {
			return false;
		}
	}
}