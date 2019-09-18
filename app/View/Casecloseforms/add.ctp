<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Casecloseform', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
        <div class="modal-header">
            <span class="modal-title"><?=__('結束/轉移個案')?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <?php echo $this->Form->hidden('user_id', array('value'=>$auth['id']));?>
        <div class="modal-body">

            <div class="form-group">
                <?php echo $this->Form->label('date', __('提交日期')."*", 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('date', array('div'=>false, 'label'=>false, 'class'=>'form-control bs_datepicker_modal', "type"=>"text", 'required'=>"required"));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('caseclosereason_id', __('結案原因')."*", 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('caseclosereason_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2_modal', "options"=>$caseclosereasons, 'required'=>"required", 'id'=>'caseclosereason_id'));?>
                </div>
            </div> <!-- / .form-group -->


            <div class="form-group case_referral_agency" hidden>
                <?php echo $this->Form->label('case_referral_agency', __('已轉介(請註明)')."*", 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('case_referral_agency', array('div'=>false, 'label'=>false, 'class'=>'form-control is_required', 'id'=>'case_referral_agency'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group other_specify" hidden>
                <?php echo $this->Form->label('other_specify', __('其他')." *", 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('other_specify', array('div'=>false, 'label'=>false, 'class'=>'form-control is_required', 'id'=>'other_specify'));?>
                </div>
            </div> <!-- / .form-group -->


            <div class="form-group">
                <?php echo $this->Form->label('caseowner_remark', __('案主意願 *'), 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('caseowner_remark', array('type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('案主意願'), 'required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('followup', __('服務建議'), 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('followup', array('type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('服務建議')));?>
                </div>
            </div> <!-- / .form-group -->


            <div class="form-group">
                <?php echo $this->Form->label('remark', __('督導評語'), 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('remark', array('type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('督導評語')));?>
                </div>
            </div> <!-- / .form-group -->

        </div>
        <div class="modal-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>


        <?php echo $this->Form->end(); ?>

    </div>
</div>

<script>

    $(document).ready(function() {



        $(".select2_modal").select2({
            allowClear: false,
            dropdownParent: $("#modal"),
            dropdownCssClass : 'no-search'
        });

        validate_form();


        $('.bs_datepicker_modal').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayBtn: "linked",
            startDate:'<?=$case['Casemanagement']['applicationdate']?>',
            container: $('#modal')
        });

        $('#caseclosereason_id').on('select2:selecting', function (e) {
            var data = e.params.args.data.id;
            console.log("select: "+data);

            if(data == 11){
                $('.case_referral_agency').show();
                $('.case_referral_agency .is_required').attr('required','required');

            }else{
                $('.case_referral_agency').hide();
                $('.case_referral_agency .is_required').removeAttr('required');
                $('.case_referral_agency .is_required').val(null);
            }

            if(data == 12){
                $('.other_specify').show();
                $('.other_specify .is_required').attr('required','required');

            }else{
                $('.other_specify').hide();
                $('.other_specify .is_required').removeAttr('required');
                $('.other_specify .is_required').val(null);
            }


        });

    });
</script>