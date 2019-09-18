
<div class="row">

    <div class="col-xs-6">
        <h2><?php echo __('匯出標籤'); ?></h2>
        <div class="well well-lg">
            <?php echo $this->Form->create('Stocks', array("action"=>"export_label",'role'=>'form')); ?>
                <div class="form-group">
                    <? echo $this->Form->label('unit_id', '選擇單位');?><br>
                    <div class="controls">
                        <?php echo $this->Form->input('unit_id', array('div'=>false,'label'=>false, 'class'=>'form-control select2', 'options'=>$unit, 'required'=>'required', 'empty'=>false));?>

                    </div>
                </div>

            <div>
                <button type="submit" class="btn btn-success btn-lg btn-block"><i class="glyphicon glyphicon-ok-sign"></i> <? echo __('download');?></button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
    <div class="col-xs-6">
        <h2>&nbsp;</h2>
        <div class="well well-lg">
            <?php echo $this->Form->create('Stocks', array("action"=>"export_label",'role'=>'form')); ?>
            <div class="form-group">
                <? echo $this->Form->label('stock', '選擇存貨');?><br>
                <div class="controls">

                    <?php echo $this->Form->input('stock', array(
                            'div'=>false, 'label'=>false,'multiple'=>true,
                            'class'=>'form-control form-group-margin filterauto select2','options'=>array(),'value'=>array(''),
                            'id'=>"stock",
                            'placeholder'=>__("X-axis level2")
                        )
                    ); ?>

                </div>
            </div>

            <div>
                <button type="submit" class="btn btn-success btn-lg btn-block"><i class="glyphicon glyphicon-ok-sign"></i> <? echo __('download');?></button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>

</div>



<div class="row" style="height:200px">
</div>
<script>


    $(document).ready(function() {
        $("#stock").select2({
            minimumInputLength: 1,
            allowClear:true,
            // multiple:true,
            placeholder:"存貨",
            ajax: {
                url: "<?=$this->Html->url(array('controller'=>'stocks', 'action'=>'ajax_select2_list'))?>",
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                processResults: function (data) {
                    return {
                        results: data
                    };
                }
            }
        });

        //$(".select2-remote").select2({
        //    minimumInputLength: 1,
        //    allowClear:true,
        //    placeholder:"持有人",
        //    ajax: {
        //        url: "<?//=$this->Html->url(array('controller'=>'users', 'action'=>'ajax_select2_list'))?>//",
        //        dataType: 'json',
        //        type: "GET",
        //        quietMillis: 50,
        //        processResults: function (data) {
        //            return {
        //                results: data
        //            };
        //        }
        //    }
        //});


    });

</script>
