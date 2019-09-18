<?php $this->Html->script("datatable/dataTables.buttons.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/jszip.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/buttons.html5.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/buttons.flash.min", array("inline"=>false)); ?>
<?php $this->Html->css('datatable/buttons.dataTables.min', array("inline"=>false));?>
<ul class="breadcrumb">
    <li>
        <?=$this->Html->link(__("管理").h($volunteertype['Volunteertype']['name']).__("名單"), array("action"=>"management", $activity['Activity']['id']))?>
    </li>
    <li class="active">出席情況</li>
</ul>

<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><?=h($activity['Activity']['name'])?> ( <?=h($activity['Activity']['activity_code'])?> ) 出席情況</span>
    </div>
<div class="panel-body">
    <?
    if(!empty($activity['Activitysession'])){
    ?>
    <div class="row">
        <div class="tab-content tab-content-bordered">
            <table cellspacing="0" class="table table-striped nowrap" id="jq-datatables" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th>姓名</th>
                    <?
                    foreach($activity['Activitysession'] as $k=>$activitysession){
                        $date = new DateTime($activitysession['date']);
                        ?>
                        <th><?=h($date->format('j/m'))?></th>
                    <?
                    }?>
                </tr>
                </thead>
                <tbody>
                <?
                if(!empty($activitiesVolunteers)){
                    foreach($activitiesVolunteers as $applicant){
                        ?>
                        <tr>
                            <td></td>
                            <td>
                                <?php
                                if(!empty($applicant['ActivitiesVolunteer']['c_name'])){
                                    echo h($applicant['Activityapplicant']['c_name']);
                                }else{
                                    echo h($applicant['ActivitiesVolunteer']['e_name']);
                                }
                                ?>
                            </td>
                            <?
                            foreach($activity['Activitysession'] as $k=>$activitysession){

                                ?>
                                <td>
                                    <?if(!empty($applicant['ActivitiesVolunteerAttendant'][$activitysession['id']]['Attendant']['name'])){?>
                                        <span class='<?=h($applicant['ActivitiesVolunteerAttendant'][$activitysession['id']]['Attendant']['labelclass'])?>'>
                                            <?php
                                            echo h($applicant['ActivitiesVolunteerAttendant'][$activitysession['id']]['Attendant']['name']);
                                            ?>
                                        </span>
                                    <?}else{
                                        echo "NIL";
                                    }?>
                                </td>
                            <?
                            }?>
                        </tr>
                    <?
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
        <?
        }
        ?>
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
            "pageLength": 50,
            dom: '<"top"Bf<"clear">>rt<"bottom"lip<"clear">>',
            buttons: [
                'copy',
                'excel'
            ],
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
            $('#modal').removeData('bs.modal');
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

    });
</script>