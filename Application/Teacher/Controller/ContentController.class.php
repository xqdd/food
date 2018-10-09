<?php

namespace Teacher\Controller;

use Think\Controller;

class ContentController extends BaseController
{
    public $sizeof1;
    public $result;

    public function __construct()
    {
        parent::__construct(); //必须继承父类
        $modal = M('content');
        $map['ct_teacherAdmin'] = (int)session('tcSession')['mg_id'];
        $result = $modal->where($map)->select();
        $this->sizeof1 = (10 - sizeof($result));
        $this->result = $result;
    }

    public function index()
    {
        $this->assign('result', $this->result);
        $this->assign('sizeof', $this->sizeof1);
        $this->display();
    }

    //查看学生信息
    public function searchStu()
    {
        $map['sc_content_id'] = I('ct_id');
        $stu_id = M('studentcontent')->where($map)->field('sc_student_id')->find();
        //$stu_id = M('studentcontent')->where($map)->select();

        $map1['sd_id'] = $stu_id['sc_student_id'];
        $oneStu = M('student')->where($map1)->select();
        //dump($oneStu);
        $this->assign('oneStu', $oneStu);
        $this->display();
    }

    //添加课题内容
    public function add()
    {
        if (I('ct_name') != '') {
            $Dao1 = D('content');
            $map['ct_name'] = I('ct_name');
            //dump(I('ct_name'));
            $flag = $Dao1->where($map)->select();
            //echo sizeof($flag);

            //查询已发布课题个数
            $mapContentCount['ct_teacherAdmin'] = (int)session('tcSession')['mg_id'];
            $contentCount = M('content')->where($mapContentCount)->count();
            if ($contentCount >= 10) {
                $this->error('最多只能发布10个课题！');
                return;
            }
            if (!sizeof($flag)) {
                if (IS_POST) {
                    $data['ct_name'] = I('ct_name');
                    $data['ct_teacher'] = I('ct_teacher');
                    $data['ct_limit_num'] = 1;
                    $data['ct_phone'] = I('ct_phone');
                    $data['ct_fu_name'] = I('ct_fu_name');
                    $data['ct_fuNameTel'] = I('ct_fuNameTel');
                    $data['ct_from'] = I('ct_from');
                    $data['ct_lab'] = I('ct_lab');
                    $data['ct_time'] = I('ct_time');
                    $data['ct_lab_manager'] = I('ct_lab_manager');
                    $data['ct_beizhu'] = I('ct_beizhu');
                    $data['ct_faculty'] = I('ct_faculty');

                    $data['ct_jingfei'] = I('ct_jingfei');
                    $data['ct_shiji'] = I('ct_shiji');
                    $data['ct_nandu'] = I('ct_nandu');
                    $data['ct_gongzuoliang'] = I('ct_gongzuoliang');
                    $data['ct_zhicheng'] = I('ct_zhicheng');
                    $data['ct_zhicheng1'] = I('ct_zhicheng1');
                    $data['ct_title_en'] = I('ct_title_en');
                    $data['ct_introduce'] = I('ct_introduce');

                    $data['ct_mbhyq'] = I('ct_mbhyq');
                    $data['ct_yjnr'] = I('ct_yjnr');
                    $data['ct_yjly'] = I('ct_yjly');

                    $data['ct_teacherAdmin'] = (int)session('tcSession')['mg_id'];

                    //添加成功的话会自动返回添加哪一行的id号$contentId
                    if ($contentId = $Dao1->add($data)) {
                        $this->success('添加成功', U('index'), 1);
                    } else {
                        $this->error('添加失败');
                    }
                    return;
                }
            } else {
                $this->error('有同名的课题，添加失败');
            }
            $this->assign('sizeof', $this->sizeof1);
            $this->display();
        } else {
            //echo 'jdj';
            $this->display();
        }

    }

    //修改课程信息
    public function alert()
    {
        $ct_id = (int)$_GET['ct_id'];
        $Dao1 = D('content');
        $map['ct_id'] = $ct_id;
        $result = $Dao1->where($map)->select();
        //dump($result);
        //给页面数据
        $this->assign('result', $result);

        if (IS_POST) {
            $data['ct_name'] = I('ct_name');
            $data['ct_title_en'] = I('ct_title_en');

            $data['ct_id'] = I('ct_id');
            $data['ct_teacher'] = I('ct_teacher');
            $data['ct_limit_num'] = 1;
            $data['ct_phone'] = I('ct_phone');
            $data['ct_fu_name'] = I('ct_fu_name');
            $data['ct_fuNameTel'] = I('ct_fuNameTel');
            $data['ct_from'] = I('ct_from');
            $data['ct_lab'] = I('ct_lab');
            $data['ct_time'] = I('ct_time');
            $data['ct_lab_manager'] = I('ct_lab_manager');
            $data['ct_beizhu'] = I('ct_beizhu');

            $data['ct_jingfei'] = I('ct_jingfei');
            $data['ct_shiji'] = I('ct_shiji');
            $data['ct_nandu'] = I('ct_nandu');
            $data['ct_gongzuoliang'] = I('ct_gongzuoliang');
            $data['ct_zhicheng'] = I('ct_zhicheng');
            $data['ct_zhicheng1'] = I('ct_zhicheng1');
            $data['ct_title_en'] = I('ct_title_en');
            $data['ct_introduce'] = I('ct_introduce');


            $data['ct_mbhyq'] = I('ct_mbhyq');
            $data['ct_yjnr'] = I('ct_yjnr');
            $data['ct_yjly'] = I('ct_yjly');


            $data['ct_start'] = I('ct_start');
            $data['ct_comment'] = I('ct_comment');
            $data['ct_faculty'] = I('ct_faculty');/*
			$data['ct_teacherAdmin'] = (int)session('tcSession')['mg_id'];*/
            //添加成功的话会自动返回添加哪一行的id号$contentId
            if ($contentId = $Dao1->save($data)) {
                $this->success('修改成功', U('index'), 1);
            } else {
                $this->error('修改失败');
            }
            return;

        }
        $this->assign('sizeof', $this->sizeof1);
        $this->display();
    }

    public function dele()
    {
        $ct_id = (int)$_GET['ct_id'];
        $Dao1 = D('content');
        $map['ct_id'] = $ct_id;
        $result = $Dao1->where($map)->select();
        /*dump($result);*/
        //echo $result[0]['ct_seletctd_num'];

        //先判断学生是否选择了改题目，如果选了就不能删除
        if ($result[0]['ct_seletctd_num'] <= 0) {
            if ($Dao1->delete($ct_id)) {
                $this->success('删除成功', U('index'), 1);
            } else {
                $this->error('删除失败');
            }
        } else {
            $this->error('已经有学生选择了这个题目，您不能删除！！！');
        }
        //$this->display();
    }

}