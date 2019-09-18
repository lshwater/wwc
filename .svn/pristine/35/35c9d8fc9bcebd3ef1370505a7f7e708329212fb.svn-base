<ul class="breadcrumb">
    <li>
        <?=$this->Html->link("截止日期", array("controller"=>"Cutoffdates","action"=>"index"))?>
    </li>
    <li class="active">新增日期</li>
</ul>

<div class="panel">
    <div class="panel-heading">
        <h2>
            新增隔斷日期
        </h2>
    </div>
    <?php echo $this->Form->create('Cutoffdate', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group no-margin-hr">
                    <?php echo $this->Form->label('name', __('此日期前'), 'control-label'); ?>
                    <?php echo $this->Form->input('name', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control cutoffdate', 'required' => 'required', 'placeholder'=>'最後更改日期', "id"=>"date")); ?>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group no-margin-hr">
                    <?php echo $this->Form->label('activedate', __('生效日期'), 'control-label'); ?>
                    <?php echo $this->Form->input('activedate', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control', 'required' => 'required', 'placeholder'=>'生效日期', "id"=>"activedate")); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('新增');?></button>
    </div>
    <?php echo $this->Form->end(); ?>
</div>


<script>
    $(document).ready(function() {
        $.validator.addClassRules("cutoffdate", {
            remote: {
                url:"<?=$this->Html->url(array('action'=>'ajax_checkunique'));?>",
                type:"post",
                data:{
                    field: 'name',
                    value: function() {
                        return $("#date").val();
                    }
                }
            }
        });

        var options = {
            orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
            autoclose: true,
            format: 'yyyy-mm-dd'
        };
        $('#date').datepicker(options);
        $("#activedate").datepicker(options);
    });
</script>


