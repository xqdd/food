<?php

namespace Admin\Model;

use Think\Model\ViewModel;

class UnChooseContentModel extends ViewModel
{
    public $viewFields = array(
        'Content' => array('ct_id', 'ct_seletctd_num', 'ct_teacher', 'ct_name', 'ct_fu_name', 'ct_phone', 'ct_fuNameTel', 'ct_yjly', 'ct_lab', 'ct_time', 'ct_lab_manager', 'ct_beizhu', 'ct_faculty', 'ct_jingfei', 'ct_shiji', 'ct_nandu', 'ct_gongzuoliang', 'ct_zhicheng', 'ct_zhicheng1', 'ct_title_en', 'ct_yjnr', 'ct_mbhyq'),
    );


    /**
     *
     * 导出Excel教师选课内容
     */
    public function expContent()
    {//导出Excel
        $xlsName = "User";
        $xlsCell = array(
            array('id', '序号'),
            array('ct_teacher', '指导老师'),
            array('ct_zhicheng', '指导老师职称'),
            array('ct_phone', '指导老师电话'),
            array('ct_fu_name', '副指导老师'),
            array('ct_zhicheng1', '副指导老师职称'),
            array('ct_name', '论文题目（中文）'),
            array('ct_title_en', '论文题目（英文）'),
            array('ct_faculty', '指定可选院系'),
            array('ct_yjly', '研究领域'),
            array('ct_jingfei', '课题经费来源'),
            array('ct_shiji', '选题结合实际'),
            array('ct_nandu', '选题难度'),
            array('ct_gongzuoliang', '选题工作量'),
            array('ct_lab', '拟安排实验室'),
            array('ct_time', '实验时间'),
            array('ct_lab_manager', '实验室管理员'),
            array('ct_beizhu', '备注'),
            array('ct_yjnr', '主要研究内容'),
            array('ct_mbhyq', '目标和要求'),
        );
        $xlsModel = D('UnChooseContent');

        $whereC['ct_seletctd_num'] = array('eq', 0);

        $xlsData = $xlsModel->distinct(true)
            ->field('ct_faculty,ct_teacher,ct_phone,ct_fu_name,ct_name,ct_yjly,ct_lab,ct_time,ct_lab_manager,ct_beizhu,ct_jingfei,ct_shiji,ct_nandu,ct_gongzuoliang,ct_zhicheng,ct_zhicheng1,ct_title_en,,ct_yjnr,ct_mbhyq')
            ->order('ct_teacher')->where($whereC)->select();


        for ($i = 1; $i <= sizeof($xlsData); $i++) {
            $xlsData[($i-1)]['id'] = $i;
        }

        $this->exportExcel($xlsName, $xlsCell, $xlsData, "所有未被选课程列表");

    }


    //excel定义
    public function exportExcel($expTitle, $expCellName, $expTableData, $fileName)
    {
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
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