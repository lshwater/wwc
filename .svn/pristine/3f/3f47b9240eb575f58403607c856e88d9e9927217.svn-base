<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-folder-o page-header-icon"></i>&nbsp;&nbsp;<?=__("menus_item_20")?>

            <?
            if(isset($all) && $all){
                echo $this->Html->link(__("My Cases"), array('action' => 'viewpending', false), array('class'=>'label label-success'));
            }else{
                echo $this->Html->link(__("All Cases"), array('action' => 'viewpending', true), array('class'=>'label label-warning'));
            }
            ?>

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
            <table class="table table-striped nowrap" cellspacing="0" id="jq-datatables" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th><?php echo  __('Name'); ?></th>
                    <th><?php echo __('活動狀態'); ?></th>
                    <th><?php echo __('批核狀態'); ?></th>
                    <th><?php echo "批核"; ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($eventproposals as $eventproposal):
                    if($eventproposal['Approvalrecordstatus']['needalert']){
 //                   if(!$eventproposal['approved']){
                ?>
                    <tr>
                        <td></td>
                        <td>
                            <?php echo $this->Html->link(h($eventproposal['name']), array('action' => 'viewdetail', $eventproposal['id'])); ?>
                        </td>
                        <td>
                            <?php
                            if($eventproposal['closed']){
                                echo '<a href="#" class="label">'.__('已結束').'</a>';
                            }else{
                                echo '<a href="#" class="label label-success">'.__('進行中').'</a>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($eventproposal['approved']){
                                echo '<a href="#" class="label label-success">'.__('已批閱').'</a>';
                            }else{
                                echo '<a href="#" class="label ">'.__('未批閱').'</a>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="#" class="label <?=h($eventproposal['Approvalrecordstatus']['labelclass'])?>">
                            <?php echo h($eventproposal['Approvalrecordstatus']['name']); ?>
                            </a>
                        </td>

                    </tr>
                <?php
                    }
                endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<br >
<div class="row">
    <div class="col-sm-12">
        <div class="table-default">
            <table class="table table-striped nowrap" cellspacing="0" id="reporttable" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th><?php echo __('Name'); ?></th>
                    <th><?php echo __('活動狀態'); ?></th>
                    <th><?php echo __('批核狀態'); ?></th>
                    <th><?php echo "批核"; ?></th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($eventproposals as $k=>$eventproposal):
                  if($eventproposal['Eventfinalreport']['Approvalrecordstatus']['needalert']){
  //                  if(!empty($eventproposal['Eventfinalreport']) &&!$eventproposal['Eventfinalreport']['approved'] ){
                ?>
                    <tr>
                        <td></td>
                        <td>
                            <?php echo $this->Html->link(h($eventproposal['name']), array("controller"=>"Eventfinalreports",'action' => 'viewdetail', $eventproposal['Eventfinalreport']['id'])); ?>
                        </td>
                        <td>
                            <?php
                            if($eventproposal['Eventfinalreport']['closed']){
                                echo '<a href="#" class="label">'.__('已結束').'</a>';
                            }else{
                                echo '<a href="#" class="label label-success">'.__('進行中').'</a>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if($eventproposal['Eventfinalreport']['approved']){
                                echo '<a href="#" class="label label-success">'.__('已批閱').'</a>';
                            }else{
                                echo '<a href="#" class="label ">'.__('未批閱').'</a>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="#" class="label <?=h($eventproposal['Eventfinalreport']['Approvalrecordstatus']['labelclass'])?>">
                                <?php echo h($eventproposal['Eventfinalreport']['Approvalrecordstatus']['name']); ?>
                            </a>
                        </td>
                    </tr>
                <?php
                    }
                endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function () {
        $('#jq-datatables').dataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],
            order: [ 1, 'asc' ],
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
        $('#jq-datatables_wrapper .table-caption').text('<?=__('活動計劃書')?>');
        $('#jq-datatables_wrapper .dataTables_filter input').attr('placeholder', '<?=__('eventproposals_viewpending_table_placeholder')?>');

        $('#reporttable').dataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],
            order: [ 1, 'asc' ],
            language: {
                "sProcessing":   "<?=__('sProcessing')?>",
                "sLengthMenu":   "<?=__('sLengthMenu')?>",
                "sZeroRecords":  "<?=__('sZeroRecords')?>",
                "sInfo":         "<?=__('sInfo')?>",
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
        $('#reporttable_wrapper .table-caption').text('<?=__('活動報告書')?>');
        $('#reporttable_wrapper .dataTables_filter input').attr('placeholder', '<?=__('eventproposals_viewpending_table_placeholder')?>');

        $('.active-switcher').switcher({
            on_state_content: 'ON',
            off_state_content: 'OFF'
        });

        $('.active-switcher').click(function () {
            var obj = $(this);
            var member_id = obj.attr('data-user');
            var checkval = obj.is(':checked') ? 1 : 0;
            obj.switcher('disable');

            $.ajax({
                type: "POST",
                url: '<?=$this->Html->url(array('controller'=>'Members', 'action'=>'changeactive'))?>',
                data: {member_id: member_id, active: checkval},
                dataType: 'json'
            })
                .done(function (data) {
                    if (data.result) {
                        obj.val(data.active);
                        if (obj.val() == 1) {
                            obj.switcher('on');
                        } else {
                            obj.switcher('off');
                        }
                        obj.switcher('enable');
                    }
                    else {
                        alert('Active Fail! Please try again');
                    }


                })
                .fail(function () {
                    alert('Active Fail! Please try again');
                });
        });

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

    });
</script>