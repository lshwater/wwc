<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage"><i class="fa fa-folder-o page-header-icon"></i>&nbsp;&nbsp;<?=__("menus_item_15")?>
        </h1>
        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- Margin -->
                <div class="visible-xs clearfix form-group-margin"></div>

                <!-- Search field -->
                <?php echo $this->Form->create('Eventproposal', array('class'=>'pull-right col-xs-12 col-sm-6')); ?>
                <div class="no-margin form-group">
                    <?php echo $this->Form->input('filter', array(
                            'div'=>false, 'label'=>false, 'default'=>1,
                            'class'=>'form-control no-padding-hr select2 filterauto', 'placeholder'=>__("選擇顯示方式"), "options"=>array("1"=>__("顯示進行中"), "2"=>__("顯示已結束"), "3"=>__("顯示所有")),
                            'style'=>'width:250px;',
                        )
                    ); ?>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-condensed table-hover" id="jq-datatables">
                <thead>
                <tr>
                    <th><?=__('計劃')?></th>
                    <th style="width:160px"><?=__('角色')?></th>
                    <th style="width:100px"><?=__('活動狀態')?></th>
                    <th style="width:100px"><?=__('批核狀態')?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($eventproposals as $eventproposal):
                    $incharge = "";
                    $sharelabel = "";
                    $supervisorlabel = "";
                    if($eventproposal['Eventproposal']['share']){
                        $sharelabel = '<a href="#" class="label label-info">'.__('參與').'</a>';
                    }
                    if($eventproposal['Eventproposal']['supervisor']){
                        $supervisorlabel = '<a href="#" class="label label-warning">'.__('Supervisor').'</a>';
                    }
                    if($eventproposal['Eventproposal']['user_id'] == $auth['id']){
                        $incharge  = '<a href="#" class="label label-primary">'.__('負責人').'</a>';
                    }
                ?>
                    <tr>
                        <td>
                            <?php echo $this->Html->link(h($eventproposal['Eventproposal']['name']), array('action' => 'view', $eventproposal['Eventproposal']['id'])); ?>
                            <?
                                if(!empty($eventproposal['Eventproposal']['event_code'])){
                                    echo "<br /><span class='text-sm text-default'>".$eventproposal['Eventproposal']['event_code']."</span>";
                                }
                            ?>
                        </td>
                        <td><?=$incharge?> <?=$sharelabel?> <?=$supervisorlabel?></td>
                        <td>
                            <?php
                            if($eventproposal['Eventproposal']['closed']){
                                echo '<a href="#" class="label">'.__('已結束').'</a>';
                            }else{
                                echo '<a href="#" class="label label-success">'.__('進行中').'</a>';
                            }
                            ?>
                        </td>
                        <td>
                        <?php
                            if($eventproposal['Eventproposal']['approved']){
                                echo '<a href="#" class="label label-success">'.__('已批閱').'</a>';
                            }else{
                                echo '<a href="#" class="label ">'.__('未批閱').'</a>';
                            }
                        ?>
                        </td>

                    </tr>
                <?php endforeach; ?>
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
        $('#jq-datatables_wrapper .table-caption').text('<?=__('units_index_table_title')?>');
        $('#jq-datatables_wrapper .dataTables_filter input').attr('placeholder', '<?=__('search')?>');


        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

        $(".filterauto").on("change", function(){
            $(this).closest("form").submit();
        });

    });
</script>