<?php
namespace Admin\Model;
use Think\Model;
class LabelModel extends Model{
     //自动验证
	protected $_validate = array(
        array('lb_name','','帐号名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
    );
	//定义一个方法，获取树状的分类信息
	public function catTree($str){
		if ($str === 'articleLabel') {
	    $cats = $this->where('lb_class=1')->select();
		}else if($str === 'moduleLabel'){
	    $cats = $this->where('lb_class=2')->select();
		}else if($str === 'toolLabel'){
		$cats = $this->where('lb_class=3')->select();
		}
		return $this->tree($cats);
			}

	//定义一个方法，对给定的数组，递归形成树
	public function tree($arr,$pid = 0,$level = 0) {
		static $tree = array();
		foreach ($arr as $v) {
			if ($v['lb_parent_id'] == $pid) {
				//说明找到，保存
				$v['level'] = $level; //保存当前分类的所在层级
				$tree[] = $v;
				//继续找
				$this->tree($arr,$v['lb_id'],$level + 1);
			}
		}
		return $tree;
	}

	//给定一个分类，找其后代分类的cat_id，包括它自己
	public function getSubIds($cat_id,$sign){
		$cats;
		if($sign == 1){
			$cats = $this->where('lb_class=1')->select();
		}else if($sign = 2){
			$cats = $this->where('lb_class=2')->select();
		}else if($sign = 3){
			$cats = $this->where('lb_class=2')->select();
		}
		$list = $this->tree($cats,$cat_id);
		$res = array();
		foreach ($list as $v) {
			$res[] = $v['lb_id'];
		}
		//把cat_id追加到数组
		$res[] = $cat_id;
		return $res;
	}
}