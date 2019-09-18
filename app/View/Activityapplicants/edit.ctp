<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Activityapplicant', array('class'=>'panel form-horizontal validate_form')); ?>

        <div class="panel-heading">
            <span class="panel-title">編輯參加者資料</span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>

        <div class="panel-body">
            <?php echo $this->Form->input('id'); ?>

            <div class="row">
                <div class="form-group col-xs-12">
                    <?php echo $this->Form->label('c_name', __('姓名(中)'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('c_name', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                    </div>
                </div> <!-- / .form-group -->
            </div>
            <div class="row">
                <div class="form-group col-xs-12">
                    <?php echo $this->Form->label('e_name', __('姓名(英)*'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('e_name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'required'=>'required'));?>
                    </div>
                </div> <!-- / .form-group -->
            </div>
            <div class="row">
                <div class="form-group col-xs-12">
                    <?php echo $this->Form->label('tel', __('電話'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('tel', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control phonemask', 'id'=>'nonmember_tel'));?>
                    </div>
                </div> <!-- / .form-group -->
            </div>
            <div class="row">
                <div class="form-group col-xs-12">
                    <?php echo $this->Form->label('remarks', __('備註'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('remarks', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control'));?>
                    </div>
                </div> <!-- / .form-group -->
            </div>


        </div>
        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script>
    $( document ).ready(function() {
        validate_form();
        //phonemask($(".phonemask"));
    });

</script>

