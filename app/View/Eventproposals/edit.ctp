<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

<ul class="breadcrumb">
    <li>
        <?=$this->Html->link("活動計劃書 - ".h($eventproposal['Eventproposal']['name']), array("action"=>"viewdetail", $eventproposal['Eventproposal']['id']))?>
    </li>
    <li class="active">修改活動計劃</li>
</ul>

<div class="row ">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Eventproposal', array('class'=>'form-horizontal panel validate_form preventDoubleSubmission', "id"=>"form2submit")); ?>
        <?php echo $this->Form->hidden('id');?>
        <?
        switch($eventproposal['Approvalrecordstatus']['id']){
            case 1:
                $stsclass = "success";
                break;
            case 2:
            case 5:
                $stsclass = "warning";
                break;
            case 3:
                $stsclass = "danger";
                break;
            case 4:
                $stsclass = "default";
                break;
        }
        ?>
        <div class="panel-heading">
            <span class="panel-title">基本資料
            </span>
            <div class="panel-heading-controls">
                <span class="badge badge-<?=$stsclass?>"> <?=h($eventproposal['Approvalrecordstatus']['name'])?></span>
            </div>
        </div>

        <div class="panel-body">

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('name', __('活動名稱'), 'col-md-2 control-label required'); ?>
                        <div class="col-md-10">
                            <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'required'=>"required"));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('year_id', "年度", 'col-md-2 control-label required'); ?>
                        <?if(empty($eventproposal['Eventproposal']['event_code'])){?>
                        <div class="col-md-10">
                            <?echo $this->Form->input('year_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', 'required'=>"required", "empty"=>true));?>
                        </div>
                            <?}else{?>
                                <p class="form-control-static col-md-10"><?=h($eventproposal["Year"]["start"])?> - <?=h($eventproposal["Year"]["end"])?> </p>
                            <?}?>

                    </div> <!-- / .form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('proposaltype', "計劃類別", 'col-sm-2 control-label required'); ?>
                        <p class="form-control-static col-md-10"><?=h($eventproposal["Eventproposal"]["proposaltype"])?></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('nature', __('性質'), 'col-md-2 control-label'); ?>
                        <div class="col-md-10">
                            <?php echo $this->Form->input('nature', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('user_id', __('負責職員'), 'col-md-2 control-label required'); ?>
                        <p class="form-control-static col-md-10"><?=h($eventproposal["User"]["name"])?></p>
                    </div> <!-- / .form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('quota', __('預計名額'), 'col-md-4 control-label'); ?>
                        <div class="col-md-8">
                            <?php echo $this->Form->input('quota', array('div'=>false, 'label'=>false, 'class'=>'form-control vd_number'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('date', __('日期'), 'col-md-2 control-label'); ?>
                        <div class="col-md-10">
                            <?php echo $this->Form->input('date', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('time', __('時間'), 'col-md-2 control-label'); ?>
                        <div class="col-md-10">
                            <?php echo $this->Form->input('time', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('location', __('地點'), 'col-md-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('location', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('numberofsession', __('節數'), 'col-md-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('numberofsession', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <?php echo $this->Form->label('fee', __('收費'), 'col-md-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('fee', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('group_nature', __('小組性質'), 'col-md-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('group_nature', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('group_structure', __('小組結構'), 'col-md-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('group_structure', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('target', __('小組對象'), 'col-md-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('target', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->label('volunteerneed', __('義工人數'), 'col-md-2 control-label'); ?>
                        <div class="col-md-10">
                            <?php echo $this->Form->input('volunteerneed', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->label('helperneed', __('其他人員人數'), 'col-md-2 control-label'); ?>
                        <div class="col-md-10">
                            <?php echo $this->Form->input('helperneed', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div style="display: none">
                            <?php echo $this->Form->input('proposal_content', array("type"=>"text", "id"=>"proposal_content"));?>
                        </div>
                        <div class="summernote" id="summernote_proposal_content">
                            <?
                            echo $this->data['Eventproposal']['proposal_content'];
                            ?>


                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('structure', __('小組理念'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('structure', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('aim', __('小組目的'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('aim', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('objective', __('小組目標'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('objective', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->
        </div>

        <div class="panel-heading">
            <span class="panel-title">小組內容<small></small></span>
            <div class="panel-heading-controls">
                <a href="javascript:void(0)" class="btn btn-xs btn-info btn-outline" onclick="addprocedure()"><span class="fa fa-plus"></span>&nbsp;&nbsp;新增</a>
            </div> <!-- / .panel-heading-controls -->
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table" id="proceduretable">
                    <tr>
                        <th>日期/時間</th>
                        <th>主題目的</th>
                        <th>程序內容</th>
                        <th>人手</th>
                        <th>物資</th>
                        <th></th>
                    </tr>
                        <?
                        $procdure_count = 0;
                        if(!empty($this->data['Eventproposalprocedure'])){
                            foreach($this->data['Eventproposalprocedure'] as $key=>$val){
                        ?>
                        <tr class="procedure_slot">
                            <td>
                                <?php echo $this->Form->input('Eventproposalprocedure.'.$procdure_count.'.datetime', array('type'=>"text",'div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                            </td>

                            <td>
                                <?=$this->Form->input("Eventproposalprocedure.".$procdure_count.".objective", array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                            </td>
                            <td>
                                <?=$this->Form->input("Eventproposalprocedure.".$procdure_count.".procedure", array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                            </td>
                            <td>
                                <?=$this->Form->input("Eventproposalprocedure.".$procdure_count.".incharges", array('div'=>false, 'label'=>false, 'class'=>'form-control', 'type'=>"textarea"));?>
                            </td>
                            <td>
                                <?=$this->Form->input("Eventproposalprocedure.".$procdure_count.".inventory", array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                            </td>
                            <td>
                                <?=$this->Html->link("移除", "javascript:void(0)", array("class"=>"btn btn-danger proceduredelbtn"));?>
                            </td>
                        </tr>
                    <?
                        $procdure_count++;
                        }
                    }
                    ?>
                </table>
            </div>
        </div>

        <script>
            var procdure_count = <?=$procdure_count?>;
        </script>

        <div class="panel-heading">
            <span class="panel-title">其他<small></small></span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('contingency', __('應變方法'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('contingency', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('evaluation', __('評估方法'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('evaluation', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('effective', __('成效指標'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('effective', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('remarks', __('備註'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('remarks', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('senior_advice', __('督導意見'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('senior_advice', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->
        </div>

        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="fa fa-check"></i><? echo ' '.__('儲存');?></button>
        </div>
        <?php echo $this->Form->end(); ?>

    </div>
</div>

    <div style="display:none">
        <table >
            <tbody>
            <tr id="sampleprocedure">
                <td>
                    <?php echo $this->Form->input('Eventproposalprocedure.__COUNT__.datetime', array('type'=>"text",'div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </td>

                <td>
                    <?=$this->Form->hidden("Eventproposalprocedure.__COUNT__.eventproposal_id", array('value'=>$eventproposal['Eventproposal']['id']));?>
                    <?=$this->Form->input("Eventproposalprocedure.__COUNT__.objective", array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </td>
                <td>
                    <?=$this->Form->input("Eventproposalprocedure.__COUNT__.procedure", array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </td>
                <td>
                    <?=$this->Form->input("Eventproposalprocedure.__COUNT__.incharges", array('div'=>false, 'label'=>false, 'class'=>'form-control', 'type'=>"textarea"));?>
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


    function addprocedure(){
        var html_cell = $("#sampleprocedure").html();
        html_cell = html_cell.replace(/__COUNT__/g, procdure_count);

        $("#proceduretable").append("<tr class='procedure_slot' id='procedure_"+procdure_count+"'>"+html_cell+"</tr>");
        var options = {
            minuteStep: 5,
            showSeconds: false,
            showMeridian: false,
            showInputs: false,
            defaultTime: '08:00 AM',
            orientation: $('body').hasClass('right-to-left') ? { x: 'right', y: 'auto'} : { x: 'auto', y: 'auto'}
        }
        $('#procedure_'+procdure_count+' .timepicker').timepicker(options);
        $('#procedure_'+procdure_count+' .datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayBtn: "linked"
        });

        procdure_count++;
    }

    $(document).ready(function () {
        <?if($eventproposal['Eventproposal']['approvalrecordstatus_id'] == 1){?>
        bootbox.alert({
            message: "注意： 活動計劃書已批閱，如果內容更改，將要重新批閱。",
            callback: function() {

            },
            className: "bootbox-sm"
        });

        <?}?>

        var options2 = {
            format: 'yyyy-mm-dd',
            todayBtn: "linked",
            orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
            <?if(!empty($_cutoffdate)){?>
            startDate:'<?=h($_cutoffdate['Cutoffdate']['name'])?>'
            <?}?>
        };
        $('#range').datepicker(options2);

        var options = {
            minuteStep: 5,
            orientation: $('body').hasClass('right-to-left') ? { x: 'right', y: 'auto'} : { x: 'auto', y: 'auto'}
        }
        $('.timepicker').timepicker(options);

        $("#proceduretable").on("click", ".proceduredelbtn", function(){
            $(this).closest(".procedure_slot").remove();
        });

        $('.summernote').summernote({
            toolbar: [
            ],
        });

        $("#form2submit").on("submit", function(){
            $('#volunteerdetail').val($('#summernote_volunteerdetail').summernote('code'));
            $('#proposal_content').val($('#summernote_proposal_content').summernote('code'));
            return false;
        });

        $('input[type="checkbox"]').change(function(){
           $(this).attr("checked", "checked");
        });
    });
</script>