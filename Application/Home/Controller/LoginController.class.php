<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends Controller {

    public function test(){

        $map = rand(9069,9293);
        //找到班级id

        //$mapClass['cl_name'] = $_SESSION['sdSession']['sd_class'];
        //$class = M('class')->field('cl_id')->where($mapClass)->find();
        $contentId = I('content_id');

        //$flag查找是该班级是否有对应的课题
        /*$mapCC['cc_class_id'] = $class['cl_id'];
        $mapCC['cc_content_id'] = $contentId;*/
        $mapContent['ct_id'] = $contentId;
        $mapSC['sc_content_id'] = $contentId;
        //$mapSC['sc_student_id'] = $map;

        //$flag = M('classcontent')->field('cc_id')->where($mapCC)->find();



        //判断这门课是否被选了
        $flag1 = M('studentcontent')->field('sc_id')->where($mapSC)->find();
        //dump($flag1);
        //判断这门课是否被选了

        if($flag1 == null){
            $data['sc_student_id'] = $map;
            $data['sc_content_id'] = $contentId;
            if(M('studentcontent')->add($data)){
                if(D('content')->where($mapContent)->setInc('ct_seletctd_num',1)){
                    echo "<script>alert('选课成功')</script>";
                }else{
                    echo "<script>alert('选课失败')</script>";
                }
            }
        }

        $Model = new \Home\Model\PersonModel();
        $listArray = $Model->dealWithIndex($map);

    }

    //显示登录页面并验证
	public function index(){
		if (IS_POST) {
			//获取验证码、用户名和密码
			$username = I('sd_num');
			$password = I('sd_pwd');
			$captcha = I('captcha');
			//验证,注意顺序
			//先检查验证码
			$verify = new \Think\Verify();
			if (!$verify->check($captcha)){
				$this->assign('marks',"验证码错误!");
				$this->display('index');
				return;
			}
			//再来检查用户名和密码,调用模型来完成
			if ($this->checkUser($username,$password)) {
				$this->redirect('Index/index');
			} else {
				$this->assign('marks',"密码错误!");
				$this->display('index');
				return;
			}
			return;
		} 
		$this->display();
	}
	//验证用户名和密码
	public function checkUser($username,$password){
		$Dao = D('Student');
		$condition['sd_num'] = $username;
		$condition['sd_pwd'] = $password;
		if ($sdSession = $Dao->where($condition)->find()) {
			//成功，保存session标识，并跳转到首页
			session('sdSession',$sdSession);
			return true;
		} else {
			return false;
		}
	}
	//生成验证码
	public function code(){
		// 使用tp自带的验证码类
		ob_clean();//用来丢弃输出缓冲区中的内容，如果你的网站有许多生成的图片类文件，那么想要访问正确，就要经常清除缓冲区
		
		//配置参数
		$config = array(
		    'fontSize' => 20 ,//验证码字体大小
		    'length' => 4 ,//验证码位数
		    'useNoise' => false ,//关闭验证码杂点
		);
		$Verify = new \Think\Verify($config);
		$Verify->entry();
	}
	public function nameAjax(){
    	$sd_num = $_GET['valueDel'];
		$map['sd_num'] = $sd_num;
		$Nowpic = M('Student' )->field('sd_num')->where($map)->find();
		$this->ajaxReturn($Nowpic['sd_num']);
	}
	//注销
	public function logout(){
		session('[destroy]');
		$this->redirect('Login/index');
	}
	
}