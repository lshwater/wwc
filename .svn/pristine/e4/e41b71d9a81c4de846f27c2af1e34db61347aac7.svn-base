<?php $this->Html->script('daterangepicker/moment.min', array("inline"=>false)); ?>
<?php $this->Html->script('daterangepicker/daterangepicker', array("inline"=>false)); ?>

<?php $this->Html->css('daterangepicker/daterangepicker', array("inline"=>false)); ?>

<ul class="breadcrumb modaloff">
    <li>
        <?=$this->Html->link("返回", $redirecturl)?>
    </li>
    <li class="active">查看資料</li>
</ul>

<div class="modal-header">
    <span class="panel-title"><?=__('義工資料')?></span>
    <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <colgroup>
                <col class="col-xs-3">
                <col class="col-xs-5">
            </colgroup>
            <thead>
            <tr>
                <th><?php echo __('table_content'); ?></th>
                <th><?php echo __('table_details'); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php
                $target = "";
                foreach ($volunteer['Volunteertype'] as $volunteertype){
                    $target .= '<span class="label label-info label-tag">'.h($volunteertype['name']).'</span> ';
                }
                ?>
                <td><?php echo __('義工類別'); ?></td>
                <td><?php echo $target; ?>&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo __('中文姓名'); ?></td>
                <td><?php echo h($volunteer['Volunteer']['c_name']); ?>&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo __('英文姓名'); ?></td>
                <td><?php echo h($volunteer['Volunteer']['e_name']); ?>&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo __('別名'); ?></td>
                <td><?php echo h($volunteer['Volunteer']['other_name']); ?>&nbsp;</td>
            </tr>
            <?if(!empty($volunteer['Volunteer']['identity'])){?>
            <tr>
                <td><?php echo h($volunteer['Identitytype']['name']); ?></td>
                <td><?php echo h($volunteer['Volunteer']['identity']); ?></td>
            </tr>
            <?}?>
            <tr>
                <td><?php echo __('性別'); ?></td>
                <td><?php echo h($volunteer['Gender']['name']); ?>&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo __('出生日期'); ?></td>
                <td><?php echo h($volunteer['Volunteer']['dob']); ?>&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo __('電話(主要)'); ?></td>
                <td><?php echo h($volunteer['Volunteer']['phone_main']); ?>&nbsp;</td>

            <tr>
                <td><?php echo __('電話(其他)'); ?></td>
                <td><?php echo h($volunteer['Volunteer']['phone_other']); ?>&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo __('地址'); ?></td>
                <td><?php echo h($volunteer['Volunteer']['address']); ?>&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo __('電子郵箱'); ?></td>
                <td><?php echo h($volunteer['Volunteer']['email']); ?>&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo __('Facebook'); ?></td>
                <td><?php echo h($volunteer['Volunteer']['facebook']); ?>&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo __('工作狀態'); ?></td>
                <td><?php echo h($volunteer['Employmentstatus']['name']); ?>&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo __('學歷'); ?></td>
                <td><?php echo h($volunteer['Educationlevel']['name']); ?>&nbsp;</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
    <div class="modal-header">
        <span class="panel-title"><?=__('服務資料')?></span>
    </div>
<div class="modal-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <colgroup>
                <col class="col-xs-3">
                <col class="col-xs-5">
            </colgroup>
            <thead>
            <tr>
                <th><?php echo __('table_content'); ?></th>
                <th><?php echo __('table_details'); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo __('希望服務對象'); ?></td>
                <?php
                $target = "";
                foreach ($volunteer['Eventproposaltarget'] as $eventproposaltarget){
                    $target .= '<span class="label label-info label-tag">'.h($eventproposaltarget['name']).'</span> ';
                }
                ?>
                <td><?php echo $target; ?>&nbsp;</td>
            </tr>
            <tr>
                <td><?php echo __('能提供義工服務的時間'); ?></td>
                <?php
                $target = "";
                foreach ($volunteer['Availability'] as $index=>$aval){
                    $target .= '<span class="label label-info label-tag">'.h($availabilities[$index]['Availability']['day']).' - '.h($availabilities[$index]['Availability']['session']).'</span> ';
                }
                ?>
                <td><?php echo $target; ?>&nbsp;</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
    <div class="modal-header">
        <span class="panel-title"><?=__('活動紀錄')?></span>
    </div>
