<?php $this->Html->script('daterangepicker/moment.min', array("inline"=>false)); ?>
<?php $this->Html->script('daterangepicker/daterangepicker', array("inline"=>false)); ?>

<?php $this->Html->css('daterangepicker/daterangepicker', array("inline"=>false)); ?>
<?Configure::write('debug', 2);


//debug($activities);
?>
<div class="page-header">

    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-signal page-header-icon"></i>&nbsp;&nbsp;<?=__('Analytics')?></h1>

    </div>
</div> <!-- / .page-header -->

<div class="row">
    <div class="col-sm-12">
        <?=__('匯報日期')?> ：
        <div class="btn-group">
            <div id="daterange" class="form-control col-sm-6" style="background: #fff; cursor: pointer;"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i> &nbsp;<span></span><b class="caret"></b></div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group no-margin">
            <?=$this->Form->label("activitygroup_id", __('活動類別'). " ：", "col-sm-3 control-label no-padding no-margin "); ?>
            <div class="col-sm-8 no-padding">
                <?=$this->Form->input('activitygroup_id', array('options'=>$activitygroup_id,'class'=>'form-control myselect ', 'div'=>true, 'label'=>false, 'empty'=>true, "id"=>"activitygroup_id"));?>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group no-margin">
            <?=$this->Form->label("user_id", __('職員'). " ：", "col-sm-2 control-label no-padding no-margin "); ?>
            <div class="col-sm-6 no-padding">
            <?=$this->Form->input('user_id', array('options'=>$user_list,'class'=>'form-control myselect', 'div'=>true, 'label'=>false, 'empty'=>true, "id"=>"user_id"));?>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group no-margin">
            <?=$this->Form->label("unit_id", __('單位'). " ：", "col-sm-3 control-label no-padding no-margin "); ?>
            <div class="col-sm-4 no-padding">
                <?=$this->Form->input('unit_id', array('options'=>$unit_id,'class'=>'form-control myselect ', 'div'=>true, 'label'=>false, 'empty'=>true, "id"=>"unit_id"));?>
            </div>
        </div>
    </div>

</div>

<br>

<div class="row">
    <div class="col-sm-12">
        <div class="table-default">
            <table cellspacing="0" class="table table-striped"  id="resulttable" width="100%">
<!--            <table cellspacing="0" class="table table-striped nowrap"  id="resulttable" >-->
                <colgroup>
                    <col class="col-xs-1">
                    <col class="col-xs-1">
                    <col class="col-xs-1">
                    <col class="col-xs-1">
                    <col class="col-xs-1">
                    <col class="col-xs-1">
                    <col class="col-xs-1">
                    <col class="col-xs-1">
                    <col class="col-xs-1">
                    <col class="col-xs-1">
                    <col class="col-xs-1">
                </colgroup>
                <thead>
                <tr>
                    <th><?=__('活動名稱')?></th>
                    <th><?=__('總節數')?></th>
                    <th><?=__('會員出席人數')?></th>
                    <th><?=__('參加會員人數')?></th>
                    <th><?=__('義工出席人數')?></th>
                    <th><?=__('參加義工人數')?></th>
                    <th><?=__('會員出席人數')?><span class='text-xs text-default'>&nbsp;(<?=__('參加會員人數')?>)</span></th>
                    <th><?=__('義工出席人數')?><span class='text-xs text-default'>&nbsp;(<?=__('參加義工人數')?>)</span></th>
                    <th><?=__('總出席人數')?><span class='text-xs text-default'>&nbsp;(<?=__('總人數')?>)</span></th>
                    <th><?=__('開始日期')?></th>
                    <th><?=__('結束日期')?></th>
                    <th><?=__('activity_id')?></th>
                </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th><?=__('總覽')?> : </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>

                <?php

                if(!empty($activities)){
                    foreach ($activities as $activity): ?>
                        <tr>
                            <td><a href="#"><?php echo h($activity['Activity']['name']);?></a>
                                <?if(!empty($activity['Activity']['activity_code'])){
                                    echo "<br /><span class='text-xs text-default'>".$activity['Activity']['activity_code']."</span>";
                                }?></td>
                            <td><?php echo h($activity[0]['total_session_count']); ?></td>
                            <td><?php echo h($activity['Activity']['applicant_count']); ?></td>
                            <td><?php echo h($activity['Activity']['total_applicant_count']); ?></td>
                            <td><?php echo h($activity['Activity']['volunteer_count']); ?></td>
                            <td><?php echo h($activity['Activity']['total_volunteer_count']); ?></td>
                            <td><?php echo h($activity['Activity']['applicant_count'])."<span class='text-xs text-default'>&nbsp;(".$activity['Activity']['total_applicant_count'].")</span>"; ?></td>
                            <td><?php echo h($activity['Activity']['volunteer_count'])."<span class='text-xs text-default'>&nbsp;(".$activity['Activity']['total_volunteer_count'].")</span>"; ?></td>
                            <td><?php echo $activity['Activity']['volunteer_count']+$activity['Activity']['applicant_count']."<span class='text-xs text-default'>&nbsp;(".($activity['Activity']['total_volunteer_count']+ $activity['Activity']['total_applicant_count']).")</span>"; ?></td>
                            <td><?php echo h($activity['Activity']['startdate']); ?></td>
                            <td><?php echo h($activity['Activity']['enddate']); ?></td>
                            <td><?php echo h($activity['Activity']['id']); ?></td>
                        </tr>
                    <?php endforeach;
                }
                ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<div id="uidemo-modals-alerts-danger" class="modal modal-alert modal-danger fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-times-circle"></i>
            </div>
            <div class="modal-title"><?=__('錯誤')?></div>
            <div class="modal-body" id="error_msg"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?=__('確認')?></button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->

