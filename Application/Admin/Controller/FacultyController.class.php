<?php
namespace Admin\Controller;
use Think\Controller;
//系管理
class  FacultyController extends Controller {
	public function index() {
		$list = M('faculty') -> select();
		$this -> assign('list', $list);
		$this -> display();
	}

	public function add() {
		if (IS_POST) {
			$data['fct_name'] = I('fct_name');
			$Dao = D('faculty');
			if ($Dao -> create($data)) {
				if ($Dao -> add()) {
					$this -> success('添加成功', U('index'), 1);
				} else {
					$this -> error('添加失败');
				}
			} else {
				$this -> error($Dao -> getError());
			}
			return;
		}
		$this -> display();
	}
	public function delete() {
		$list = M('faculty') -> select();
		$this -> assign('list', $list);
		$this -> display();
	}

	public function deleteIndex() {
		$id = $_GET['valueDel'];
		$Nowpic = M('faculty') -> find($id);
		if ( M('faculty') -> delete($id)) {
			$this -> ajaxReturn(1);
		} else {
			$this -> ajaxReturn(0);
		}
	}

}
