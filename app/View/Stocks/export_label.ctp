<!---->
<!--<div class=WordSection1 style='tab-interval:36.0pt'>-->
<!--    <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0-->
<!--           style='margin-left:-.75pt;border-collapse:collapse;mso-table-layout-alt:fixed;-->
<!-- border:none;mso-border-alt:solid windowtext .5pt;mso-padding-top-alt:0cm;-->
<!-- mso-padding-bottom-alt:0cm'>-->
<?
//configure::write('debug',2);
$count = 1;
$row_count = 0;
$new_tr = 1;
$new_div = 1;
$open_tr = 0;

foreach($stocks as $stock){

    if($new_div){
        echo "<div class=WordSection1 style='tab-interval:36.0pt'><table class=MsoTableGrid border=0 cellspacing=0 cellpadding=0
           style='margin-left:-.75pt;border-collapse:collapse;mso-table-layout-alt:fixed;
 border:none;mso-border-alt:solid windowtext .5pt;mso-padding-top-alt:0cm;
 mso-padding-bottom-alt:0cm'><tbody>";
    }


    if($new_tr){
        echo "<tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;page-break-inside:avoid;
  height:47.95pt;mso-height-rule:exactly'>";
        $open_tr = 1;
    }
    $data_to_encode = $stock['Stock']['fix_asset_no'];
    $barcode = $this->barcode;

// Generate Barcode data
    $barcode->barcode();
    $barcode->setType('C128');
    $barcode->setCode($data_to_encode);
    $barcode->setSize(50,180);
    $barcode->hideCodeType();

// Generate filename
    $random = rand(0,1000000);
    $file = 'img/barcode/code_'.$random.'.png';

// Generates image file on server
    $barcode->writeBarcodeFile($file);

    echo "<td height=64 width=264 valign=middle ><center><img style='display: flex; justify-content: center;' src='".$this->Html->url('/'.$file)."'></center></td>";

    $new_tr = 0;
    if($count % 3 == 0){
        echo "</tr>";
        $row_count++;
        $new_tr = 1;
        $open_tr = 0;
    }

    $new_div = 0;
    if($row_count == 17){
        echo "</tbody></table>
<p class=MsoNormal style='margin-top:0cm;margin-right:18.9pt;margin-bottom:
0cm;margin-left:18.9pt;margin-bottom:.0001pt;'><span style='display:none;
mso-hide:all'><o:p>&nbsp;</o:p></span></p>
</div>
<p style='page-break-after:always'></p>";
        $new_div = 1;
        $row_count = 0;
    }


    $count++;

}


if($open_tr){
    echo "</tr>";
}
?>

</table>
<p class=MsoNormal style='margin-top:0cm;margin-right:18.9pt;margin-bottom:
0cm;margin-left:18.9pt;margin-bottom:.0001pt;'><span style='display:none;
mso-hide:all'><o:p>&nbsp;</o:p></span></p>
</div>
<p style='page-break-after:always'></p>

<!--    </table>-->
<!--</div>-->
<!---->