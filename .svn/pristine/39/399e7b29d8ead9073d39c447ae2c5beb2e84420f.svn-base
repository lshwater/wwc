<?
$filename = preg_replace('/[^a-zA-Z0-9]/', '', 'attendantsheet_'.h($activity['Activity']['activity_code']).')');
$filename = $filename.'.zip';
$file2zip = array();

$sheet_count = 1;
$printprepage = 20;
$pageprinting = false;
$date = array(
    '','','','','','','','','',''
);

for($i = 0; $i < sizeof($activity['ActivitiesVolunteer']); $i++){
    //print header
    if($i % $printprepage == 0){
        if($pageprinting){
            //close that page
            $file_path = $dir_path."/sheet_{$sheet_count}.xls";
            $this->PhpExcel->saveto($file_path);
            $file2zip[] = $file_path;
            $pageprinting = false;
            $sheet_count++;
        }
        $pageprinting = true;
        $this->PhpExcel->loadWorksheet('files/exportattendentsheet.xls');
        $this->PhpExcel->setDefaultFont('標楷體', 10);

        $this->PhpExcel->setRow(1);
        $this->PhpExcel->addData(array($volunteertype['Volunteertype']['name']), 1);

        $this->PhpExcel->setRow(5);
        $this->PhpExcel->addData(array($activity['Activity']['name']), 2);
        $this->PhpExcel->setRow(5);
        $this->PhpExcel->addData(array($activity['Activity']['activity_code']), 14);

        $this->PhpExcel->setRow(6);
        $date = date('Y/m/d', strtotime($activity['Activity']['startdate']))." - ".date('Y/m/d', strtotime($activity['Activity']['enddate']));
        $this->PhpExcel->addData(array($date), 2);
        $this->PhpExcel->setRow(6);
        $this->PhpExcel->addData(array($activity['Activity']['target']), 7);
        $this->PhpExcel->setRow(6);
        $this->PhpExcel->addData(array($activity['Activity']['place']), 14);


        $this->PhpExcel->setRow(7);
        $this->PhpExcel->addData(array($activity['Activity']['quota']), 7);
        $this->PhpExcel->setRow(7);
        $this->PhpExcel->addData(array($activity['Activity']['tutor']), 14);

        $this->PhpExcel->setRow(8);
        $this->PhpExcel->addData(array($activity['Activity']['fee']), 2);
        $this->PhpExcel->setRow(8);
        $this->PhpExcel->addData(array($activity['Activity']['incharge']), 14);
    }
    $this->PhpExcel->setRow(11+($i % $printprepage));
    $printname = $activity['ActivitiesVolunteer'][$i]['c_name'];
    if(empty($printname)){
        $printname = $activity['ActivitiesVolunteer'][$i]['e_name'];
    }

    $this->PhpExcel->addTableRow(
        array(
            $i+1,
            $printname,
            $activity['ActivitiesVolunteer'][$i]['Volunteer']['code'],
            '','','','','','','','','','',
            $activity['ActivitiesVolunteer'][$i]['tel'],
        )
    );

}
if($pageprinting){
    //close that page
    $file_path = $dir_path."/sheet_{$sheet_count}.xls";
    $this->PhpExcel->saveto($file_path);
    $file2zip[] = $file_path;
    $pageprinting = false;
    $sheet_count++;
}
create_zip($file2zip, $dir_path."/".$filename);

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"".$filename."\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($dir_path."/".$filename));
ob_end_flush();
@readfile($dir_path."/".$filename);
exit();


function create_zip($files = array(),$destination = '',$overwrite = false) {
    //if the zip file already exists and overwrite is false, return false
    if(file_exists($destination) && !$overwrite) { return false; }
    //vars
    $valid_files = array();
    //if files were passed in...
    if(is_array($files)) {
        //cycle through each file
        foreach($files as $file) {
            //make sure the file exists
            if(file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
    //if we have good files...
    if(count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        //add the files
        foreach($valid_files as $file) {
            $zip->addFile($file,basename($file));
        }
        //debug
        //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

        //close the zip -- done!
        $zip->close();

        //check to make sure the file exists
        return file_exists($destination);
    }
    else
    {
        return false;
    }
}

?>