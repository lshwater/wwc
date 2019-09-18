<div class="panel">
    <div class="panel-heading">
        <h2>
            批閱評語
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </h2>
    </div>
    <div class="panel-body">
        <div class="note note-warning"><?=__('當活動批核後，系統會自動分配編號。')?></div>
        <?php echo $this->Form->create('Eventproposal', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
        <?php echo $this->Form->hidden('id', array("value"=>$eventproposal_id)); ?>
        <div class="form-group">
            <?php echo $this->Form->label('Approvalrecord.approvalrecordstatus_id', "結果 *", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('Approvalrecord.approvalrecordstatus_id', array('div'=>false, 'label'=>false, "empty"=>true, "required"=>"required", 'class'=>'form-control select2_modal'));?>
            </div>
        </div> <!-- / .form-group -->
        <?if(empty($eventproposal['Eventproposal']['event_code'])){?>

        <div class="form-group">
            <?php echo $this->Form->label('eventproposalcode_id', "計劃類別*", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('eventproposalcode_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2_modal', 'required'=>"required", "empty"=>true, "id"=>"code_id"));?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $this->Form->label('cuscode', "自訂編號", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('cuscode', array('div'=>false, 'label'=>false, 'class'=>'form-control cuscode', "id"=>"cuscode", 'placeholder'=>"如不填寫，系統則自行派發"));?>
            </div>
        </div> <!-- / .form-group -->
        <?}?>

        <div class="form-group">
            <?php echo $this->Form->label('Approvalrecord.comment', "評語", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('Approvalrecord.comment', array('div'=>false, 'label'=>false, 'class'=>'form-control', "type"=>"textarea"));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="fa fa-check"></i><? echo ' '.__('確定');?></button>
        </div>
        <?php echo $this->Form->end(); ?>

    </div>

</div>


    <script>
        var orgeventproposalcodeformat = "<?=$eventproposalcodeformat?>";

        function changecode(){
            var code = $("#code_id option:selected").text();
            $("#cuscode").val("");
            if(code != ""){
                var eventproposalcodeformat = orgeventproposalcodeformat.replace("__CODE__", code);
                formatmask($("#cuscode"), eventproposalcodeformat+"0999");

                $("#cuscode").show();
            }else{
                $("#cuscode").hide();
            }

        }

        $( document ).ready(function() {
            // Multiselect
            $(".select2_modal").select2({
                allowClear: true,
                placeholder: "選擇"
            });
            validate_form();

            $.validator.addClassRules("cuscode", {
                remote: {
                    url:"<?=$this->Html->url(array('action'=>'ajax_checkunique'));?>",
                    type:"post",
                    data:{
                        field: 'event_code',
                        value: function() {
                            return $("#cuscode").val();
                        }
                    }
                }
            });

            $("#code_id").change(function(){
                changecode();
            });

            changecode();
        });

    </script>

