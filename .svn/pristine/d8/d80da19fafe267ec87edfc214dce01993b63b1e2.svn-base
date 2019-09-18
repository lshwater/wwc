<?

//debug($numberofloop);

echo $this->Html->css('bootstrap-datetimepicker.min');
echo $this->Html->script('bootstrap-datetimepicker.min');
?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

    <h3 class="modal-title">
        刪除 <?=h($member['Member']['e_name'])." ".h($member['Member']['c_name'])?> 於 <?=$attendance['Attendance']['created']?> 的 <?=($attendance['Attendance']['in_out'] == 1)?"進入":"離開"?> 記錄
    </h3>
</div>

<?php echo $this->Form->create('Attendance', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
<?php echo $this->Form->hidden('id',array('value'=>$attendance['Attendance']['id']));?>
<?php echo $this->Form->hidden('member_id',array('value'=>$attendance['Attendance']['member_id']));?>
<?php echo $this->Form->hidden('status',array('value'=>(3-intval($attendance['Attendance']['in_out']))));?>

<div class="modal-body" id="modal">

    <div class="row">
        <div class="col-sm-12">

            <div class="form-group">
                <label for="MemberImageUsageRight" class="checkbox col-sm-4 control-label">
                    是否更新最後簽到時間
                </label>
                <div class="col-sm-8">
                    <input type="checkbox" name="update" class="px" value="1" id="update" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('last_checkin_time', __('簽到時間'), 'col-sm-4 control-label'); ?>
                <div class="col-sm-8">
                    <?php echo $this->Form->input('last_checkin_time', array('div'=>false,'label'=>false, 'class'=>'form-control datetimepicker','default'=>$member['Member']['last_checkin_time'],'empty'=>false, 'required'=>'required', 'disabled'));?>
                </div>
            </div> <!-- / .form-group -->

        </div>
    </div>

</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
</div>
<?php echo $this->Form->end(); ?>
<script>
    $( document ).ready(function() {

        $('.datetimepicker').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
            }
        });


        $('#update').change(function() {
            if(this.checked) {
                $('.datetimepicker').removeAttr('disabled');
            }else{
                $('.datetimepicker').attr('disabled', 'disabled');
            }
        });


        // Multiselect


    });


</script>