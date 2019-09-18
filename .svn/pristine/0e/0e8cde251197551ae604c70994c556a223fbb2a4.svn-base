<?php $this->Html->script('daterangepicker/moment.min', array("inline"=>false)); ?>
<?php $this->Html->script('daterangepicker/daterangepicker', array("inline"=>false)); ?>

<?php $this->Html->css('daterangepicker/daterangepicker', array("inline"=>false)); ?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-futbol-o page-header-icon"></i>&nbsp;&nbsp;<?=__("我的活動")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="table-default">
            <table cellspacing="0" class="table table-striped nowrap"  id="jq-datatables" width="100%">
                <thead>
                    <th><?=__('活動')?></th>
                    <th><?=__('活動名')?></th>
                    <th><?=__('開始')?></th>
                    <th><?=__('結束')?></th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- /5. $DEFAULT_TABLES -->
    </div>
</div>

<script>
    function cb(start, end) {
        $('#daterange span').html(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    }

    $(document).ready(function () {

        var table = $('#jq-datatables').DataTable({
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
            "order": [[ 0, "desc" ]],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?=$this->Html->url(array("action"=>"ajax_search", 'me', 'publish'=>''))?>",
            "fnServerParams": function ( aoData ) {
                if(!$.isEmptyObject($('#daterange').data('daterangepicker'))){
                    if(moment($('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD')).isValid() && moment($('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD')).isValid()){
                        aoData.push(
                            { "name": "startdate", "value": $('#daterange').data('daterangepicker').startDate.format('YYYY-MM-DD') }
                        );
                        aoData.push(
                            { "name": "enddate", "value": $('#daterange').data('daterangepicker').endDate.format('YYYY-MM-DD') }
                        );
                    }
                }

            },
            "aoColumns": [
                {mData:"Activity.activity_code"},
                {mData:"Activity.name"},
                {mData:"Activity.startdate", bSearchable: false},
                {mData:"Activity.enddate", bSearchable: false}
            ],
            "aoColumnDefs":[
                {
                    "aTargets": [ 0 ],
                    "mRender": function ( aData, type, full ) {
                        return '<a href="<?=$this->Html->url(array('controller'=>'eventproposals', 'action'=>'view'))?>/'+full.Activity.eventproposal_id+'#tab'+full.Activity.id+'">'+full.Activity.name+" </a><br />"+full.Activity.activity_code;
                    }
                },
                {
                    "targets": [ 1 ],
                    "visible": false
                }
            ]
        });

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