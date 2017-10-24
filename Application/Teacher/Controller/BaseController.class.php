<?php
namespace Teacher\Controller;
use Think\Controller;
class BaseController extends Controller{
	//构造方法
	public function __construct(){
		parent::__construct();
		$this->checkLogin();
	}
	//验证是否有登陆
	public function checkLogin(){
		//通过session来验证
		if(!$_SESSION['tcSession']){
			//没有登陆
			$this->error("请先登录",U('Login/index'));
		}
	}
}
