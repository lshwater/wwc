<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-pencil-square-o page-header-icon"></i>&nbsp;&nbsp;活動報名
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!--                <div class="pull-right col-xs-12 col-sm-auto">-->
                <!--                    --><?php //echo $this->Html->link('<i class="fa fa-refresh fa-spin"></i>', array('action' => 'refresh'), array('escape'=>false, 'class'=>'btn btn-success')); ?>
                <!--                </div>-->

                <!-- "Create project" button, width=auto on desktops -->
                <div class="pull-right col-xs-12 col-sm-auto">
                    <?php echo $this->Html->link('<span class="icon fa fa-refresh"></span>', array(), array('escape'=>false, 'class'=>'btn')); ?>
                </div>

                <!-- Margin -->
                <div class="visible-xs clearfix form-group-margin"></div>

                </div>
        </div>
    </div>
</div>


<!--                            !!!!!form-->
<!--result-->
<div class="row">
    <div class="col-sm-12">
        <table cellspacing="0" class="table table-striped nowrap" id="resulttable" width="100%">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th>活動</th>
                <th>日期</th>
                <th>餘下名額</th>
            </tr>
            </thead>
            <tbody>
                <?if(!empty($activities)){
                    foreach($activities as $activity){
                        $rest = $activity['Activity']['quota'] - sizeof($activity['Activityapplicant']);
                        if($rest < 0){
                            $rest = 0;
                        }
                ?>
                    <tr>
                        <td></td>
                        <td>

                            <div class="btn-group btn-group-xs">
                                <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown"><span class="fa fa-pencil-square-o"></span> 報名</button>
                                <ul class="dropdown-menu">
                                    <?if($rest > 0){?>
                                        <li>
                                            <?=$this->Html->link('參加者', array("controller"=>"activityapplicants", "action"=>"enrol", $activity['Activity']['id']), array("class"=>"openasnew", "escape"=>false))?>
                                        </li>
                                    <?}?>
                                    <?
                                    //another helper / volunteer
                                    if(!empty($volunteertypes)){
                                        foreach($volunteertypes as $vtype_id=>$vtype){
                                            ?>
                                            <li>
                                                <?=$this->Html->link(h($vtype), array("controller"=>"activitiesVolunteers", "action"=>"enrol", $se['id'], $activity['Activity']['id'],$vtype_id), array("class"=>"openasnew", "escape"=>false))?>
                                            </li>
                                        <?
                                        }
                                    }?>
                                </ul> <!-- / .dropdown-menu -->
                            </div>

                        </td>
                        <td>
                            <?=$this->Html->link(h($activity['Activity']['name'])."<br/>".h($activity['Activity']['activity_code']), array('controller'=>'activities', 'action'=>'view',  $activity['Activity']['id'], "ajax"=>1), array("escape"=>false, 'data-toggle'=>'modal', 'data-target'=>'#modal'))?>
                        </td>
                        <td>由 <?=h($activity['Activity']['startdate'])?> <br /> 至 <?=h($activity['Activity']['enddate'])?></td>
                        <td><?=$rest?></td>
                    </tr>
                <?
                    }
                }?>
            </tbody>
        </table>
    </div>
</div>


<div id="memberadvwarning" class="modal modal-alert modal-warning fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-warning"></i>
            </div>
            <div class="modal-title">結果</div>
            <div class="modal-body" id="memberadvwarning_msg">沒有記錄</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    $( document ).ready(function() {
        $('#resulttable').DataTable({
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

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('#modal .modalonly').show();
            $('#modal .modaloff').hide();
        });
    });
</script>