<?php

namespace Admin\Model;

use Think\Model\ViewModel;

class SCModel extends ViewModel
{
    public $viewFields = array(
        'Studentcontent' => array('sc_id', 'sc_student_id', 'sc_content_id'),
        'Student' => array('sd_id', 'sd_phone', 'sd_num', 'sd_class', 'sd_name', 'sd_sex', 'sd_professional', 'sd_class', '_on' => 'Student.sd_id=Studentcontent.sc_student_id'),
        'Content' => array('ct_id', 'ct_seletctd_num', 'ct_start', 'ct_comment', 'ct_teacher', 'ct_name', 'ct_fu_name', 'ct_phone', 'ct_fuNameTel', 'ct_yjly', 'ct_lab', 'ct_time', 'ct_lab_manager', 'ct_beizhu', 'ct_faculty', 'ct_jingfei', 'ct_shiji', 'ct_nandu', 'ct_gongzuoliang', 'ct_zhicheng', 'ct_zhicheng1', 'ct_title_en', 'ct_yjnr', 'ct_mbhyq', '_on' => 'Content.ct_id=Studentcontent.sc_content_id'),
    );

    public function dealWithIndex()
    {
        $Model = D("SC");
        $count = $Model->count();
        $p = new \Think\Page($count, 15);
        $p->lastSuffix = false;
        $p->setConfig('header', '<div style="float:right;">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>2</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
        $p->setConfig('prev', '<button type="button" class="btn btn-white">上一页</button>');
        $p->setConfig('next', '<button type="button" class="btn btn-white">下一页</button>');
        $p->setConfig('last', '末页');
        $p->setConfig('first', '首页');
        $p->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
        $page = $p->show();// 分页显示输出
        //distinct选出唯一的id
        $arrayList = $Model->distinct(true)->field('ct_id,ct_name,ct_seletctd_num,ct_teacher,sd_id,sd_name,sd_num,sd_sex,sd_professional,sd_class')->limit($p->firstRow . ',' . $p->listRows)->order('sd_num')->select();
        $list[data] = $arrayList;
        $list[page] = $page;
        //dump($arrayList);
        return $list;
    }

    public function search($map)
    {
        $Model = D("SC");
        $arrayList = $Model->distinct(true)->field('ct_id,ct_name,ct_seletctd_num,ct_teacher,sd_id,sd_name,sd_num,sd_sex,sd_professional,sd_class')->order('sd_num')->where($map)->select();
        return $arrayList;
    }

    /**
     *
     * 导出Excel
     */
    public function expUser()
    {//导出Excel
        $xlsName = "User";
        $xlsCell = array(
            array('sd_id', '序号'),
            array('ct_teacher', '指导老师'),
            array('ct_zhicheng', '指导老师职称'),
            array('ct_phone', '指导老师电话'),
            array('ct_fu_name', '副指导老师'),
            array('ct_zhicheng1', '副指导老师职称'),
            array('ct_name', '论文题目（中文）'),
            array('ct_title_en', '论文题目（英文）'),
            array('ct_yjly', '研究领域'),
            array('ct_jingfei', '课题经费来源'),
            array('ct_shiji', '选题结合实际'),
            array('ct_nandu', '选题难度'),
            array('ct_gongzuoliang', '选题工作量'),
            array('sd_num', '学号'),
            array('sd_name', '学生姓名'),
            array('sd_class', '班别'),
            array('sd_phone', '联系电话'),
            array('ct_lab', '拟安排实验室'),
            array('ct_time', '实验时间'),
            array('ct_lab_manager', '实验室管理员'),
            array('ct_beizhu', '备注'),
            array('ct_yjnr', '主要研究内容'),
            array('ct_mbhyq', '目标和要求'),
            array('ct_start', '指导老师评分'),
            array('ct_comment', '指导老师评语'),
        );
        $xlsModel = D('SC');

        $xlsData = $xlsModel->distinct(true)->field('sd_id,ct_teacher,ct_phone,ct_fu_name,ct_name,ct_yjly,sd_num,sd_name,sd_class,sd_phone,ct_lab,ct_time,ct_lab_manager,ct_beizhu,ct_jingfei,ct_shiji,ct_nandu,ct_gongzuoliang,ct_zhicheng,ct_zhicheng1,ct_title_en,ct_yjnr,ct_mbhyq,ct_start,ct_comment')->order('sd_num')->select();
        $idMark = 0;
        foreach ($xlsData as $k => $v) {
            $idMark++;
            $xlsData[$k]['sd_id'] = $idMark;
        }
        $this->exportExcel($xlsName, $xlsCell, $xlsData);

    }

    //excel定义
    public function exportExcel($expTitle, $expCellName, $expTableData)
    {
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['account'] . date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor('Classes.PHPExcel');
        vendor('Classes.PHPExcel.IOFactory');
        vendor('Classes.PHPExcel.Reader.Excel5');


        $objPHPExcel = new \PHPExcel();
        $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[$cellNum - 1] . '1');//合并单元格
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
        for ($i = 0; $i < $cellNum; $i++) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '2', $expCellName[$i][1]);
        }
        // Miscellaneous glyphs, UTF-8
        for ($i = 0; $i < $dataNum; $i++) {
            for ($j = 0; $j < $cellNum; $j++) {
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + 3), $expTableData[$i][$expCellName[$j][0]]);
            }
        }
        //清除缓冲区,避免乱码
        ob_end_clean();
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

}