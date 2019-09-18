<?
$start = new DateTime($startdate);
$interval = new DateInterval('P1M');
$end = new DateTime($enddate);
$dateperiod = new DatePeriod($start, $interval, $end);
$Periods = array();
$result = array();


foreach ($dateperiod as $dt) {
    $Periods[] = array(
        "startdate" => $dt->format('Y-m-d'),
        "enddate" => date("Y-m-t", strtotime($dt->format('Y-m-d'))),
        "resultkey" => $dt->format('Y-m-d'),
        "label" => $dt->format('M')
    );
}

$this->PhpExcel->loadWorksheet(APP . 'Files/Master.xls');
//$this->PhpExcel->setDefaultFont('新細明體', 10);

//$type_col = array();
//if (!empty($activitytypes)) {
//    $col = 7;
//    foreach ($activitytypes as $type) {
//        $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow($col, 2, $type['Activitytype']['name']);
//        $type_col[$type['Activitytype']['id']] = $col;
//        $col++;
//        if ($col > 13) {
//            break;
//        }
//    }
//}
$this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(10, 2, "輸入時間");

$startrows = 3;
foreach ($results as $data) {
    $this->PhpExcel->xls->setActiveSheetIndex(0);

    if (!empty($data['Activityapplication'])) {
        $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(0, $startrows, date("Y-m-d", strtotime($data['Activityapplication']['date'])));
        $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(1, $startrows, $data['Activityapplication']['payment_code']);
        $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(2, $startrows, $data['Activityapplicant'][0]['c_name']);
        $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(3, $startrows, $data['Activityapplicant'][0]['Member']['code']);
        $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(4, $startrows, $data['Activity']['activity_code']);
        $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(5, $startrows, $data['Activity']['name']);
        $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(6, $startrows, $data['Activityapplication']['totalcost']);

        $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(7, $startrows, $data['Paymentmethod']['name']);
        $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(8, $startrows, $data['User']['name']);
        $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(9, $startrows, $data['Activityapplication']['remarks']);
        $this->PhpExcel->xls->getActiveSheet()->setCellValueByColumnAndRow(10, $startrows, date("Y-m-d H:i:s", strtotime($data['Activityapplication']['created'])));
    }

    $startrows++;
}

list($filestartname) = $Periods;
$safe = str_replace("/", "", $filestartname['label'] . "-" . $Periods[end(array_keys($Periods))]['label']);
$this->PhpExcel->output('Master.xls');

?>