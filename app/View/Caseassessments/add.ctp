<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Caseassessment', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
        <div class="modal-header">
            <span class="modal-title"><?=__('個案評估')?></span>
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
                <?php echo $this->Form->label('casetype_id', __('個案類別')."*", 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('casetype_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2_modal', "options"=>$casetypes, 'required'=>"required"));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('casenature_id', __('個案性質')."*", 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('casenature_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2_modal', "options"=>$casenatures, 'required'=>"required", 'id'=>'casenature_id'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group nextreviewdate" hidden>
                <?php echo $this->Form->label('nextreviewdate', __('下次重檢日期')."*", 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('nextreviewdate', array('div'=>false, 'label'=>false, 'class'=>'form-control bs_datepicker_modal is_required', "type"=>"text", 'id'=>'nextreviewdate'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('target', __('目標 *'), 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('target', array('type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('目標'), 'required'=>'required'));?>
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

        var nature_list = <?=json_encode($casenatures_list)?>;
            console.log(nature_list);

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

        $('#casenature_id').on('select2:selecting', function (e) {
            var data = e.params.args.data.id;
            console.log("select: "+data);

            if(data > 1){
                $('.nextreviewdate').show();
                $('.nextreviewdate .is_required').attr('required','required');
                $('.nextreviewdate .is_required').val(nature_list[data]['nextreview']);
                $('#nextreviewdate').datepicker("setDate", nature_list[data]['nextreview']);
            }else{
                $('.nextreviewdate').hide();
                $('.nextreviewdate .is_required').removeAttr('required');
                $('.nextreviewdate .is_required').val(null);
            }

        });

    });
</script>