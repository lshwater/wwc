
<div class="panel">
    <div class="panel-heading">
        <h2>
            上傳常用文件
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </h2>
    </div>
    <?php echo $this->Form->create('Document', array('class'=>'form-horizontal validate_form','type' => 'file')); ?>
    <div class="panel-body">
        <div class="form-group">
            <?php echo $this->Form->label('name', __('文件名稱'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', "required"=>"required"));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('des', __('備註'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('des', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('file', __('文件'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?=$this->Form->input("file", array("type"=>"file", "label"=>false, "div"=>false, "id"=>"styled-finput","required"=>"required", "class"=>"form-control"));?>
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
        validate_form();
        $('#styled-finput').pixelFileInput({ placeholder: '請加入附件 (最大文件大小: 10Mb)' });
    })
</script>

