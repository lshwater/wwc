<ul class="breadcrumb modaloff">
    <li>
        <?=$this->Html->link("截止日期", array("controller"=>"Cutoffdates","action"=>"index"))?>
    </li>
    <li class="active">更新日期</li>
</ul>

<div class="panel">
    <div class="panel-heading">
        <h2>
            更新隔斷日期
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </h2>
    </div>
    <?php echo $this->Form->create('Cutoffdate', array('class'=>'form-horizontal validate_form')); ?>
    <?=$this->Form->hidden("id")?>
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
                    <?php echo $this->Form->input('activedate', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control activedate', 'required' => 'required', 'placeholder'=>'生效日期', "id"=>"activedate")); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('更新');?></button>
    </div>
    <?php echo $this->Form->end(); ?>
</div>


<script>
    $(document).ready(function() {
        validate_form();

        $.validator.addClassRules("cutoffdate", {
            remote: {
                url:"<?=$this->Html->url(array('action'=>'ajax_checkunique'));?>",
                type:"post",
                data:{
                    field: 'name',
                    value: function() {
                        return $("#date").val();
                    },
                    recordid: '<?=$this->data['Cutoffdate']['id']?>'
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


