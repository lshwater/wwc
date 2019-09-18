<?php $this->Html->script("barcode/jquery.scannerdetection.compatibility", array("inline"=>false)); ?>
<?php $this->Html->script('barcode/jquery.scannerdetection', array("inline"=>false)); ?>
<?php $this->Html->script('membercard', array("inline"=>false)); ?>

<?php $this->Html->script("datatable/jszip.min", array("inline"=>false)); ?>
<?php $this->Html->script("xls/xlsx.core.min", array("inline"=>false)); ?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-bullhorn page-header-icon"></i>&nbsp;&nbsp;<?=__("報名")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
            </div>
        </div>
    </div>
</div>

<div class="panel">

    <div class="panel-heading">
        <span class="panel-title">活動報名</span>
    </div>

    <div class="panel-body">
        <div class="panel colourable">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-info-circle"></i> 活動資料</span>
            </div>

            <!-- Table -->
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            活動編號
                        </td>
                        <td colspan="3">
                            <?=h($activity['Activity']['activity_code'])?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            活動名稱
                        </td>
                        <td>
                            <?=h($activity['Activity']['name'])?>
                        </td>
                        <td>
                            餘額
                        </td>
                        <td>
                            <?=$quota?> / <?=h($activity['Activity']['quota'])?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            對像
                        </td>
                        <td>
                           <?=(!empty($activity['Activity']['target']))?h($activity['Activity']['target']):" － "?>
                        </td>
                        <td>
                            地點
                        </td>
                        <td>
                            <?=(!empty($activity['Activity']['place']))?h($activity['Activity']['place']):" － "?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            導師
                        </td>
                        <td>
                            <?=(!empty($activity['Activity']['tutor']))?h($activity['Activity']['tutor']):" － "?>
                        </td>
                        <td>
                            負責同事
                        </td>
                        <td>
                            <?=(!empty($activity['Activity']['incharge']))?h($activity['Activity']['incharge']):" － "?>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4" class="success">活動日期</th>
                    </tr>
                    <tr>
                        <td>
                            開始
                        </td>
                        <td>
                            <?=h($activity['Activity']['startdate'])?>
                        </td>
                        <td>
                            結束
                        </td>
                        <td>
                            <?=h($activity['Activity']['enddate'])?>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4" class="success">收費</th>
                    </tr>
                    <tr>
                        <td colspan="2"><?=__('收據顏色')?></td>
                        <td colspan="2">
                            <?=h($activity['Eventproposal']['paymentcodecolor'])?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">基本收費</td>
                        <td colspan="2">
                            $<?=money_format("%i", $activity['Activity']['fee'])?>
                            <?if($activity['Activity']['memberonly']){
                            ?>
                                <a href="#" class="label label-info label-tag">只限會員</a>
                          <?}?>

                        </td>
                    </tr>
                    <?
                    if(!empty($activity['Activityfee'])){
                        foreach($activity['Activityfee'] as $otherfee){
                            ?>
                            <tr>
                                <td colspan="2"><?=h($otherfee['Membertype']['name'])?></td>
                                <td colspan="2">$<?=money_format("%i", $otherfee['fee'])?></td>
                            </tr>
                        <?
                        }
                    }
                    if(!empty($activity['Activity']['remarks'])){
                    ?>
                    <tr>
                        <th colspan="4" class="success">備註</th>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <?=h($activity['Activity']['remarks'])?>
                        </td>
                    </tr>
                    <?}?>
                </table>
            </div>
        </div>

        <div class="panel colourable" id="searcharea">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <span class="panel-title"><i class="fa fa-info-circle"></i> 參加者</span>
                <ul class="nav nav-tabs nav-tabs-xs nav-tabs-simple">
                    <li class="active">
                        <a href="#member" data-toggle="tab">會員報名</a>
                    </li>
                    <?if(!$activity['Activity']['memberonly']){
                    ?>
                    <li>
                        <a href="#non-member" data-toggle="tab">非會員報名</a>
                    </li>
                    <?}?>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="member">
