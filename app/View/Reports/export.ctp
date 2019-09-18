<?php $this->Html->script("datatable/dataTables.buttons.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/jszip.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/buttons.html5.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/buttons.flash.min", array("inline"=>false)); ?>
<?php $this->Html->css('datatable/buttons.dataTables.min', array("inline"=>false));?>
<?php $this->Html->script('daterangepicker/moment.min', array("inline"=>false)); ?>
<?php $this->Html->script('daterangepicker/daterangepicker', array("inline"=>false)); ?>
<?php $this->Html->css('daterangepicker/daterangepicker', array("inline"=>false)); ?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-bar-chart page-header-icon"></i>&nbsp;&nbsp;<?=__("reports_export_txt_1")?>
        </h1>
    </div>
</div>

<div class="panel-body">
    <div class="row">
        <div class="col-md-12">
            <div class="wizard ui-wizard-example">
                <div class="wizard-wrapper">
                    <ul class="wizard-steps">
                        <li data-target="#wizard-example-step1">
                            <span class="wizard-step-number">1</span>
                            <span class="wizard-step-caption">
                                <i class="fa fa-calendar"></i> 範圍
                                <span class="wizard-step-description">選擇日期及中心</span>
                            </span>
                        </li>
                        <li data-target="#wizard-example-step2">
                            <!-- ! Remove space between elements by dropping close angle -->
                            <span class="wizard-step-number">2</span>
								<span class="wizard-step-caption">
									<i class="fa fa-list"></i> 活動清單
									<span class="wizard-step-description">核對活動清單</span>
								</span>
                        </li>
                    </ul>
                    <!-- / .wizard-steps -->
                </div>
                <!-- / .wizard-wrapper -->
                <div class="wizard-content panel">
                    <div class="wizard-pane" id="wizard-example-step1">
                        <?php echo $this->Form->create('Report', array('class' => 'form-horizontal', "id"=>"step1form", "action"=>"ajax_getreport")); ?>
                            <div class="form-group no-padding-t no-border-t panel-padding-h">
                                <?=$this->Form->input('daterange', array('class'=>'form-control required', 'div'=>false, 'label'=>"日期範圍", 'default'=>'', 'placeholder'=>'日期範圍', 'id'=>'daterange'));?>
                            </div>
                            <div class="form-group no-padding-t no-border-t panel-padding-h">
                                <?=$this->Form->input('unit_id', array('class'=>'form-control select2 required', 'div'=>false, 'label'=>"單位", 'empty'=>true, 'placeholder'=>'單位', "id"=>"unit_id"));?>
                            </div>
                        <?php echo $this->Form->end(); ?>
                        <div class='text-right'>
                            <?= $this->Html->link('下一步 <i class="fa fa-angle-right"></i>', "javascript:step1next()", array('class' => 'btn btn-primary', 'data-loading-text' => 'Loading...', "id"=>"step1btn", 'escape'=>false)) ?>
                        </div>
                    </div>
                    <!-- / .wizard-pane -->
                    <div class="wizard-pane" id="wizard-example-step2" >
                        <div class='text-right'>
                            <?= $this->Html->link('<i class="fa fa-angle-left"></i> 上一步', "javascript:void(0)", array('class' => 'btn wizard-prev-step-btn', 'escape'=>false)) ?>
                            <?= $this->Html->link("<i class='fa fa-download'></i> 下載報告", "javascript:step2next()", array('class' => 'btn btn-primary wizard-next-step-btn', 'escape'=>false, 'data-loading-text' => 'Loading...', "id"=>"step2btn")) ?>
                        </div>
                        <div class="tab-content-padding">
                            <table cellspacing="0" class="table table-striped"  id="activity" width="100%">
                                <thead>
                                <th><?=__('類別')?></th>
                                <th><?=__('活動')?></th>
                                <th><?=__('日期')?></th>
                                <th><?=__('節數')?></th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- / .wizard-content -->
            </div>
            <!-- / .wizard -->
        </div>
    </div>
</div>

<script>
    var resulttable;

    function step1next() {
        $("#step1btn").button('loading');
        resulttable.clear().draw();

        $("#step1form").validate({
            ignore: '.ignore, .select2-input',
            focusInvalid: true
        });

        if($("#step1form").valid()){
            var obj = $("#step1btn");
            $.ajax({
                url: "<?=$this->Html->url(array('action'=>'ajax_getlist'));?>",
                type: "POST",
                data: { startdate: $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD'), enddate:$('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD'), unit_id: $("#unit_id").val()},
                dataType: "json"
            }).done(function (msg) {
                    console.log(msg);
                    if(msg){
                        $.each(msg, function( index, value ) {
                            resulttable.row.add( [
                                escapeHtml(value.Activity['activity_code']),
                                escapeHtml(value.Activity['name']),
                                escapeHtml(value.Activitysession['date']),
                                escapeHtml(value.Activitysession['session'])
                            ]).draw( false );

                        });
                    }
                    $("#step1btn").button('reset');
                    $("#step1btn").parents('.ui-wizard-example').pixelWizard('nextStep');
                });
        }else{
            $("#step1btn").button('reset');
        }
    }

    function step2next(){
        $("#step1form").submit();
    }

    $(document).ready(function () {
        resulttable = $('#activity').DataTable({
            dom: '<"top"Bf<"clear">>rt<"bottom"lip<"clear">>',
            "columnDefs": [
                { "visible": false, "targets": 0 }
            ],
            "order": [[ 0, 'asc' ]],
            "drawCallback": function ( settings ) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;

                api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                            '<tr class="group"><td colspan="3">'+group+'</td></tr>'
                        );

                        last = group;
                    }
                } );
            },
            buttons: [
                'copy',
                'excel'
            ],
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
            }
        });


        $('#activity tbody').on( 'click', 'tr.group', function () {
            var currentOrder = resulttable.order()[0];
            if ( currentOrder[0] === 0 && currentOrder[1] === 'asc' ) {
                resulttable.order( [ 0, 'desc' ] ).draw();
            }
            else {
                resulttable.order( [ 0, 'asc' ] ).draw();
            }
        } );

        $('.wizard-prev-step-btn').click(function () {
            $(this).parents('.ui-wizard-example').pixelWizard('prevStep');
        });

        $('.ui-wizard-example').pixelWizard({
            onChange: function () {
                $.fn.dataTable.tables( { visible: true, api: true } ).buttons.resize();
            },
            onStepChanging: function(){
            },
            onFinish: function () {
                this.freeze();
            }
        });

        $('#daterange').on('hide.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
        });


        var datepicker = $('#daterange').daterangepicker({
            ranges: {
                '本年1月至3月': [moment(1, "MM"), moment(3, "MM").endOf('month')],
                '本年4月至6月': [moment(4, "MM"), moment(6, "MM").endOf('month')],
                '本年7月至9月': [moment(7, "MM"), moment(9, "MM").endOf('month')],
                '本年10月至12月': [moment(10, "MM"), moment(12, "MM").endOf('month')]
            },
            "dateLimit": {
                "months": 3
            },
            startDate: moment(1, "MM"),
            endDate:  moment(3, "MM").endOf('month'),
            autoUpdateInput: false,
            autoApply: true,
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
                ],
                format: 'YYYY-MM-DD'
            }
        });

    });

</script>

<style>
    /*.ranges li:last-child { display: none; }*/
    tr.group,
    tr.group:hover {
        background-color: #ddd !important;
    }
</style>