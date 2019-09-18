<?php $this->Html->script('daterangepicker/moment.min', array("inline"=>false)); ?>
<?php $this->Html->script('daterangepicker/daterangepicker', array("inline"=>false)); ?>

<?php $this->Html->css('daterangepicker/daterangepicker', array("inline"=>false)); ?>

<div class="page-header">

    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-center text-left-sm"><i class="fa fa-signal page-header-icon"></i>&nbsp;&nbsp;<?=__('Insight')?></h1>

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

        <!-- 6. $EXAMPLE_COMMENTS_COUNT ====================================================================

                        Comments count example
        -->
        <div class="stat-panel">
            <!-- Success background. vertically centered text -->
            <div class="stat-cell bg-success valign-middle">
                <!-- Stat panel bg icon -->
                <i class="fa fa-calendar bg-icon"></i>
                <!-- Extra large text -->
                <span class="text-xlg"><strong> <label id="session_count"><?=(!$session_count)?"0":$session_count?></label></strong></span> &nbsp;<span class="text-bg"><?=__('節活動')?></span><br>
                <!-- Big text -->
                <br>
                <!-- Small text -->
<!--                <span class="text-sm">New comments today</span>-->
            </div> <!-- /.stat-cell -->
        </div> <!-- /.stat-panel -->
        <!-- /6. $EXAMPLE_COMMENTS_COUNT -->

    </div>
</div>

<div class="row">
    <div class="col-sm-4">

        <!-- 6. $EXAMPLE_COMMENTS_COUNT ====================================================================

                        Comments count example
        -->
        <div class="stat-panel">
            <!-- Success background. vertically centered text -->
            <div class="stat-cell bg-info valign-middle">
                <!-- Stat panel bg icon -->
                <i class="fa fa-child bg-icon"></i>
                <!-- Extra large text -->
                <span class="text-xlg"><strong> <label id="applicant_count"><?=(!$applicant_count)?"0":$applicant_count?></label></strong></span> &nbsp;<span class="text-bg"><?=__('個參加者出席記錄')?></span><br>
                <!-- Big text -->
                <br>
                <!-- Small text -->
                <!--                <span class="text-sm">New comments today</span>-->
            </div> <!-- /.stat-cell -->
        </div> <!-- /.stat-panel -->
        <!-- /6. $EXAMPLE_COMMENTS_COUNT -->

    </div>

    <div class="col-sm-4">

        <!-- 6. $EXAMPLE_COMMENTS_COUNT ====================================================================

                        Comments count example
        -->
        <div class="stat-panel">
            <!-- Success background. vertically centered text -->
            <div class="stat-cell bg-warning valign-middle">
                <!-- Stat panel bg icon -->
                <i class="fa fa-male bg-icon"></i>
                <!-- Extra large text -->
                <span class="text-xlg"><strong> <label id="volunteer_count"><?=(!$volunteer_count)?"0":$volunteer_count?></label></strong></span> &nbsp;<span class="text-bg"><?=__('個義工出席記錄')?></span><br>
                <!-- Big text -->
                <br>
                <!-- Small text -->
                <!--                <span class="text-sm">New comments today</span>-->
            </div> <!-- /.stat-cell -->
        </div> <!-- /.stat-panel -->
        <!-- /6. $EXAMPLE_COMMENTS_COUNT -->

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

    $(document).ready(function () {

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

        $('#daterange span').html(moment().startOf('month').format('YYYY-MM-DD') + ' - ' + moment().endOf('month').format('YYYY-MM-DD'));

        $('#daterange').on('hide.daterangepicker', function(ev, picker) {
//            table.draw();
            console.log(picker.startDate.format('YYYY-MM-DD'));
            console.log(picker.endDate.format('YYYY-MM-DD'));

            $.ajax({
                type: "POST",
                url: "<?=$this->Html->url(array('action'=>'ajax_insight'))?>",
                data: {start_date: picker.startDate.format('YYYY-MM-DD'), end_date:picker.endDate.format('YYYY-MM-DD')},
                dataType: "json"
            })
                .done(function( msg ) {
                    if (!msg.errormsg) {
                        console.log(msg);
                        document.getElementById('session_count').innerHTML = msg.result['session_count'];
                        document.getElementById('applicant_count').innerHTML = msg.result['applicant_count'];
                        document.getElementById('volunteer_count').innerHTML = msg.result['volunteer_count'];
                    }else{
                        console.log(msg);
                        $("#error_msg").html(msg.errormsg);
                        $('#uidemo-modals-alerts-danger').modal();
                    }
                })

        });
    });
</script>