<!--                            !!!!!form-->
                        <?php echo $this->Form->create('Member', array('class'=>'form', "id"=>"advserachform", 'action'=>'ajax_checkinfo')); ?>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <?php echo $this->Form->label("membercard", __('會員卡'), 'col-sm-3 control-label'); ?>
                                <div class="col-sm-9">
                                    <?php echo $this->Form->input("membercard", array('div'=>false, 'label'=>false, 'class'=>'form-control', "readonly"=>"readonly", "id"=>"smartcard"));?>
                                </div>
                            </div> <!-- / .form-group -->
                        </div>

                        <div class="row">
                            <div class="form-group col-xs-12">
                                <?php echo $this->Form->label('code', __('會員編號'), 'col-sm-3 control-label'); ?>
                                <div class="col-sm-9">
                                    <?php echo $this->Form->input('code', array('div'=>false, 'label'=>false, 'class'=>'form-control', "id"=>"membercode"));?>
                                </div>
                            </div> <!-- / .form-group -->
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-success btn-block" onclick="advmembersearch();" data-loading-text="Loading..." id="membersearchbtn"><i class="fa fa-search"></i> 搜尋</button>
                            </div>
                        </div>
                        <br />
                        <?=$this->Html->link('＋ 其他方法', array("controller"=>"members", "action"=>"advsearch"), array("class"=>"openasnew"))?>
                        <?php echo $this->Form->end(); ?>
                        <!--                            !!!!!form-->
                        <!--result-->
                        <div class="row panel-info" id="memberresult" style="display:none">
                            <hr />
                            <div class="panel-heading">
                                結果
                            </div>
                            <div class="panel-body">
                                <table class="table" >
                                    <thead>
                                    <tr>
                                        <th>會員編號(如有)</th>
                                        <th>姓名(中)</th>
                                        <th>姓名(英)</th>
                                        <th>身份証/出世紙號碼</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody id="advserachresult">

                                    </tbody>
                                </table>
                            </div>
                        </div>