<div class="modal-body">
    <div class="table-responsive">
        <table cellspacing="0" class="table table-striped" id="jq-datatables">
            <thead>
            <tr>
                <th><?php echo __('活動名稱'); ?></th>
                <th><?php echo __('日期'); ?></th>
                <th><?php echo __('服務時數'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?
            foreach($volunteer['ActivitiesVolunteer'] as $activity){
                ?>
               <tr>
                    <td><?php echo $activity['Activity']['name']; ?></td>
                    <td><?php echo $activity['Activity']['startdate']; ?></td>
                    <td>
                        <a href="#" data-pk="<?=$activity['id']?>" data-placeholder="服務時數..." data-title="服務時數" data-type="number" class="" id='cell<?=$activity['id']?>'><?=h($activity['servicehour_count'])?></a>
                    </td>
                </tr>
            <?
            }
            ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" style="text-align:right">Total:</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
    function cb(start, end) {
        $('#daterange span').html(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    }

    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            if(!$.isEmptyObject($('#daterange').data('daterangepicker'))){
                var start = $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD');
                var end = $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD');
                var tablestartdate = data[1]; // use data for the age column

                if(!moment($('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD')).isValid() || !moment($('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD')).isValid()){
                    return true;
                }else{
                    if(!(moment(tablestartdate).isBefore(start) || moment(tablestartdate).isAfter(end))){
                        return true;
                    }
                }
                return false;
            }else{
                return true;
            }
        }
    );

    $(document).ready(function () {
        var abc = "HI";
        var table = $('#jq-datatables').DataTable( {
            dom: '<"top"<"toolbar">f<"clear">>rt<"bottom"lip<"clear">>',
            language: {
                "sProcessing":   "<?=__('sProcessing')?>",
                "sLengthMenu":   "<?=__('sLengthMenu')?>",
                "sZeroRecords":  "<?=__('sZeroRecords')?>",
                "sInfo":         "<?=__('sInfo')?>",
                "sSearch":         "<?=__('sSearch')?>",
                "sInfoEmpty":    "<?=__('sInfoEmpty')?>",
                "sInfoFiltered": "<?=__('sInfoFiltered')?>",
                "oPaginate": {
                    "sFirst":    "<?=__('sFirst')?>",
                    "sPrevious": "<?=__('sPrevious')?>",
                    "sNext":     "<?=__('sNext')?>",
                    "sLast":     "<?=__('sLast')?>"
                }
            },
            "fnRowCallback": function( nRow, mData, iDisplayIndex ) {
                $('td:eq(2) a', nRow).editable({
                        url: '<?=$this->Html->url(array("controller"=>"activitiesVolunteers",'action'=>'ajax_setservicehour'))?>',
                    success : function(response, newValue) {
                        var cellid = $('td:eq(2) a', nRow).attr('id');
                        var obj = $("#"+cellid).closest('td');
//                        console.log(obj);
                        var orghtml = table.cell( obj ).data();
                        var htmlObject = $("<div>"+orghtml+"</div>");
                        htmlObject.find('a').html(newValue);
                        table.cell(obj).data(htmlObject.html());
                        table.draw(false);
                   }
                });

            },
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                searchtotal = api
                    .column( 2, { search: 'applied'} )
                    .data()
                    .reduce( function (a, b) {
                        if(typeof a === 'nmuber'){
                            var left = parseInt(a);
                        }else{
                            var left = parseInt(jQuery('<a>').html(a).text());
                        }
                        left = isNaN(left)?0:left;


                        if(typeof b === 'nmuber'){
                            var right = parseInt(b);
                        }else{
                            var right = parseInt(jQuery('<a>').html(b).text());
                        }

                        right = isNaN(right)?0:right;
                        return left+right;
                    }, 0 );

                $( api.column( 2 ).footer() ).html(
                    searchtotal
                );
            }
        } );

        $("div.toolbar").html('<div id="daterange" class="form-control col-sm-6" style="background: #fff; cursor: pointer;">開始日期 &nbsp;<span></span><b class="caret"></b></div>');

        var datepicker = $('#daterange').daterangepicker({
            ranges: {
                '最近3個月': [moment().subtract(2, 'month').startOf('month'), moment().endOf('month')],
                '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                '本月': [moment().startOf('month'), moment().endOf('month')],
                '下月': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')],
                '未來3個月': [moment().startOf('month'), moment().add(2, 'month').endOf('month')]
            },
            locale: {
                "applyLabel": "<?=__("Apply")?>",
                "cancelLabel": "<?=__("Cancel")?>",
                "fromLabel": "<?=__("From")?>",
                "toLabel": "<?=__("To")?>",
                "customRangeLabel": "<?=__("Custom")?>",
                "daysOfWeek": [
                    "<?=__("Su")?>",
                    "<?=__("Mo")?>",
                    "<?=__("Tu")?>",
                    "<?=__("We")?>",
                    "<?=__("Th")?>",
                    "<?=__("Fr")?>",
                    "<?=__("Sa")?>"
                ],
                "monthNames": [
                    "<?=__("January")?>",
                    "<?=__("February")?>",
                    "<?=__("March")?>",
                    "<?=__("April")?>",
                    "<?=__("May")?>",
                    "<?=__("June")?>",
                    "<?=__("July")?>",
                    "<?=__("August")?>",
                    "<?=__("September")?>",
                    "<?=__("October")?>",
                    "<?=__("November")?>",
                    "<?=__("December")?>"
                ]
            }
        }, cb);

        $('#daterange').data('daterangepicker').setStartDate('');
        $('#daterange').data('daterangepicker').setEndDate('');

        $('#daterange').on('hide.daterangepicker', function(ev, picker) {
            table.draw();
        });

        $('#daterange').on('cancel.daterangepicker', function(ev, picker) {
            //do something, like clearing an input
            $('#daterange').data('daterangepicker').setStartDate('');
            $('#daterange').data('daterangepicker').setEndDate('');
            $('#daterange span').html("");
            table.draw();

        });



    });

</script>

