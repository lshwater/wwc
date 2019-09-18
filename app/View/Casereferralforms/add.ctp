


<?php echo $this->Form->create('Casereferralform', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
<div class="modal-header">
    <span class="modal-title"><?=__('轉介個案')?></span>
    <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
</div>
<div class="modal-body">
    <?php echo $this->Form->hidden('user_id', array('value'=>$auth['id']));?>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <?php echo $this->Form->label('date', __('提交日期'), 'col-sm-3 control-label '); ?>
                <div class="col-sm-9">
                    <? echo $this->Form->input('date', array('type'=>'text','div'=>false,'class'=>'form-control bs_datepicker_modal','label'=>false, "required"=>"required"));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('casereferral_id', __('轉介到'), 'col-sm-3 control-label '); ?>
                <div class="col-sm-9">
                    <? echo $this->Form->input('casereferral_id', array('div'=>false,'class'=>'form-control select2_modal','label'=>false, "required"=>"required", 'id'=>'casereferral_id', 'empty'=>false));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group casereferral_other_agency" hidden>
                <?php echo $this->Form->label('other_agency', __('其他政府部門/福利機構（請註明)')."*", 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('other_agency', array('type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'form-control is_required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group casereferral_other" hidden>
                <?php echo $this->Form->label('other_specify', __('其他（請註明）')."*", 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('other_specify', array('type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'form-control is_required'));?>
                </div>
            </div> <!-- / .form-group -->
        </div>
    </div>
</div>


<div class="modal-footer text-right">
    <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
</div>

<?php echo $this->Form->end(); ?>



<script>

    $(document).ready(function() {

        $(".select2_modal").select2({
            allowClear: false,
            dropdownParent: $("#modal"),
            dropdownCssClass : 'no-search'
        });

        $('.bs_datepicker_modal').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayBtn: "linked",
            startDate:'<?=$case['Casemanagement']['applicationdate']?>',
            container: $('#modal')
        });

        $('#casereferral_id').on('select2:selecting', function (e) {
            var data = e.params.args.data.id;
            console.log("select: "+data);

            if(data == 1){
                $('.casereferral_other_agency').show();
                $('.casereferral_other_agency .is_required').attr('required','required');
            }else{
                $('.casereferral_other_agency').hide();
                $('.casereferral_other_agency .is_required').removeAttr('required');
                $('.casereferral_other_agency .is_required').val(null);
            }

            if(data == 6){
                $('.casereferral_other').show();
                $('.casereferral_other .is_required').attr('required','required');
            }else{
                $('.casereferral_other').hide();
                $('.casereferral_other .is_required').removeAttr('required');
                $('.casereferral_other .is_required').val(null);
            }

        });


        validate_form();



    });
</script>