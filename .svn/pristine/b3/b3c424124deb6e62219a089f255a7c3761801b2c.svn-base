<div class="panel">
    <div class="panel-heading">
        <h2>
            <span class="fa fa-print"></span>&nbsp;Export
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </h2>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Member', array('class' => 'form-horizontal validate_form')); ?>
        <div class="form-group no-margin-hr">
            <div class="input-daterange input-group" id="range">
                <?php echo $this->Form->input('start', array('div'=>false, 'label'=>false, 'class'=>'input-sm form-control', 'placeholder'=>"開始會員編號", "required"=>"required", "id"=>"startmembercode"));?>
                <span class="input-group-addon">至</span>
                <?php echo $this->Form->input('end', array('div'=>false, 'label'=>false, 'class'=>'input-sm form-control', 'placeholder'=>"結束會員編號", "required"=>"required", "id"=>"endmembercode"));?>
            </div>
        </div>
        <button class="btn btn-block btn-success"><span class="fa fa-check"></span>&nbsp;&nbsp;確定</button>
        <?php echo $this->Form->end(); ?>
    </div>

</div>

<script>
    $( document ).ready(function() {
        validate_form();
        formatmask($("#startmembercode"), '<?=configure::read('Member.code_mask')?>');
        formatmask($("#endmembercode"), '<?=configure::read('Member.code_mask')?>');
    });

</script>

