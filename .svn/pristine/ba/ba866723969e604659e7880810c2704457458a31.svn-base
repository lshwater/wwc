<?
//Configure::write('debug', 2);
//debug($activityapplicant);
?>

<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">
            <i class="fa fa-user page-header-icon"></i>&nbsp;&nbsp;參加義工資料
             <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </span>


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
                <?
                if(!empty($activityapplicant['ActivitiesVolunteer']['volunteer_id'])){
                    ?>
                    <tr>
                        <td>義工編號</td>
                        <td><?php echo h($activityapplicant['Volunteer']['code']); ?>&nbsp;</td>
                    </tr>
                <?
                }
                ?>
                <?
                if(!empty($activityapplicant['ActivitiesVolunteer']['volunteerunit_id'])){
                    ?>
                    <tr>
                        <td>義工所屬機構</td>
                        <td><?php echo h($activityapplicant['Volunteerunit']['name']); ?>&nbsp;</td>
                    </tr>
                <?
                }
                ?>

                <tr>
                    <td>姓名(中)</td>
                    <td><?php echo h($activityapplicant['ActivitiesVolunteer']['c_name']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>姓名(英)</td>
                    <td><?php echo h($activityapplicant['ActivitiesVolunteer']['e_name']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>電話</td>
                    <td><?php echo h($activityapplicant['ActivitiesVolunteer']['tel']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>電郵</td>
                    <td><?php echo h($activityapplicant['ActivitiesVolunteer']['email']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>備註</td>
                    <td>
                        <a href="#" id="remarks" data-type="textarea" data-pk="<?=$activityapplicant['ActivitiesVolunteer']['id']?>" data-placeholder="備註..." data-title="備註" class="editable editable-pre-wrapped editable-click" ><?php echo h($activityapplicant['ActivitiesVolunteer']['remarks']); ?></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('.editable').editable({
            url: '<?=$this->Html->url(array('action'=>'ajax_updateremarks'))?>'
        });
    });
</script>