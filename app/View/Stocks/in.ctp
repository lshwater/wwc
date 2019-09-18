<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Member', array('class'=>'panel form-horizontal validate_form preventDoubleSubmission')); ?>

        <div class="panel-heading">
            <?if($rein){
            ?>
                <span class="panel-title">重新入住確認 - <?=$member['Member']['c_name']?> (<?=$member['Member']['e_name']?>)</span>
            <?
            }else{
            ?>
                <span class="panel-title">入住資料 - <?=$member['Member']['c_name']?> (<?=$member['Member']['e_name']?>)</span>
            <?
            }?>

        </div>

        <div class="panel-body">
            <?php echo $this->Form->input('id'); ?>


            <div class="form-group">
                <?php echo $this->Form->label('Level', "設定學生的等級", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Level', array('div'=>false, 'options'=>$levels,'label'=>false, 'class'=>'select2-multiple form-control select2-offscreen', 'placeholder'=>'Select a Member Level', 'required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('lastestindate', "設定最新入住日期 (計算等級用)", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('lastestindate', array('type' => 'text', 'div'=>false, 'label'=>false, 'class'=>'datepickercus form-control', 'required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <?php echo $this->Form->hidden('active', array('value'=>1));?>
            <?

            if(!empty($memberinputfields)){
                foreach($memberinputfields as $key=>$fields){
                    if(!empty($fields['Selectionlist']['Selectionitem'])){
                        $list = Set::combine($fields['Selectionlist']['Selectionitem'], '{n}.id', '{n}.name');
                    }else{
                        $list = NULL;
                    }
                    ?>
                    <div class="form-group">
                        <?
                        if(!empty($this->data['MemberCustomField'][$key])){
                            echo $this->Form->hidden("MemberCustomField.{$key}.id", array('value'=>$this->data['MemberCustomField'][$key]['id']));
                        }
                        else{
                            echo $this->Form->hidden("MemberCustomField.{$key}.memberinputfield_id", array('value'=>$fields['Memberinputfield']['id']));
                        }


                        if($fields['Inputtype']['htmltype'] == "checkbox"){
                            ?>
                            <div class="col-sm-offset-2 col-sm-10">
                                <?php
                                echo $this->Form->unlockField("MemberCustomField.{$key}.value");
                                echo $this->Form->hidden("MemberCustomField.{$key}.value", array('value'=>0));
                                ?>
                                <div class="checkbox">
                                    <label>
                                        <?php echo $this->Form->input("MemberCustomField.{$key}.value", array('div'=>false, 'class'=>'px', 'type'=>'checkbox', 'label'=>false, 'hiddenField'=>false));?>
                                        <span class="lbl"><?=__($fields['Memberinputfield']['title'])?></span>
                                    </label>
                                </div>
                            </div>
                        <?

                        }else{

                            if(!$fields['Memberinputfield']['required']){
                                $required = "";
                            }
                            else{
                                $required = "required";
                            }


                            $class = "";

                            if(!empty($fields['Memberinputfield']['class'])){
                                $class .= " ".$fields['Memberinputfield']['class'];
                            }

                            echo $this->Form->label("MemberCustomField.{$key}.value", __($fields['Memberinputfield']['title']), 'col-sm-2 control-label');
                            ?>
                            <div class="col-sm-10">
                                <?
                                echo $this->Form->input("MemberCustomField.{$key}.value", array(
                                        'label'=>false,
                                        'div'=>false,
                                        'type'=>$fields['Inputtype']['htmltype'],
                                        'options'=>$list,
                                        'class'=>'form-control'.$class,
                                        'placeholder'=>__($fields['Memberinputfield']['placeholder']),
                                        'required'=>$required
                                    )
                                );
                                ?>
                            </div>
                        <?
                        }
                        ?>
                    </div>
                <?
                }
            }

            ?>

        </div>
        <div class="panel-footer text-right">
            <?php echo $this->Html->link('<i class="glyphicon glyphicon-remove-sign"></i> '.__('Cancel'), $this->request->referer(), array('escape'=>false, 'class'=>'btn btn-primary')); ?>
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Multiselect
        $(".select2-multiple").select2({
        });
        validate_form();

        $(".datepickercus").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
        });
    });

</script>