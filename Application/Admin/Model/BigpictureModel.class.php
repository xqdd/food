<?php
namespace Admin\Model;
use Think\Model;
class BigpictureModel extends Model{
	public function dealWith($sign){
		$map['pic_sign'] = $sign;
		$Dao = M('picture');
		$list = $Dao->where($map)->select();
		return $list;
	}
}