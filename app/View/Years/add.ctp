<ul class="breadcrumb">
    <li>
        <?=$this->Html->link("年度清單", array("action"=>"index"))?>
    </li>
    <li class="active">新增年度</li>
</ul>

<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Year', array('class'=>'panel form-horizontal validate_form preventDoubleSubmission')); ?>

        <div class="panel-heading">
            <span class="panel-title">新增年度</span>
        </div>

        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('start', __('年度*'), 'col-sm-2  control-label'); ?>
                <div class="col-sm-10">
                    <div class="input-daterange input-group bs-datepicker-range">
                        <?php echo $this->Form->input('start', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control input-sm vd_periodcheck', 'required' => 'required', 'placeholder'=>'開始日期', "id"=>"start")); ?>
                        <span class="input-group-addon">to</span>
                        <?php echo $this->Form->input('end', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control input-sm ', 'required' => 'required', 'placeholder'=>'結束日期', "id"=>"end")); ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('activedate', __('生效日期*'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('activedate', array('type'=>"text",'div'=>false, 'label'=>false, 'required'=>'required', 'class'=>'form-control bs_datepicker', 'placeholder'=>__('生效日期')));?>
                </div>
            </div> <!-- / .form-group -->
        </div>

        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script>
    $(document).ready(function() {


        var options = {
            orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
            autoclose: true,
            format: 'yyyy',
            startView: 2,
            minViewMode: 2
        }
        $('.bs-datepicker-range').datepicker(options);

    });
</script>


