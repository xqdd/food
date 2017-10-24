<?php
namespace Admin\Controller;
use Think\Controller;
//学生信息
class StudentController extends BaseController {
	public function index(){
		$Model = new \Admin\Model\StudentModel();
		$arrayList = $Model -> dealWithIndex();
		$this->assign('arrayList',$arrayList['data']);
		$this->assign('page',$arrayList['page']);
		//dump($arrayList['data']);
		/*		I('p'):表示你翻到第几页
*/		$this->assign ( 'p', I( 'p' ) ? I( 'p' ) : 1 );
		$this->display();
	}
	public function add()
	{	
		if(IS_POST){
		$tmp_file = $_FILES ['file_stu'] ['tmp_name'];
		$file_types = explode ( ".", $_FILES ['file_stu'] ['name'] );
		$file_type = $file_types [count ( $file_types ) - 1];
	
		 /*判别是不是.xls文件，判别是不是excel文件*/
		 if (strtolower ( $file_type ) != "xlsx" && strtolower ( $file_type ) != "xls")              
		 {
			  $this->error ( '不是Excel文件，重新上传' );
		 }
	
		 /*设置上传路径*/
		 $savePath = './Public/Uploads/';
		 /*以时间来命名上传的文件*/
		 $str = date ( 'Ymdhis' ); 
		 $file_name = $str . "." . $file_type;
		 /*是否上传成功*/
		 if (! copy ( $tmp_file, $savePath . $file_name )) 
		  {
			  $this->error ( '上传失败' );
		  }	  
		vendor('Classes.PHPExcel');
		vendor('Classes.PHPExcel.IOFactory');
		vendor('Classes.PHPExcel.Reader.Excel5');
       $objPHPExcel = new \PHPExcel(); 
       $PHPReader = new \PHPExcel_Reader_Excel2007(); //默认是excel2007  
       $filePath=$savePath.$file_name;  
       if(!$PHPReader->canRead($filePath)){   
            $PHPReader = new \PHPExcel_Reader_Excel5(); //如果不成功的时候用以前的版本来读取  
            if(!$PHPReader->canRead($filePath)){   
                echo 'no Excel';   
                return ;   
            }   
        }   
       $PHPExcel = $PHPReader->load($filePath);  
       $currentSheet = $PHPExcel->getSheet(0);  
       //取得一共有多少列  
        $allColumn = $currentSheet->getHighestColumn();     
        //取得一共有多少行  
        $allRow = $currentSheet->getHighestRow();  
        //循环读取数据,默认是utf-8输出  
        $listArray;
        for($currentRow = 2;$currentRow<=$allRow;$currentRow++)  
        {  
            for($currentColumn= 'A';$currentColumn<= $allColumn; $currentColumn++){
				$val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();/**ord()将字符转为十进制数*/
				if($currentColumn == 'A')
				{
/**如果输出汉字有乱码，则需将输出内容用iconv函数进行编码转换，如下将gb2312编码转为utf-8编码输出*/
				$listArray[$currentRow-2]['sd_num'] = $val;
				}if($currentColumn == 'B'){
				$listArray[$currentRow-2]['sd_name'] = $val;
				}if($currentColumn == 'C'){
				$listArray[$currentRow-2]['sd_sex'] = $val;
				}if($currentColumn == 'D'){
				$listArray[$currentRow-2]['sd_political_status'] = $val;
				}if($currentColumn == 'E'){
				$listArray[$currentRow-2]['sd_nation'] = $val;
				}if($currentColumn == 'F'){
				$listArray[$currentRow-2]['sd_professional'] = $val;
				}if($currentColumn == 'G'){
				$listArray[$currentRow-2]['sd_class'] = $val;
				}if($currentColumn == 'H'){
				$idCar = $val;
				$listArray[$currentRow-2]['sd_idcar'] = $val;
				}else{
				$listArray[$currentRow-2]['sd_pwd'] = substr($idCar,-6);	
				}
				}
        }
		//var_dump($listArray);
		  $student = D('Student');//M方法
		if($student -> create($listArray)){
	         //addAll方法的数组需要从0开始
		  if(! $student->addAll($listArray))
		  {
			  $this->error('导入数据库失败,注意不能有相同的学号或者身份证号');
			  exit();
		  }else
		  {
		  	  $this->assign('listArray',$listArray);
			  $this->display('Student/success');
		  }
		}else{
			$this -> error($student -> getError());
		}
		}else{
			$this->display();
		}		  
    }
    public function delete(){
    	if(IS_POST){
    	$keywords1 = I('sd_num');
		$keywords2 = I('sd_class');
		if($keywords1 != ''){
		$studentMap['sd_num'] = array (
				'like',
				"%{$keywords1}%" 
		);
		}
		if($keywords2 != ''){
		$studentMap['sd_class'] = array (
				'like',
				"%{$keywords2}%" 
		);
		$this->assign('marksClass','marksClass');
		}
		$Model = D('student');
		$list = $Model->field('sd_id,sd_num,sd_sex,sd_name,sd_political_status,sd_nation,sd_pwd,sd_professional,sd_class,sd_idcar')->where($studentMap)->order('sd_id desc')->select();
		$this->assign('list',$list);
    	}
    	$this->display();
    }
	
	
	