<!--                            result-->
                    </div> <!-- / .tab-pane -->
                    <?if(!$activity['Activity']['memberonly']){
                    ?>
                    <div class="tab-pane fade" id="non-member">
                        <?php echo $this->Form->create('Member', array('class'=>'form', "id"=>"nonmemberform")); ?>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <?php echo $this->Form->label('c_name', __('姓名(中)'), 'col-sm-2 control-label'); ?>
                                <div class="col-sm-10">
                                    <?php echo $this->Form->input('c_name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'nonmember_cname'));?>
                                </div>
                            </div> <!-- / .form-group -->
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <?php echo $this->Form->label('e_name', __('姓名(英)*'), 'col-sm-2 control-label'); ?>
                                <div class="col-sm-10">
                                    <?php echo $this->Form->input('e_name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'required'=>'required', 'id'=>'nonmember_ename'));?>
                                </div>
                            </div> <!-- / .form-group -->
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <?php echo $this->Form->label('tel', __('電話'), 'col-sm-2 control-label'); ?>
                                <div class="col-sm-10">
                                    <?php echo $this->Form->input('tel', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control phonemask', 'id'=>'nonmember_tel'));?>
                                </div>
                            </div> <!-- / .form-group -->
                        </div>

                        <div class="row">
                            <div class=" col-xs-12">
                                <?=$this->Html->link("<i class='fa fa-plus'></i> 加入", "javascript:void(0)", array('class'=>"btn btn-primary btn-block", "escape"=>false, 'onclick'=>'addnonmeber();'));?>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                        <br />
                        <div class="panel-heading">
                            其他方式
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-xs-12" id="xlf_group">
                                <?php echo $this->Form->label('xlfile', __('匯入名單'), 'col-sm-2 control-label'); ?>
                                <div class="col-sm-10">
                                    <?=$this->Form->input("file", array("type"=>"file", "label"=>false, "div"=>false, "id"=>"styled-finput","required"=>"required", "class"=>"form-control", "id"=>"xlf"));?>
                                </div>
                            </div>
                        </div>

                    </div> <!-- / .tab-pane -->
                    <?}?>
                </div>
            </div>
        </div>

        <div class="panel colourable">
                <div class="panel-heading">
                    <span class="panel-title"><i class="fa fa-info-circle"></i> 已加入</span>
                </div>

                <div class="panel-body">
                    <?php echo $this->Form->create('Activityapplicant', array('class'=>'form-horizontal', "action"=>"ajax_apply","id"=>"activityapplicant_form")); ?>

                    <?php echo $this->Form->hidden('Activityapplication.activity_id', array('value'=>$activity['Activity']['id']));?>
                    <?php echo $this->Form->hidden('Activityapplication.date', array('value'=>date("Y-m-d")));?>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <?php echo $this->Form->label('Activityapplication.user_id', __('負責職員'), 'col-sm-2 control-label'); ?>
                            <div class="col-sm-10">
                                <?php echo $this->Form->hidden('Activityapplication.user_id', array('value'=>$auth['id']));?>
                                <?php echo $this->Form->input('Activityapplication.user_name', array('readonly'=>"readonly",'div'=>false, 'label'=>false, 'class'=>'form-control', "default"=>h($auth['name'])));?>
                            </div>
                        </div> <!-- / .form-group -->
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <?php echo $this->Form->label('Activityapplication.payment_code', __('payment_code')."*", 'col-sm-2 control-label'); ?>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Activityapplication.payment_code', array('div'=>false, 'label'=>false, 'class'=>'form-control', "required"=>"required", 'placeholder'=>__('payment_code')));?>
                            </div>
                        </div> <!-- / .form-group -->
                    </div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <?php echo $this->Form->label('Activityapplication.remarks', __('備註'), 'col-sm-2 control-label'); ?>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Activityapplication.remarks', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                            </div>
                        </div> <!-- / .form-group -->
                    </div>
                    <!-- Table -->
                    <table class="table" >
                        <thead>
                        <tr>
                            <th style="width:20%">會員編號(類)</th>
                            <th style="width:20%">姓名(中)</th>
                            <th style="width:20%">姓名(英)</th>
                            <th style="width:20%">電話</th>
                            <th style="width:10%">費用(HKD)</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="activityapplicant">

                        </tbody>
                    </table>
                    <hr/>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <?php echo $this->Form->label('Activityapplication.totalcost', __('總數 (HKD)'), 'col-sm-2 control-label'); ?>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('Activityapplication.totalcost', array('div'=>false, 'label'=>false, 'class'=>'form-control', "required"=>"required", "default"=>0, "readonly"=>"readonly", "id"=>"totalcost"));?>
                            </div>
                        </div> <!-- / .form-group -->
                    </div>
                    <div class="row" id="confirmapply" style="display:none">
                        <div class="col-xs-12">
                            <?=$this->Html->link("<i class='fa fa-check'></i> 確定報名", "javascript:void(0)", array('class'=>"btn btn-primary btn-block", "escape"=>false, "id"=>"applybtn", "data-loading-text"=>"正在完成報名...."));?>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
        </div>
    </div>
</div>

<div id="warningalert" class="modal modal-alert modal-warning fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-warning"></i>
            </div>
            <div class="modal-title">注意</div>
            <div class="modal-body" id="warningalertmsg"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>

<div id="applying" class="modal modal-alert modal-success fade"  data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-spinner"></i>
            </div>
            <div class="modal-title">正在完成報名</div>
            <div class="modal-body">請不要關閉視窗</div>
            <div class="modal-footer">
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>

    <script>
        var max_application = <?=$quota?>;
        var application_number = 0;
        var applicant_count = 0;
        var memberapplicantarray = [];

        function countcost(){
            var tt = 0;
            $.each($(".feecount"), function(){
                tt += parseFloat($(this).val());
            });
            $("#totalcost").val(tt);
        }

        function application_numberchange(change){
            if(change < 0){
                application_number += change;
            }else{
                if((application_number + change) <= max_application){
                    application_number += change;
                }else{
                    $("#warningalertmsg").html("活動報名餘額只有<?=h($quota)?>人，活動已沒有餘額。");
                    $("#warningalert").modal('show');
                    return false;
                }
            }

            if(application_number > 0){
                $("#confirmapply").show();
            }else{
                $("#confirmapply").hide();
            }
            return true;
        }

        function advmembersearch(){
            $("#advserachresult").html('');
            $("#membersearchbtn").button("loading");

            $.ajax({
                type: "POST",
                url: "<?=$this->Html->url(array("controller"=>"members", 'action'=>'ajax_checkinfo'))?>",
                data: $("#advserachform").serialize(),
                dataType: "json"
            })
                .done(function( msg ) {
                    if(msg.result){
                        $.each(msg.result, function( index, value ) {
                            var _html = "<tr>";
                            _html += "<td>"+escapeHtml(value.Member['code'])+"</td>";
                            _html += "<td>"+escapeHtml(value.Member['c_name'])+"</td>";
                            _html += "<td>"+escapeHtml(value.Member['e_name'])+"</td>";
                            _html += "<td>"+escapeHtml(value.Member['identity'])+"</td>";
                            _html += '<td><a href="javascript:void(0)" class="btn btn-primary" onclick="addapplicants_member(\''+escapeHtml(value.Member['id'])+'\'); "><i class="fa fa-plus"></i></a></td>';
                            _html += "</tr>";
                            $("#advserachresult").append(_html);
                            $("#memberresult").show();
                            //$(document).scrollTop( $("#memberresult").offset().top );

                        });
                    }else{
                        $("#warningalertmsg").html(msg.errormsg);
                        $("#warningalert").modal('show');
                    }
                })
                .fail(function() {
                    $("#warningalertmsg").html("Connection Fail! Please try again.");
                    $("#warningalert").modal('show');
                })
                .always(function(){
                    $("#membersearchbtn").button("reset");
                });
        }

        function resetadvsearch(){
            $("#advserachform").clearForm();
            $("#advserachresult").html('');
            $("#memberresult").hide();
        }

        function addnonmeber(){
            if($("#nonmemberform").valid()){
                if(application_numberchange(1)){
                    var c_name = escapeHtml($("#nonmember_cname").val());
                    var e_name = escapeHtml($("#nonmember_ename").val());
                    var tel = escapeHtml($("#nonmember_tel").val());

                    var _html = "<tr class='activityapplicantrow'>";
                    _html += "<td>";
                    _html += "";
                    _html += '<input type="hidden" name="Activityapplicant['+applicant_count+'][c_name]" value="'+c_name+'">';
                    _html += '<input type="hidden" name="Activityapplicant['+applicant_count+'][e_name]" value="'+e_name+'">';
                    _html += '<input type="hidden" name="Activityapplicant['+applicant_count+'][activity_id]" value="<?=h($activity['Activity']['id'])?>">';
                    _html +="</td>";
                    _html += "<td>"+c_name+"</td>";
                    _html += "<td>"+e_name+"</td>";
                    _html += '<td><div class="form-group col-xs-12"><input class="form-control vd_phone" id="phonemask'+applicant_count+'" name="Activityapplicant['+applicant_count+'][tel]" value="'+tel+'"></div></td>';
                    _html += '<td><div class="form-group col-xs-12"><input class="form-control feecount vd_isnumber" name="Activityapplicant['+applicant_count+'][cost]" value="<?=h($activity['Activity']['fee'])?>" required></div></td>';
                    _html += '<td><a href="javascript:void(0)" class="btn btn-danger " id="removerow'+applicant_count+'" data-count="'+applicant_count+'"><i class="fa fa-times"></i></a></td>';
                    _html += "</tr>";
                    $("#activityapplicant").append(_html);
                    $(document).scrollTop( $("#activityapplicant").offset().top );

                    //phonemask($("#phonemask"+applicant_count));
                    countcost();
                    $( "#removerow"+applicant_count).bind( "click", function() {
                        $(this).closest('.activityapplicantrow').remove();
                        application_numberchange(-1);
                        countcost();
                    });
                    memberapplicantarray[applicant_count] = null;
                    applicant_count++;
                    $("#nonmemberform").clearForm();
                }
            }
        }

        function addapplicants_member(id){

            $.ajax({
                type: "POST",
                url: "<?=$this->Html->url(array("controller"=>"activityapplicants", 'action'=>'getactivityfee_member',$activity['Activity']['id']))?>/"+id,
                dataType: "json"
            })
            .done(function( msg ) {
                if(msg.result){
                    console.log(msg.result);
                        var value = msg.result;
                        if ($.inArray(value.Member['id'], memberapplicantarray)>-1){
                            $("#warningalertmsg").html(value.Member['e_name']+" 會員已加入了！");
                            $("#warningalert").modal('show');
                            return;
                        }
                        if(application_numberchange(1)){
                            var _html = "<tr class='activityapplicantrow'>";
                            _html += "<td>";
                            _html += value.Member['code']+" ("+value.Member['membertype']+")";
                            _html += '<input type="hidden" name="Activityapplicant['+applicant_count+'][ismember]" value="1">';
                            _html += '<input type="hidden" name="Activityapplicant['+applicant_count+'][member_id]" value="'+value.Member['id']+'">';
                            _html += '<input type="hidden" name="Activityapplicant['+applicant_count+'][activity_id]" value="<?=h($activity['Activity']['id'])?>">';
                            _html += '<input type="hidden" name="Activityapplicant['+applicant_count+'][c_name]" value="'+escapeHtml(value.Member['c_name'])+'">';
                            _html += '<input type="hidden" name="Activityapplicant['+applicant_count+'][e_name]" value="'+escapeHtml(value.Member['e_name'])+'">';
                            _html +="</td>";
                            _html += "<td>"+escapeHtml(value.Member['c_name'])+"</td>";
                            _html += "<td>"+escapeHtml(value.Member['e_name'])+"</td>";
                            _html += '<td><div class="form-group col-xs-12"><input class="form-control vd_phone" id="phonemask'+applicant_count+'" name="Activityapplicant['+applicant_count+'][tel]" value="'+value.Member['tel']+'"></div></td>';
                            _html += '<td><div class="form-group col-xs-12"><input class="form-control feecount vd_isnumber" name="Activityapplicant['+applicant_count+'][cost]" value="'+value['fee']+'" required></div></td>';
                            _html += '<td><a href="javascript:void(0)" class="btn btn-danger " id="removerow'+applicant_count+'" data-count="'+applicant_count+'"><i class="fa fa-times"></i></a></td>';
                            _html += "</tr>";
                            $("#activityapplicant").append(_html);
                            $(document).scrollTop( $("#activityapplicant").offset().top );
                            //phonemask($("#phonemask"+applicant_count));
                            countcost();

                            memberapplicantarray[applicant_count] = value.Member['id'];
                            $( "#removerow"+applicant_count).bind( "click", function() {
                                var data_count = $(this).attr('data-count');
                                memberapplicantarray[data_count] = null;
                                $(this).closest('.activityapplicantrow').remove();
                                application_numberchange(-1);
                                countcost();
                            });
                            applicant_count++;
                            resetadvsearch();
                        }

                }else{
                    $("#warningalertmsg").html(msg.errormsg);
                    $("#warningalert").modal('show');
                }
            });
        }

        function confirmapply(){

            $("#applying").modal("show");
            $("#applybtn").button("loading");
            $.ajax({
                type: "POST",
                url: "<?=$this->Html->url(array("controller"=>"activityapplicants", 'action'=>'ajax_apply'))?>",
                data: $("#activityapplicant_form").serialize(),
                dataType: "json"
            })
            .fail(function() {
                $("#applying").modal("hide");
                $("#applybtn").button("reset");
                $("#warningalertmsg").html("Connection Fail! Please try again.");
                $("#warningalert").modal('show');
            })
            .done(function( msg ) {
//                    console.log(msg);
                    if(msg.result){
                        var urlredirect = "<?=$this->Html->url(array("controller"=>"activityapplications", 'action'=>'receipt'))?>/"+msg.result['id'];
                        window.top.location = urlredirect;
                    }else{
                        $("#applying").modal("hide");
                        $("#applybtn").button("reset");
                        $("#warningalertmsg").html(msg.errormsg);
                        $("#warningalert").modal('show');
                    }
            });
        }

        //=====xls=====
        var X = XLSX;

        function fixdata(data) {
            var o = "", l = 0, w = 10240;
            for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint8Array(data.slice(l*w,l*w+w)));
            o+=String.fromCharCode.apply(null, new Uint8Array(data.slice(l*w)));
            return o;
        }

        function to_json(workbook) {
            var result = {};
            workbook.SheetNames.forEach(function(sheetName) {
                var roa = X.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                if(roa.length > 0){
                    result[sheetName] = roa;
                }
            });
            return result;
        }

        function process_wb(wb) {
            //here
            var errorcount = 0;
            var successfulcount = 0;
            var json = to_json(wb);
            $.each(json['Sheet1'], function(i, item) {
                if(i != 0){
                    if(typeof item.English_name !== 'string'){
                        errorcount ++;
                    }else if(application_numberchange(1) && typeof item.English_name === 'string'){
                        if(typeof item.Chinese_name !== 'undefined'){
                            var c_name = escapeHtml(item.Chinese_name);
                        }else{
                            var c_name = '';
                        }

                        var e_name = escapeHtml(item.English_name);
                        if(typeof item.tel !== 'undefined'){
                            var tel = escapeHtml(item.tel);
                        }else{
                            var tel = "";
                        }

                        var _html = "<tr class='activityapplicantrow'>";
                        _html += "<td>";
                        _html += "";
                        _html += '<input type="hidden" name="Activityapplicant['+applicant_count+'][c_name]" value="'+c_name+'">';
                        _html += '<input type="hidden" name="Activityapplicant['+applicant_count+'][e_name]" value="'+e_name+'">';
                        _html += '<input type="hidden" name="Activityapplicant['+applicant_count+'][activity_id]" value="<?=h($activity['Activity']['id'])?>">';
                        _html +="</td>";
                        _html += "<td>"+c_name+"</td>";
                        _html += "<td>"+e_name+"</td>";
                        _html += '<td><div class="form-group col-xs-12"><input class="form-control vd_phone" id="phonemask'+applicant_count+'" name="Activityapplicant['+applicant_count+'][tel]" value="'+tel+'"></div></td>';
                        _html += '<td><div class="form-group col-xs-12"><input class="form-control feecount vd_isnumber" name="Activityapplicant['+applicant_count+'][cost]" value="<?=h($activity['Activity']['fee'])?>" required></div></td>';
                        _html += '<td><a href="javascript:void(0)" class="btn btn-danger " id="removerow'+applicant_count+'" data-count="'+applicant_count+'"><i class="fa fa-times"></i></a></td>';
                        _html += "</tr>";
                        $("#activityapplicant").append(_html);
                        $(document).scrollTop( $("#activityapplicant").offset().top );

                        //phonemask($("#phonemask"+applicant_count));
                        countcost();
                        $( "#removerow"+applicant_count).bind( "click", function() {
                            $(this).closest('.activityapplicantrow').remove();
                            application_numberchange(-1);
                            countcost();
                        });
                        memberapplicantarray[applicant_count] = null;
                        applicant_count++;
                        successfulcount++;
                    }
                }

            });
            $("#xlf_group .pfi-clear").click();
            $.growl.notice({title: '系統',message: "成功匯入"+successfulcount+"人" });
            if(errorcount > 0){
                $.growl.warning({title: '系統',message: errorcount+"個匯入失敗。原因：資料不正確。" });
            }

            $(document).scrollTop( $("#activityapplicant").offset().top );
        }

        function handleFile(e) {
            var files = e.target.files;
            var f = files[0];
            {
                var reader = new FileReader();
                var name = f.name;
                reader.onload = function(e) {
                    var data = e.target.result;
                    var wb;
                    var arr = fixdata(data);
                    wb = X.read(btoa(arr), {type: 'base64'});
                    process_wb(wb);
                };
                reader.readAsArrayBuffer(f);
            }
        }
        //=====xls=====

        $(document).ready(function() {
            <?if(!$enrolstatuscheck){?>
                bootbox.dialog({
                    message: "警告： <?=$enrolstatuscheckmsg?>",
                    title: "你要繼續？",
                    className: "bootbox-sm",
                    closeButton: false,
                    buttons: {
                        success: {
                            label: "取消",
                            className: "btn-success",
                            callback: function() {
                                window.close();
                            }
                        },
                        danger: {
                            label: "繼續",
                            className: "btn-danger",
                            callback: function() {

                            }
                        }
                    }
                });
            <?}?>

            $.fn.clearForm = function() {
                return this.each(function() {
                    $("#membercode").unmask();
                    $(".phonemask").unmask();
                    $(".phonemask").attr('applymask', '');

                    var type = this.type, tag = this.tagName.toLowerCase();
                    if (tag == 'form')
                        return $(':input',this).clearForm();
                    if (type == 'text' || type == 'password' || tag == 'textarea')
                        this.value = '';
                    else if (type == 'checkbox' || type == 'radio')
                        this.checked = false;
                    else if (tag == 'select')
                        this.selectedIndex = -1;

                    formatmask($("#membercode"), '<?=configure::read('Member.code_mask')?>');
                    //phonemask($(".phonemask"));
                });
            };
            //phonemask($(".phonemask"));

            $('#submitbutton').attr('disabled','disabled');
            $('#volunteerinfo').hide();


            $("#nonmemberform").validate();
            $("#activityapplicant_form").validate();

            $("#applybtn").on("click", function(){
                if($("#activityapplicant_form").valid()){
                    bootbox.confirm({
                        message: "是否確認完成報名?",
                        callback: function(result) {
                            if(result){
                                confirmapply();
                            }
                        },
                        className: "bootbox-sm"
                    });
                }
            });
            $("#activityapplicant_form").on('change', '.feecount', function(){
                countcost();
            });

            $('#smartcard').scannerdevice(
                {
                    onAfterScan: function(){advmembersearch()}
                }
            );
            formatmask($("#membercode"), '<?=configure::read('Member.code_mask')?>');
            <!--Matching-->

//            xls
            <?if(!$activity['Activity']['memberonly']){?>
                $('#xlf').pixelFileInput({ placeholder: '只限 XLSX / XLSM / XLSB / ODS / XLS / XML ' });
                var xlf = document.getElementById('xlf');
                if(xlf.addEventListener) xlf.addEventListener('change', handleFile, false);
            <?}?>
        });
    </script>