<div class="row">
    <div class="col-md-12">

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><?=__("更新").h($model_name)?></span>
                <div class="panel-heading-controls">
                    <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                </div>
            </div>
            <div class="panel-body">

                <?php echo $this->Form->create($model, array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <tr>
                        <?foreach($key_list as $key){?>
                            <th class="col-sm-10 text-center">
                                <?=h($model_name).__($key)?>
                            </th>
                        <?}?>
                    </tr>
                    </thead>
                    <tbody>
                    <?foreach($para_list as $index=>$para){

                        if($para[$model]['editable']){
                            ?>
                            <tr>
                                <?php echo $this->Form->hidden($model.".{$index}.id",array('value'=>$para[$model]['id']));?>

                                <?foreach($key_list as $key){?>
                                    <td class="">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                            <?php echo $this->Form->input($model.".{$index}.".$key, array('div'=>false, 'value'=>$para[$model][$key],'label'=>false,'class'=>'form-control', 'required'=>'required')); ?>
                                            </div>
                                        </div>
                                    </td>
                                <?}?>
                            </tr>
                            <?
                        }else{
                            ?>
                            <tr>
                                <?foreach($key_list as $key){?>
                                    <td class="">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                            <?php echo $this->Form->input($model.".{$index}.".$key, array('div'=>false, 'value'=>$para[$model][$key],'label'=>false,'class'=>'form-control', 'disabled'=>'disabled')); ?>
                                            </div>
                                        </div>
                                    </td>
                                <?}?>
                            </tr>
                            <?
                        }
                    }
                    ?>
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary" ><i class="fa fa-check"></i><? echo ' '.__('Submit');?></button>
                <?php echo $this->Html->link('<span class="btn-primary"></span>'.__('Cancel'), array('action' => 'index'), array('escape'=>false, 'class'=>'btn btn-danger btn-labeled')); ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>

    </div>
</div>

<script>

    $(document).ready(function() {
        validate_form();

    });
</script>