	public function deleteClass(){
    	//echo I('sd_class');
		$mapStudent['sd_class'] = I('sd_class');
    	$student = M('student')->where($mapStudent)->delete();
		//$mapStudent['sd_class'] = I('sd_class');
		/*echo $student.'f';
		echo $mapStudent['sd_class'];*/
		
		
		
		
		if($student){
		echo "<script>alert('删除成功!')</script>";
		}else{
		echo "<script>alert('删除失败!')</script>";
		$Model = D('student');
		$count = $Model->where($mapStudent)->count();
		$p=new \Think\Page($count,15);
	    $p->lastSuffix=false;
	    $p->setConfig('header','<div>共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>15</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</div>');
	    $p->setConfig('prev','<button type="button" class="btn btn-white">上一页</button>');
		$p->setConfig('next','<button type="button" class="btn btn-white">下一页</button>');
	    $p->setConfig('last','末页');
	    $p->setConfig('first','首页');
	    $p->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
		$page    = $p->show();// 分页显示输出
		$list = $Model->field('sd_id,sd_num,sd_sex,sd_name,sd_political_status,sd_nation,sd_pwd,sd_professional,sd_class,sd_idcar')->where($mapStudent)->order('sd_id desc')->limit($p->firstRow.','.$p->listRows)->select();
		$this->assign('list',$list);
		$this->assign('page',$page);
		$this->assign('marksClass','marksClass');
		$this->assign ( 'p', I( 'p' ) ? I( 'p' ) : 1 );
    	$this->display('delete');
		}
		$this->display('delete');
    }
	
    public function deleteSingle(){
    	$singleID['sd_id'] = I('singleID');
		$student = M('student')->where($singleID)->delete();
		echo $singleID;
		echo $student;
		if($student){
			echo "<script>alert('删除成功!')</script>";
		}else{
			echo "<script>alert('删除失败!')</script>";
		}
		$this->display('delete');
    }
	
	
 


	public function edit(){
		$Model = new \Admin\Model\StudentModel();
		$arrayList = $Model -> dealWithIndex();
		$this->assign('arrayList',$arrayList['data']);
		$this->assign('page',$arrayList['page']);
		/*		I('p'):表示你翻到第几页
*/		$this->assign ( 'p', I( 'p' ) ? I( 'p' ) : 1 );
		$this->display();
	}
	public function editSingle(){
		$singleID = I('singleID');
		if(IS_POST){
			$data['sd_id'] = I('sd_id');
			$data['sd_num'] = I('sd_num');
			$data['sd_name'] = I('sd_name');
			$data['sd_sex'] = I('sd_sex');
			$data['sd_political_status'] = I('sd_political_status');
			$data['sd_nation'] = I('sd_nation');
			$data['sd_professional'] = I('sd_professional');
			$data['sd_class'] = I('sd_class');
			$data['sd_idcar'] = I('sd_idcar');
			$data['sd_pwd'] = I('sd_pwd');		
		    $Dao = D('student');
			if($Dao->save($data)){
				$this->success("修改成功",U('edit'),1);
			}else{
				$this->error('修改失败');
			}
           		
			return;
		}
		$list = M('student')->find($singleID);
		$this -> assign('list',$list);
		$this -> display();
	}
}


