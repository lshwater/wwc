<ul class="breadcrumb">
    <li>
        <?=$this->Html->link("活動報告書 - ".h($eventfinalreport['Eventproposal']['name']), array("action"=>"viewdetail", $eventfinalreport['Eventfinalreport']['id']))?>
    </li>
    <li class="active">修改活動報告書內容</li>
</ul>


<div class="row ">
<div class="col-sm-12">
<?php echo $this->Form->create('Eventfinalreport', array('class'=>'form-horizontal panel validate_form preventDoubleSubmission')); ?>
<?php echo $this->Form->input('id');?>

<div class="panel-heading">
    <span class="panel-title">基本資料<small></small></span>
</div>
<div class="panel-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <?php echo $this->Form->label('enrolnum', __('報名人數'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('enrolnum', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <?php echo $this->Form->label('attendance', __('出席率'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('attendance', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->
        </div>
    </div>

</div>
<div class="panel-heading">
    <span class="panel-title">活動推行與計劃不同之地方及原因<small></small></span>
</div>
<div class="panel-body">
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>
                    人力
                </th>
                <th>
                    籌備
                </th>
                <th>
                    推行
                </th>
                <th>
                    評估及跟進
                </th>
            </tr>
            <?
            foreach($eventarrangementtypes as $key=>$val){
                if(!empty($this->data['Eventarrangement'][$key])){
                    echo $this->Form->hidden("Eventarrangement.".$key.".id", array('value'=>$this->data['Eventarrangement'][$key]['id']));
                }
                ?>
                <tr>
                    <td>
                        <div class="form-group form-group-sm">
                            <?php echo $this->Form->label('Eventarrangement.'.$key.'.count', h($val), 'col-sm-8 control-label'); ?>
                            <div class="col-sm-4">
                                <?php echo $this->Form->input('Eventarrangement.'.$key.'.count', array('div'=>false, 'label'=>false, 'class'=>'form-control', "default"=>0));?>
                            </div>
                        </div> <!-- / .form-group -->
                    </td>
                    <td>
                        <?=$this->Form->hidden("Eventarrangement.".$key.".model", array('value'=>'Eventfinalreport'));?>
                        <?=$this->Form->hidden("Eventarrangement.".$key.".model_id", array('value'=>$eventfinalreport['Eventfinalreport']['id']));?>
                        <?=$this->Form->hidden("Eventarrangement.".$key.".eventarrangementtype_id", array('value'=>$key));?>
                        <?=$this->Form->input("Eventarrangement.".$key.".preparation", array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                    </td>
                    <td>
                        <?=$this->Form->input("Eventarrangement.".$key.".ongoing", array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                    </td>
                    <td>
                        <?=$this->Form->input("Eventarrangement.".$key.".following", array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                    </td>
                </tr>
            <?
            }
            ?>
        </table>
    </div>
</div>

<div class="panel-heading">
    <span class="panel-title">目標達致程度<small></small></span>
</div>

<div class="panel-body">
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>
                    成效指標
                </th>
                <th>
                    目標達成程度
                </th>
                <th>
                    備註
                </th>
            </tr>
            <tr>
                <th>
                    <div class="form-group col-xs-12">
                        <?php echo $this->Form->input('performanceindicators', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                    </div>
                </th>
                <th>
                    <div class="form-group col-xs-12">
                        <?php echo $this->Form->input('goallevel', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                    </div>
                </th>
                <th>
                    <div class="form-group col-xs-12">
                        <?php echo $this->Form->input('performanceremarks', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                    </div>
                </th>
            </tr>
        </table>
    </div>
</div>


<div class="panel-heading">
    <span class="panel-title">其他<small></small></span>
</div>
<div class="panel-body">
    <div class="form-group">
        <?php echo $this->Form->label('appraiseresult', __('評估工具使用情況及評估結果'), 'col-sm-2 control-label'); ?>
        <div class="col-sm-10">
            <?php echo $this->Form->input('appraiseresult', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('issuccess', __('整體是否成功'), 'col-sm-2 control-label'); ?>
        <div class="col-sm-10">
            <?php echo $this->Form->input('issuccess', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('following', __('跟進'), 'col-sm-2 control-label'); ?>
        <div class="col-sm-10">
            <?php echo $this->Form->input('following', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('advice', __('建議'), 'col-sm-2 control-label'); ?>
        <div class="col-sm-10">
            <?php echo $this->Form->input('advice', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
        </div>
    </div> <!-- / .form-group -->
</div>

<div class="panel-footer text-right">
    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i> <? echo ' '.__('儲存');?></button>
</div>
<?php echo $this->Form->end(); ?>

</div>


<div style="display:none">
    <table >
        <tbody>
        <tr id="sampleprocedure">
            <td>
                <?php echo $this->Form->input('Eventproposalprocedure.__COUNT__.date', array('type'=>"text",'div'=>false, 'label'=>false, 'class'=>'form-control datepicker'));?>
            </td>
            <td>
                <?php echo $this->Form->input('Eventproposalprocedure.__COUNT__.time', array('type'=>"text",'div'=>false, 'label'=>false, 'class'=>'form-control timepicker'));?>
            </td>
            <td>
                <?=$this->Form->hidden("Eventproposalprocedure.__COUNT__.eventproposal_id", array('value'=>$eventproposal['Eventproposal']['id']));?>
                <?=$this->Form->input("Eventproposalprocedure.__COUNT__.objective", array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
            </td>
            <td>
                <?=$this->Form->input("Eventproposalprocedure.__COUNT__.procedure", array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
            </td>
            <td>
                <?=$this->Form->input("Eventproposalprocedure.__COUNT__.incharges", array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
            </td>
            <td>
                <?=$this->Form->input("Eventproposalprocedure.__COUNT__.inventory", array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
            </td>
            <td>
                <?=$this->Html->link("移除", "javascript:void(0)", array("class"=>"btn btn-danger proceduredelbtn"));?>
            </td>
        </tr>
        </tbody>
    </table>
</div>



<script>


    $(document).ready(function () {
        <?if($eventfinalreport['Eventfinalreport']['approvalrecordstatus_id'] == 1){?>
        bootbox.alert({
            message: "注意： 活動報告書已批閱，如果內容更改，將要重新批閱。",
            callback: function() {

            },
            className: "bootbox-sm"
        });

        <?}?>

        var options = {
            minuteStep: 5,
            orientation: $('body').hasClass('right-to-left') ? { x: 'right', y: 'auto'} : { x: 'auto', y: 'auto'}
        }
        $('.timepicker').timepicker(options);

    });
</script>