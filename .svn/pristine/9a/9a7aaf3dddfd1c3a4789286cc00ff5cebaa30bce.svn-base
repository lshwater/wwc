<ul class="breadcrumb">
    <li>
        <?=$this->Html->link("查看活動計劃 - ".h($activity['Eventproposal']['name'])."( 編號: ".h($activity['Eventproposal']['event_code'])." )", array("controller"=>"Eventproposals","action"=>"view", $activity['Eventproposal']['id'], "#"=>"tab".$activity['Activity']['id']))?>
    </li>
    <li class="active">新增節數</li>
</ul>


<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Activitysession', array('class'=>'form-horizontal panel validate_form preventDoubleSubmission')); ?>
        <?php echo $this->Form->hidden('activity_id', array('value'=>$activity['Activity']['id'])); ?>
        <div class="panel-heading">
            <span class="panel-title">新增節數 <br /><small><?=h($activity['Eventproposal']['name'])."( 編號: ".h($activity['Eventproposal']['event_code'])." )"?></small></span>
        </div>

        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('date', __('日期'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('date', array('div'=>false, "type"=>"text",'label'=>false, 'class'=>'form-control', "id"=>"datepicker", 'required' => 'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('session', __('節數'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('session', array('div'=>false, 'label'=>false, 'class'=>'form-control', "default"=>1));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('startdate', __('時間'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="input-daterange input-group">
                        <?php echo $this->Form->input('starttime', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control input-sm ', 'required' => 'required', 'id' => 'startdate')); ?>
                        <span class="input-group-addon">to</span>
                        <?php echo $this->Form->input('endtime', array('type' => 'text', 'div' => false, 'label' => false, 'class' => 'form-control input-sm ', 'required' => 'required', 'id' => 'enddate')); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-heading">
            <span class="panel-title">重複設定 (最多增加30節)</span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('repeat', __('重複'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('repeat', array('div'=>false,'label'=>false, 'class'=>'form-control select2 ', "id"=>"repeat", "options"=>array("0"=>"永不", "D"=>"每日", "W"=>"每星期", "M"=>"每月")));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group" style="display:none">
                <?php echo $this->Form->label('repeatuntil', __('結束重複'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('repeatuntil', array('div'=>false, 'type' => 'text','label'=>false, 'class'=>'form-control repeatrules', "id"=>"repeatuntil"));?>
                </div>
            </div> <!-- / .form-group -->
        </div>

        <div class="panel-heading">
            <span class="panel-title">統計設定</span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('countuser_id', __('職員'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('countuser_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', "default"=>$activity['Activity']['countuser_id']));?>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>

    </div>
</div>

    <script>
        $(document).ready(function () {
           var options2 = {
                minuteStep: 5,
                showSeconds: false,
                showMeridian: false,
                showInputs: false,
                defaultTime: '08:00 AM',
                orientation: $('body').hasClass('right-to-left') ? { x: 'right', y: 'auto'} : { x: 'auto', y: 'auto'}
            }
            $('#startdate').timepicker(options2);
            $('#enddate').timepicker(options2);

            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayBtn: "linked"
                <?
                    if(!empty($_cutoffdate)){
                ?>
                ,startDate:'<?=h($_cutoffdate['Cutoffdate']['name'])?>'
                <?
                    }
                ?>
            });

            $("#repeat").on("change", function(){
                if($("#repeat").val() != 0){
                    $("#repeatuntil").closest(".form-group").show();
                    $("#repeatuntil").attr("required", "required");

                }
                else{
                    $("#repeatuntil").val('');
                    $("#repeatuntil").closest(".form-group").hide();
                    $("#repeatuntil").removeAttr("required");
                }
            });

            $('#repeatuntil').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayBtn: "linked"
                <?
                    if(!empty($_cutoffdate)){
                ?>
                ,startDate:'<?=h($_cutoffdate['Cutoffdate']['name'])?>'
                <?
                    }
                ?>
            });

            $.validator.addClassRules("repeatrules", {
                greaterThan: ["#datepicker", "日期"]
            });
        });
    </script>