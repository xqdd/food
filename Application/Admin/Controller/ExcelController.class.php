<?php
namespace Admin\Controller;
use Think\Controller;
// +----------------------------------------------------------------------
// | Description: Be yourself
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.bbw712.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: simon wsyone@foxmail.com
// +----------------------------------------------------------------------
// | Date:2014-5-17
class ExcelController extends BaseController {
	/**
	 *
	 * Enter 导出excel共同方法 ...
	 * @param unknown_type $expTitle
	 * @param unknown_type $expCellName
	 * @param unknown_type $expTableData
	 */
	function  index(){
		$this->display();
	}
	public function exportExcel($expTitle,$expCellName,$expTableData){
		$xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
		$fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
		$cellNum = count($expCellName);
		$dataNum = count($expTableData);
        vendor('Classes.PHPExcel');
		vendor('Classes.PHPExcel.IOFactory');
		vendor('Classes.PHPExcel.Reader.Excel5');
		
		
		$objPHPExcel = new \PHPExcel();
		$cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

		$objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
		// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
		for($i=0;$i<$cellNum;$i++){
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
		}
		// Miscellaneous glyphs, UTF-8
		for($i=0;$i<$dataNum;$i++){
			for($j=0;$j<$cellNum;$j++){
				$objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
			}
		}
		//清除缓冲区,避免乱码
        ob_end_clean();
		header('pragma:public');
		header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
		header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}

	/**
	 *
	 * 导出Excel
	 */
	function expUser(){//导出Excel
		$xlsName  = "User";
		$xlsCell  = array(
		array('sd_id','序号'),
		array('sd_num','学号'),
		array('sd_name','姓名'),
		array('sd_sex','性别'),
		array('sd_political_status','政治面貌'),
		);
		$xlsModel = M('Student');

		$xlsData  = $xlsModel->Field('sd_id,sd_num,sd_name,sd_sex,sd_political_status')->select();
		/*foreach ($xlsData as $k => $v)
		{
			$xlsData[$k]['sex']=$v['sex']==1?'男':'女';
		}*/
		$this->exportExcel($xlsName,$xlsCell,$xlsData);
			
	}


}