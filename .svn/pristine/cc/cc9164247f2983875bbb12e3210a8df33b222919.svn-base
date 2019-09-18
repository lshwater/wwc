<?//
//Configure::write('debug', 2);
//debug($activities);
//?>


<ul class="breadcrumb">
    <li>
        <?=$this->Html->link("義工機構清單", array("action"=>"index"))?>
    </li>
    <li class="active"><?=h($volunteerunit['Volunteerunit']['name']) ?></li>
</ul>

<div class="panel">
    <div class="panel-heading">
        <h2>
            <?php echo h($volunteerunit['Volunteerunit']['name']); ?>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </h2>
    </div>
    <div class="panel-body">
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
                    <td>機構名稱</td>
                    <td><?php echo h($volunteerunit['Volunteerunit']['name']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>聯絡人</td>
                    <td><?php echo h($volunteerunit['Volunteerunit']['contactname']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>聯絡電話</td>
                    <td><?php echo h($volunteerunit['Volunteerunit']['contacttel']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>聯絡電郵</td>
                    <td><?php echo h($volunteerunit['Volunteerunit']['email']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>備註</td>
                    <td><?php echo h($volunteerunit['Volunteerunit']['remarks']); ?>&nbsp;</td>
                </tr>

                </tbody>
            </table>
        </div>
        <hr />

        <div class="row">
            <div class="col-sm-12">
                <ul id="uidemo-tabs-default-demo" class="nav nav-tabs">
                    <li class="active">
                        <a href="#uidemo-tabs-default-demo-home" data-toggle="tab"><?=__('相關己登記的義工名單')?></a>
                    </li>
                    <li>
                        <a href="#uidemo-tabs-default-demo-profile" data-toggle="tab"><?=__('活動參與狀況')?></a>
                    </li>
                </ul>

                <div class="tab-content tab-content-bordered">
                    <div class="tab-pane fade in active" id="uidemo-tabs-default-demo-home">
                        <div class="table-default">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables1">
                                <thead>
                                <tr>
                                    <th><?=__("姓名（中）")?></th>
                                    <th><?=__("姓名（英）")?></th>
                                    <th class="actions"><?php echo __('Actions'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($volunteers as $volunteer):
                                    ?>
                                    <tr>
                                        <td><?php echo h($volunteer['Volunteer']['c_name']); ?></td>
                                        <td><?php echo h($volunteer['Volunteer']['e_name']); ?></td>
                                        <td class="actions">
                                            <?php echo $this->Html->link('<i class="fa fa-info"></i>', array("controller"=>"Volunteers", 'action' => 'view', $volunteer['Volunteer']['id'], 'ajax'=>true), array('class'=>'btn btn-sm btn-info modalbtn', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal'));  ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>
                    </div> <!-- / .tab-pane -->
                    <div class="tab-pane fade" id="uidemo-tabs-default-demo-profile">
                        <div class="tab-pane fade in active" id="uidemo-tabs-default-demo-home">
                            <div class="table-default">
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables2">
                                    <thead>
                                    <tr>
                                        <th><?=__('活動名稱')?></th>
                                        <th><?=__('開始日期')?></th>
                                        <th><?=__('結束日期')?></th>
                                        <th><?=__('參加義工人數')?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($activities as $activity):
                                        ?>
                                        <tr>
                                            <td data-order="<?=h($activity['Activity']['Eventproposal']['name'])?>"><?=$this->Html->link($activity['Activity']['name']." (".h($activity['Activity']['Eventproposal']['name']).")", array("controller"=>"activities", "action"=>"view", $activity['Activity']['id']), array("class"=>"openasnew"))?>&nbsp;</td>
                                            <td><?php echo h($activity['Activity']['startdate']); ?></td>
                                            <td><?php echo h($activity['Activity']['enddate']); ?></td>
                                            <td><?php echo h($activity['ActivitiesVolunteer']['volunteer_count']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- / .tab-pane -->
                    </div> <!-- / .tab-pane -->
                </div> <!-- / .tab-content -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function () {
        $('#jq-datatables1').dataTable({
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

        $('#jq-datatables2').dataTable({
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
            $('.modalonly').show();
            $('.modaloff').hide();
        });
    });
</script>
