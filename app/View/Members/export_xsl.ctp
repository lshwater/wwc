<?
$this->PhpExcel->createWorksheet();
$this->PhpExcel->setDefaultFont('標楷體', 10);

foreach($xlsxdata as $data){
    $this->PhpExcel->xls->setActiveSheetIndex($data['sheetindex']);
    $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow($data['col'], $data['row'], $data['value']);
}

//$this->PhpExcel->xls->setActiveSheetIndex(0);
//$this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "HIHIHIHI");

if(!empty($filename)){
    $this->PhpExcel->output($filename.'.xls');
}else{
    $this->PhpExcel->output('export.xls');
}


?>