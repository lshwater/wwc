<?php $this->Html->script("datatable/dataTables.buttons.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/jszip.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/buttons.html5.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/buttons.flash.min", array("inline"=>false)); ?>
<?php $this->Html->css('datatable/buttons.dataTables.min', array("inline"=>false));?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on sm  all screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-bars page-header-icon"></i>&nbsp;&nbsp;管理<?=h($volunteertype['Volunteertype']['name'])?>名單
        </h1>

        <div class="pull-right col-xs-12 col-sm-auto">
            <?php echo $this->Html->link('<span class="btn-label icon fa fa-search"></span> 出席情況', array('action' => 'viewallattendant' , $activity['Activity']['id'], $volunteertype['Volunteertype']['id']), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled')); ?>
            <?php echo $this->Html->link('<span class="btn-label icon fa fa-print"></span> 點名表', array('action' => 'exportattendentsheet' , $activity['Activity']['id'], $volunteertype['Volunteertype']['id']), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled')); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel colourable">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-info-circle"></i> 活動資料</span>
            </div>

            <!-- Table -->
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            活動名稱
                        </td>
                        <td colspan="3">
                            <strong><?=h($activity['Activity']['name'])?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            活動編號
                        </td>
                        <td>
                            <?=h(h($activity['Activity']['activity_code']))?>
                        </td>
                        <td>
                            報名人數
                        </td>
                        <td>
                            <?=h($enroled)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            活動日期
                        </td>
                        <td>
                            <?=h($activity['Activity']['startdate'])?>
                        </td>
                        <td>
                            至
                        </td>
                        <td>
                            <?=h($activity['Activity']['enddate'])?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="panel colourable">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-users"></i> 名單</span>
            </div>
            <div class="panel-body">
                <div class="table-responsive ">
                    <table cellspacing="0" class="table table-striped nowrap" id="jq-datatables" width="100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>編號 #</th>
                            <th>姓名(英/中)</th>
                            <th>電話</th>
                            <th>電郵</th>
                            <th>機構</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($activity['ActivitiesVolunteer'] as $app):
                            if($app['valid']){
                                $rowclass = "";
                            }else{
                                $rowclass = "danger";
                            }
                        ?>
                            <tr class="<?=$rowclass?>">
                                <td></td>
                                <td>
                                    <?if(!empty($app['systemlog'])){
                                        ?>
                                        <a href="javascript:void(0);" class="text-warning tooltip-warning tooltips" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?=h($app['systemlog'])?>"><i class="fa fa-exclamation-triangle"></i></a>
                                    <?
                                    }?>
                                    <?php
                                    if(!empty($app['volunteer_id'])){
                                        echo h($app['Volunteer']['code']);
                                    }else{
                                        echo " - ";
                                    } ?>
                                </td>
                                <td><?php echo h($app['e_name']); ?><br /><?php echo h($app['c_name']); ?></td>
                                <td><?php echo h($app['tel']); ?></td>
                                <td><?php echo h($app['email']); ?></td>
                                <td ><?php echo h($app['Volunteerunit']['name']); ?></td>
                                <td>
                                    <?php echo $this->Html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-info"></i></button>', array('action' => 'view', $app['id'], 'ajax'=>true), array('class'=>'modalbtn', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));  ?>
                                    <?php echo $this->Html->link('<button class="btn btn-sm btn-warning" style="width: 30px;"><i class="fa fa-pencil"></i></button>', array('action' => 'edit', $app['id'], 'redirect'=>urlencode($this->Html->url(null, true)), 'ajax'=>true), array('class'=>'', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static"));  ?>
                                    <?if($app['valid']){
                                        echo $this->Form->postLink('<button class="btn btn-sm btn-danger" style="width: 30px;"><i class="fa fa-times"></i></button>', array('action' => 'changevalid', $app['id'], 0, 'redirect'=>urlencode($this->Html->url(null, true))), array('escape'=>false), __('你確認要取消參加者 %s?', h($app['e_name'])));
                                    }else{
                                        echo $this->Form->postLink('<button class="btn btn-sm btn-success" style="width: 30px;"><i class="fa fa-refresh"></i></button>', array('action' => 'changevalid', $app['id'], 1, 'redirect'=>urlencode($this->Html->url(null, true))), array('escape'=>false), __('你確認要加入參加者 %s?', h($app['e_name'])));
                                        ?>
                                        <a href="#" class="badge">已退出</a>
                                    <?
                                    }?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <br />
                <p class="text-sm"># 如果不是登記，就沒有編號。</p>
            </div>
        </div>

        <!-- /5. $DEFAULT_TABLES -->
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal" aria-hidden="true">
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
            dom: '<"top"Bf<"clear">>rt<"bottom"lip<"clear">>',
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

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal');
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

    });

    init.push(function () {
        $('.tooltips').tooltip();
    });
</script>