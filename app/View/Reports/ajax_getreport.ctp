<?
$start = new DateTime($startdate);
$interval = new DateInterval('P1M');
$end = new DateTime($enddate);
$dateperiod = new DatePeriod($start, $interval, $end);
$Periods = array();
$result = array();

foreach ($dateperiod as $dt) {
    $Periods[] = array(
        "startdate"=>$dt->format('Y-m-d'),
        "enddate"=>date("Y-m-t", strtotime($dt->format('Y-m-d'))),
        "resultkey"=>$dt->format('Y-m-d'),
        "label"=>$dt->format('M')
    );
}
$this->PhpExcel->loadWorksheet($xlsxpath);
$this->PhpExcel->setDefaultFont('標楷體', 10);

foreach($xlsxdata as $data){
    $this->PhpExcel->xls->setActiveSheetIndex($data['sheetindex']);
    $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow($data['col'], $data['row'], $data['value']);
}

list($filestartname) = $Periods;
$safe = str_replace("/","",$filestartname['label']."-".$Periods[end(array_keys($Periods))]['label']);
$this->PhpExcel->output('SIS_FORM('.$safe.').xls');

?>