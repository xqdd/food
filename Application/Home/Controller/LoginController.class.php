<?php

namespace Home\Controller;

use Think\Controller;

class LoginController extends Controller
{

    //显示登录页面并验证
    public function index()
    {
        if (IS_POST) {
            //获取验证码、用户名和密码
            $username = I('sd_num');
            $password = I('sd_pwd');
            $captcha = I('captcha');
            //验证,注意顺序
            //先检查验证码
            $verify = new \Think\Verify();
            if (!$verify->check($captcha)) {
                $this->assign('marks', "验证码错误!");
                $this->display('index');
                return;
            }
            //再来检查用户名和密码,调用模型来完成
            if ($this->checkUser($username, $password)) {
                $this->redirect('Index/index');
            } else {
                $this->assign('marks', "密码错误!");
                $this->display('index');
                return;
            }
            return;
        }
        $this->display();
    }

    //验证用户名和密码
    public function checkUser($username, $password)
    {
        $Dao = D('Student');
        $condition['sd_num'] = $username;
        $condition['sd_pwd'] = $password;
        if ($sdSession = $Dao->where($condition)->find()) {
            //成功，保存session标识，并跳转到首页
            session('sdSession', $sdSession);
            return true;
        } else {
            return false;
        }
    }

    //生成验证码
    public function code()
    {
        // 使用tp自带的验证码类
        ob_clean();//用来丢弃输出缓冲区中的内容，如果你的网站有许多生成的图片类文件，那么想要访问正确，就要经常清除缓冲区

        //配置参数
        $config = array(
            'fontSize' => 20,//验证码字体大小
            'length' => 4,//验证码位数
            'useNoise' => false,//关闭验证码杂点
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    public function nameAjax()
    {
        $sd_num = $_GET['valueDel'];
        $map['sd_num'] = $sd_num;
        $Nowpic = M('Student')->field('sd_num')->where($map)->find();
        $this->ajaxReturn($Nowpic['sd_num']);
    }

    //注销
    public function logout()
    {
        session('[destroy]');
        $this->redirect('Login/index');
    }

}