<script>
    function cb(start, end) {
        $('#daterange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
    }

    var startdate = moment().startOf('month').format('YYYY-MM-DD');
    var enddate = moment().endOf('month').format('YYYY-MM-DD');
    var user_id = null;
    var activitygroup_id = null;
    var unit_id = null;
    var resulttable = null;


    function update_stat(user_id,startdate,enddate,activitygroup_id,unit_id){


        resulttable.clear().draw();

        $.ajax({
            type: "POST",
            url: "<?=$this->Html->url(array('action'=>'ajax_activity_analytics'))?>",
            data: {user_id: user_id, start_date: startdate, end_date:enddate, activitygroup_id:activitygroup_id, unit_id:unit_id},
            dataType: "json"
        })
            .done(function( msg ) {
                if (!msg.errormsg) {

                    if(msg.result['activities']){
                        $.each(msg.result['activities'], function( index, value ) {
                            resulttable.row.add( [
                                "<a href='#'>"+escapeHtml(value['Activity']['name'])+"</a>"+"<br><span class='text-xs text-default'>"+escapeHtml(value['Activity']['activity_code'])+"</span>",
                                escapeHtml(value[0]['total_session_count']),
                                escapeHtml(value['Activity']['applicant_count']),
                                escapeHtml(value['Activity']['total_applicant_count']),
                                escapeHtml(value['Activity']['volunteer_count']),
                                escapeHtml(value['Activity']['total_volunteer_count']),
                                escapeHtml(value['Activity']['applicant_count'])+"<span class='text-xs text-default'>&nbsp;("+escapeHtml(value['Activity']['total_applicant_count'])+")</span>",
                                escapeHtml(value['Activity']['volunteer_count'])+"<span class='text-xs text-default'>&nbsp;("+escapeHtml(value['Activity']['total_volunteer_count'])+")</span>",
                                ((parseInt(value['Activity']['volunteer_count']))+ parseInt(value['Activity']['applicant_count'])) +"<span class='text-xs text-default'>&nbsp;("+(parseInt(value['Activity']['total_volunteer_count'])+ parseInt(value['Activity']['total_applicant_count']))+")</span>",
                                escapeHtml(value['Activity']['startdate']),
                                escapeHtml(value['Activity']['enddate']),
                                escapeHtml(value['Activity']['id'])
                            ]).draw( false );
                        });
                    }

                }else{
                    console.log(msg);
                    $("#error_msg").html(msg.errormsg);
                    $('#uidemo-modals-alerts-danger').modal();
                }
            })
    }

    function format (list){
        var table =
            '<table class="table table-condensed" cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #99ccff;">'+
                '<colgroup>'+
                '<col class="col-xs-1">'+
                '<col class="col-xs-1 hidden-xs hidden-sm">'+
                '<col class="col-xs-1">'+
                '<col class="col-xs-1">'+
                '<col class="col-xs-1">'+
                '<col class="col-xs-1 hidden-xs hidden-sm">'+
                '<col class="col-xs-1 hidden-xs hidden-sm">'+
                '</colgroup>'+
                '<thead>'+
                '<tr>'+
                '<th><?=__('日期')?></th>'+
                '<th class="hidden-xs hidden-sm"><?=__('節數')?></th>'+
                '<th><?=__('會員出席人數')?><span class="text-xs text-default">&nbsp;(<?=__('參加會員人數')?>)</span></th>'+
                '<th><?=__('義工出席人數')?><span class="text-xs text-default">&nbsp;(<?=__('參加義工人數')?>)</span></th>'+
                '<th><?=__('總出席人數')?><span class="text-xs text-default">&nbsp;(<?=__('總人數')?>)</span></th>'+
                '<th class="hidden-xs hidden-sm"><?=__('開始時間')?></th>'+
                '<th class="hidden-xs hidden-sm"><?=__('結束時間')?></th>'+
                '</tr>'+
                '</thead>';

        var tbody = '<tbody>';
        $.each(list, function( index, value ) {
            var newrow =
                '<tr>'+
                '<td>' +escapeHtml(value['Activitysession']['date'])+'</td>'+
                '<td class="hidden-xs hidden-sm">' +escapeHtml(value['Activitysession']['session'])+'</td>'+
                '<td>' +escapeHtml(value['Activitysession']['applicant_count'])+'<span class="text-xs text-default">&nbsp;('+escapeHtml(value['Activitysession']['total_applicant_count'])+")</span>"+
                '<td>' +escapeHtml(value['Activitysession']['volunteer_count'])+'<span class="text-xs text-default">&nbsp;('+escapeHtml(value['Activitysession']['total_volunteer_count'])+")</span>"+
                '<td>' +(parseInt(value['Activitysession']['volunteer_count'])+ parseInt(value['Activitysession']['applicant_count']))+'<span class="text-xs text-default">&nbsp;('+(parseInt(value['Activitysession']['total_volunteer_count'])+parseInt(value['Activitysession']['total_applicant_count']))+")</span>"+
                '<td class="hidden-xs hidden-sm">' +escapeHtml(value['Activitysession']['starttime'])+'</td>'+
                '<td class="hidden-xs hidden-sm">' +escapeHtml(value['Activitysession']['endtime'])+'</td>'+
                '</tr>';
            tbody += newrow;
        });
        tbody += '</tbody>';
        table += tbody +'</table>';
        return table;
    }

    $(document).ready(function () {

        resulttable= $('#resulttable').DataTable(
            {
//                "responsive": {
//                    "details": {
//                        "renderer": function ( api, rowIdx ) {
//                            var theRow = api.row(rowIdx);
//
//                            var data = api.cells(rowIdx, ':hidden').eq(0).map(function (cell) {
//                                console.log($( api.cell( cell.column)));
//                                var header = $(api.column(cell.column).header());
//
//                                return '<tr>' +
//                                    '<td><b>' +
//                                    header.text() + ':' +
//                                    '</b></td> ' +
//                                    '<td>' +
//                                    $( api.cell( cell ).node() ).html() +
//                                    '</td>' +
//                                    '</tr>';
//                            }).toArray().join('');
//
//                            return data ?
//                                $('<table/>').append(data) :
//                                false;
//                        }
//                    }
//                },
//                searching: false,
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
                "columnDefs": [
                    {
                        className: 'hidden-xs hidden-sm',
                        "targets": [ 1 ],
                    },
                    {
                        className: 'never',
                        "targets": [ 2 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        className: 'never',
                        "targets": [ 3 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        className: 'never',
                        "targets": [ 4 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        className: 'never',
                        "targets": [ 5 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        className: 'hidden-xs hidden-sm',
                        "targets": [ 9 ]
                    },
                    {
                        className: 'hidden-xs hidden-sm',
                        "targets": [ 10 ]
                    },
                    {
                        className: 'never',
                        "targets": [ 11 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
                    $('td:eq(0)', nRow).addClass( "details-control" );
                },
                "footerCallback": function ( row, data, start, end, display ) {

                    var api = this.api(), data;

                    session_count = api
                        .column( 1)
                        .data()
                        .reduce( function (a, b) {
                            return parseInt(a)+parseInt(b);
                        }, 0 );

                    $( api.column( 1 ).footer() ).html(
                        session_count
                    );

                    applicant_count = api
                        .column( 2)
                        .data()
                        .reduce( function (a, b) {
                            return parseInt(a)+parseInt(b);
                        }, 0 );

                    total_applicant_count = api
                        .column( 3)
                        .data()
                        .reduce( function (a, b) {
                            return parseInt(a)+parseInt(b);
                        }, 0 );

                    volunteer_count = api
                        .column( 4)
                        .data()
                        .reduce( function (a, b) {
                            return parseInt(a)+parseInt(b);
                        }, 0 );

                    total_volunteer_count = api
                        .column( 5)
                        .data()
                        .reduce( function (a, b) {
                            return parseInt(a)+parseInt(b);
                        }, 0 );

                    $( api.column( 6 ).footer() ).html(
                        applicant_count + "<span class='text-xs text-default'>&nbsp;(" + total_applicant_count + ")</span>"
                    );

                    $( api.column( 7 ).footer() ).html(
                        volunteer_count + "<span class='text-xs text-default'>&nbsp;(" + total_volunteer_count + ")</span>"
                    );

                    $( api.column( 8 ).footer() ).html(
                        (parseInt(volunteer_count) + parseInt(applicant_count)) + "<span class='text-xs text-default'>&nbsp;(" + (parseInt(total_volunteer_count) + parseInt(total_applicant_count))+ ")</span>"
                    );
                }
            }
        );


        $('#resulttable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = resulttable.row( tr );
            if ( row.child.isShown() ) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                $.ajax({
                    type: "POST",
                    url: "<?=$this->Html->url(array('action'=>'ajax_session_analytics'))?>",
                    data: {user_id: user_id, start_date: startdate, end_date:enddate, activitygroup_id:activitygroup_id, unit_id:unit_id, activity_id:row.data()[11]},
                    dataType: "json"
                })
                    .done(function( msg ) {
//                        console.log(msg);
                        if (!msg.errormsg) {
                            if(msg.result['sessions']){
                                row.child( format(msg.result['sessions'])).show();
                                tr.addClass('shown');
                            }
                        }else{
                            console.log(msg);
                            $("#error_msg").html(msg.errormsg);
                            $('#uidemo-modals-alerts-danger').modal();
                        }
                    });
            }
        } );





        $('.myselect').select2({
            allowClear: true
        }).on("change",function(){
            if($('#user_id').val()){
                user_id = $('#user_id').val();
                unit_id = null;
                $('#unit_id').attr('disabled','disabled');

            }else if($('#unit_id').val()){
                unit_id = $('#unit_id').val();
                user_id = null;
                $('#user_id').attr('disabled','disabled');
            }else{
                unit_id = user_id = null;
                $('#user_id').removeAttr("disabled");
                $('#unit_id').removeAttr("disabled");
            }


            if($('#activitygroup_id').val()){
                activitygroup_id = $('#activitygroup_id').val();
            }else{
                activitygroup_id = null;
            }


            update_stat(user_id,startdate,enddate,activitygroup_id,unit_id);

        });

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

        $('#daterange').data('daterangepicker').setStartDate(moment().startOf('month'));
        $('#daterange').data('daterangepicker').setEndDate(moment().endOf('month'));

        $('#daterange span').html(startdate + ' - ' + enddate);

        $('#daterange').on('hide.daterangepicker', function(ev, picker) {
            startdate = picker.startDate.format('YYYY-MM-DD');
            enddate = picker.endDate.format('YYYY-MM-DD');
            update_stat(user_id,startdate,enddate,activitygroup_id,unit_id);


        });
    });
</script>