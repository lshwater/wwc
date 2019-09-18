<?php $this->Html->script("barcode/jquery.scannerdetection.compatibility", array("inline"=>false)); ?>
<?php $this->Html->script('barcode/jquery.scannerdetection', array("inline"=>false)); ?>
<?php $this->Html->script('membercard', array("inline"=>false)); ?>

<?php $this->Html->script("datatable/jszip.min", array("inline"=>false)); ?>
<?php $this->Html->script("xls/xlsx.core.min", array("inline"=>false)); ?>

<?
$volunteertypename = h($volunteertype['Volunteertype']['name']);
?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-bullhorn page-header-icon"></i>&nbsp;&nbsp;<?=$volunteertypename.__("報名")?>
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
    <span class="panel-title">活動<?=$volunteertypename?>報名</span>
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
                <td colspan="3">
                    <?=h($activity['Activity']['name'])?>
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
        </table>
    </div>
</div>

<div class="panel colourable" id="searcharea">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <span class="panel-title"><i class="fa fa-info-circle"></i> <?=$volunteertypename?></span>
        <ul class="nav nav-tabs nav-tabs-xs nav-tabs-simple">
            <li class="active">
                <a href="#member" data-toggle="tab">已登記<?=$volunteertypename?>報名</a>
            </li>
            <li>
                <a href="#non-member" data-toggle="tab">一次性<?=$volunteertypename?>報名</a>
            </li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade active in" id="member">
                <!--                            !!!!!form-->
                <?php echo $this->Form->create('Volunteer', array('class'=>'form', "id"=>"advserachform", "action"=>"ajax_matching")); ?>
                <?php echo $this->Form->hidden('Volunteertype', array('value'=>$volunteertype['Volunteertype']['id']));?>

                <div class="row">
                    <div class="form-group col-xs-12">
                        <?php echo $this->Form->label("membercard", __('智能証'), 'col-sm-3 control-label'); ?>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input("membercard", array('div'=>false, 'label'=>false, 'class'=>'form-control', "readonly"=>"readonly", "id"=>"smartcard"));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <?php echo $this->Form->label('code', __('編號'), 'col-sm-3 control-label'); ?>
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('code', array('div'=>false, 'label'=>false, 'class'=>'form-control', "id"=>"vcode"));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>
                <div class="form-group">
                    <?php echo $this->Form->label('c_name', __('姓名(中)'), 'col-sm-3 control-label'); ?>
                    <div class="col-sm-9">
                        <?php echo $this->Form->input('c_name', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                    </div>
                </div> <!-- / .form-group -->
                <div class="form-group">
                    <?php echo $this->Form->label('e_name', __('姓名(英)'), 'col-sm-3 control-label'); ?>
                    <div class="col-sm-9">
                        <?php echo $this->Form->input('e_name', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                    </div>
                </div> <!-- / .form-group -->
                <div class="form-group">
                    <?php echo $this->Form->label('phone_main', __('電話(主要)'), 'col-sm-3 control-label'); ?>
                    <div class="col-sm-9">
                        <?php echo $this->Form->input('phone_main', array('div'=>false, 'label'=>false, 'class'=>'form-control phonemask'));?>
                    </div>
                </div> <!-- / .form-group -->
                <br />
                <div class="row">
                    <div class="col-xs-12">
                        <button type="button" class="btn btn-success btn-block" onclick="advmembersearch();" data-loading-text="Loading..." id="membersearchbtn"><i class="fa fa-search"></i> 搜尋</button>
                    </div>
                </div>
                <br />

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
                                <th>編號</th>
                                <th>姓名(中)</th>
                                <th>姓名(英)</th>
                                <th>電話</th>
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

            <div class="tab-pane fade" id="non-member">
                <?php echo $this->Form->create('Volunteer', array('class'=>'form', "id"=>"nonmemberform")); ?>

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
                            <?php echo $this->Form->input('tel', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control phonemask vd_phone', 'id'=>'nonmember_tel'));?>
                        </div>
                    </div> <!-- / .form-group -->
                </div>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <?php echo $this->Form->label('volunteerunit_id', __('義工機構'), 'col-sm-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('volunteerunit_id', array('div'=>false, 'label'=>false,'class'=>'form-control select2', 'empty'=>true, 'id'=>'nonmember_volunteerunit_id'));?>
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

        </div>
    </div>
</div>

<div class="panel colourable">
    <div class="panel-heading">
        <span class="panel-title"><i class="fa fa-info-circle"></i> 已加入</span>
    </div>

    <div class="panel-body">
        <?php echo $this->Form->create('ActivitiesVolunteer', array('class'=>'form-horizontal validate_form', "action"=>"ajax_apply", "id"=>"activityapplicant_form")); ?>

        <!-- Table -->
        <table class="table" >
            <thead>
            <tr>
                <th style="width:10%">編號</th>
                <th style="width:15%">姓名</th>
                <th style="width:20%">電話</th>
                <th style="width:20%">電郵</th>
                <th style="width:20%">義工機構</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="activityapplicant">

            </tbody>
        </table>
        <hr/>
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

<div id="unitclone" style="display:none">
    <?php echo $this->Form->input('ActivitiesVolunteer.__TMP__.volunteerunit_id', array('div'=>false, 'label'=>false,'class'=>'form-control', 'empty'=>true, "id"=>""));?>
</div>

<script>
    var max_application = 999;
    var application_number = 0;
    var applicant_count = 0;
    var memberapplicantarray = [];
    var unitclonehtml = $("#unitclone").html();

    function application_numberchange(change){
        application_number += change;

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
            url: "<?=$this->Html->url(array("controller"=>"volunteers", 'action'=>'ajax_matching'))?>",
            data: $("#advserachform").serialize(),
            dataType: "json"
        })
        .done(function( msg ) {
            if(msg.result){
                $.each(msg.result, function( index, value ) {
                    var _html = "<tr>";
                    _html += "<td>"+escapeHtml(value.Volunteer['code'])+"</td>";
                    _html += "<td>"+escapeHtml(value.Volunteer['c_name'])+"</td>";
                    _html += "<td>"+escapeHtml(value.Volunteer['e_name'])+"</td>";
                    _html += "<td>"+escapeHtml(value.Volunteer['phone_main'])+"</td>";
                    _html += '<td><a href="javascript:void(0)" class="btn btn-primary" onclick="addapplicants_member(\''+escapeHtml(value.Volunteer['id'])+'\'); "><i class="fa fa-plus"></i></a></td>';
                    _html += "</tr>";
                    $("#advserachresult").append(_html);
                    $("#memberresult").show();
                });
                //$(document).scrollTop( $("#memberresult").offset().top );
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

    function addapplicants_member(id){
        $.ajax({
            type: "POST",
            url: "<?=$this->Html->url(array("controller"=>"ActivitiesVolunteers", 'action'=>'ajax_validation',$activity['Activity']['id']))?>/"+id,
            dataType: "json"
        })
        .done(function( msg ) {
            if(msg.result){
                var value = msg.result;

                if ($.inArray(value.Volunteer['id'], memberapplicantarray)>-1){
                    $("#warningalertmsg").html(value.Volunteer['code']+" 會員已加入了！");
                    $("#warningalert").modal('show');
                    return;
                }

                var thishtmclone = unitclonehtml.replace('__TMP__', applicant_count);
                var cloneObject = $("<div>"+thishtmclone+"</div>");
                cloneObject.find('select').attr('id', 'unitselect'+applicant_count);

                var _html = "<tr class='activityapplicantrow'>";
                _html += "<td>";
                _html += value.Volunteer['code'];
                _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][volunteer_id]" value="'+escapeHtml(value.Volunteer['id'])+'">';
                _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][volunteertype_id]" value="<?=h($volunteertype['Volunteertype']['id'])?>">';
                _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][activity_id]" value="<?=h($activity['Activity']['id'])?>">';
                _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][c_name]" value="'+escapeHtml(value.Volunteer['c_name'])+'">';
                _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][e_name]" value="'+escapeHtml(value.Volunteer['e_name'])+'">';
                _html +="</td>";
                _html += "<td>"+escapeHtml(value.Volunteer['e_name'])+"<br />"+escapeHtml(value.Volunteer['c_name'])+"</td>";
                _html += '<td><div class="form-group col-xs-12"><input class="form-control vd_phone" id="phonemask'+applicant_count+'" name="ActivitiesVolunteer['+applicant_count+'][tel]" value="'+value.Volunteer['phone_main']+'"></div></td>';
                _html += '<td><div class="form-group col-xs-12"><input class="form-control vd_email" name="ActivitiesVolunteer['+applicant_count+'][email]" value="'+value.Volunteer['email']+'"></div></td>';
                _html += "<td>"+cloneObject.html()+"</td>";
                _html += '<td><a href="javascript:void(0)" class="btn btn-danger " id="removerow'+applicant_count+'" data-count="'+applicant_count+'"><i class="fa fa-times"></i></a></td>';
                _html += "</tr>";
                $("#activityapplicant").append(_html);


                //phonemask($("#phonemask"+applicant_count));
                $('#unitselect'+applicant_count).val(escapeHtml(value.Volunteer['volunteerunit_id']));
                $('#unitselect'+applicant_count).select2({
                    allowClear:true
                });

                application_numberchange(1);
                memberapplicantarray[applicant_count] = value.Volunteer['id'];
                $( "#removerow"+applicant_count).bind( "click", function() {
                    var data_count = $(this).attr('data-count');
                    memberapplicantarray[data_count] = null;
                    $(this).closest('.activityapplicantrow').remove();
                    application_numberchange(-1);
                });
                applicant_count++;
            }else{
                $("#warningalertmsg").html(msg.errormsg);
                $("#warningalert").modal('show');
            }
        });

        resetadvsearch();
    }

    function addnonmeber(){
        if($("#nonmemberform").valid()){
            var c_name = escapeHtml($("#nonmember_cname").val());
            var e_name = escapeHtml($("#nonmember_ename").val());
            var tel = escapeHtml($("#nonmember_tel").val());

            var volunteerunit_id = $("#nonmember_volunteerunit_id").val();
            var thishtmclone = unitclonehtml.replace('__TMP__', applicant_count);
            var cloneObject = $("<div>"+thishtmclone+"</div>");
            cloneObject.find('select').attr('id', 'unitselect'+applicant_count);

            var _html = "<tr class='activityapplicantrow'>";
            _html += "<td>";
            _html += "";
            _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][c_name]" value="'+c_name+'">';
            _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][e_name]" value="'+e_name+'">';
            _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][activity_id]" value="<?=h($activity['Activity']['id'])?>">';
            _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][volunteertype_id]" value="<?=h($volunteertype['Volunteertype']['id'])?>">';
            _html +="</td>";
            _html += "<td>"+e_name+"<br />"+c_name+"</td>";
            _html += '<td><div class="form-group col-xs-12"><input class="form-control vd_phone" id="phonemask'+applicant_count+'" name="ActivitiesVolunteer['+applicant_count+'][tel]" value="'+tel+'"></div></td>';
            _html += '<td><div class="form-group col-xs-12"><input class="form-control vd_email" name="ActivitiesVolunteer['+applicant_count+'][email]" value="<?=h($activity['Activity']['email'])?>"></div></td>';
            _html += "<td>"+cloneObject.html()+"</td>";
            _html += '<td><a href="javascript:void(0)" class="btn btn-danger " id="removerow'+applicant_count+'" data-count="'+applicant_count+'"><i class="fa fa-times"></i></a></td>';
            _html += "</tr>";
            $("#activityapplicant").append(_html);
            $(document).scrollTop( $("#activityapplicant").offset().top);

            //phonemask($("#phonemask"+applicant_count));
            $('#unitselect'+applicant_count).val(volunteerunit_id);
            $('#unitselect'+applicant_count).select2({
                allowClear:true
            });

            application_numberchange(1);
            $( "#removerow"+applicant_count).bind( "click", function() {
                $(this).closest('.activityapplicantrow').remove();
                application_numberchange(-1);
            });

            memberapplicantarray[applicant_count] = null;
            applicant_count++;
            $("#nonmemberform").clearForm();
        }
    }

    function confirmapply(){

        $("#applying").modal("show");
        $("#applybtn").button("loading");
        $.ajax({
            type: "POST",
            url: "<?=$this->Html->url(array("controller"=>"ActivitiesVolunteers", 'action'=>'ajax_apply'))?>",
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
            if(msg.result){
                var urlredirect = "<?=$this->Html->url(array("controller"=>"ActivitiesVolunteers", 'action'=>'receipt'))?>/"+msg.result['id'];
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
                }else if(typeof item.English_name === 'string'){
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


                    var volunteerunit_id = '';
                    var thishtmclone = unitclonehtml.replace('__TMP__', applicant_count);
                    var cloneObject = $("<div>"+thishtmclone+"</div>");
                    cloneObject.find('select').attr('id', 'unitselect'+applicant_count);

                    var _html = "<tr class='activityapplicantrow'>";
                    _html += "<td>";
                    _html += "";
                    _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][c_name]" value="'+c_name+'">';
                    _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][e_name]" value="'+e_name+'">';
                    _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][activity_id]" value="<?=h($activity['Activity']['id'])?>">';
                    _html += '<input type="hidden" name="ActivitiesVolunteer['+applicant_count+'][volunteertype_id]" value="<?=h($volunteertype['Volunteertype']['id'])?>">';
                    _html +="</td>";
                    _html += "<td>"+e_name+"<br />"+c_name+"</td>";
                    _html += '<td><div class="form-group col-xs-12"><input class="form-control vd_phone" id="phonemask'+applicant_count+'" name="ActivitiesVolunteer['+applicant_count+'][tel]" value="'+tel+'"></div></td>';
                    _html += '<td><div class="form-group col-xs-12"><input class="form-control vd_email" name="ActivitiesVolunteer['+applicant_count+'][email]" value="<?=h($activity['Activity']['email'])?>"></div></td>';
                    _html += "<td>"+cloneObject.html()+"</td>";
                    _html += '<td><a href="javascript:void(0)" class="btn btn-danger " id="removerow'+applicant_count+'" data-count="'+applicant_count+'"><i class="fa fa-times"></i></a></td>';
                    _html += "</tr>";
                    $("#activityapplicant").append(_html);

                    //phonemask($("#phonemask"+applicant_count));
                    $('#unitselect'+applicant_count).val(volunteerunit_id);
                    $('#unitselect'+applicant_count).select2({
                        allowClear:true
                    });

                    application_numberchange(1);
                    $( "#removerow"+applicant_count).bind( "click", function() {
                        $(this).closest('.activityapplicantrow').remove();
                        application_numberchange(-1);
                    });

                    memberapplicantarray[applicant_count] = null;
                    applicant_count++;
                }
            }
        });
        $("#xlf_group .pfi-clear").click();
        $.growl.notice({title: '系統',message: "成功匯入"+successfulcount+"人" });
        if(errorcount > 0){
            $.growl.warning({title: '系統',message: errorcount+"個匯入失敗。原因：資料不正確。" });
        }
        $(document).scrollTop( $("#activityapplicant").offset().top);
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
            message: "<?=$enrolstatuscheckmsg?>",
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
                $("#vcode").unmask();
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

                formatmask($("#vcode"), '<?=configure::read('Volunteer.format')?>');
                //phonemask($(".phonemask"));
            });
        };


        $('#submitbutton').attr('disabled','disabled');
        $('#volunteerinfo').hide();

        $("#nonmemberform").validate();

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


        formatmask($("#vcode"), '<?=configure::read('Volunteer.format')?>');
        $('#smartcard').scannerdevice(
            {
                onAfterScan: function(){advmembersearch()}
            }
        );
        //phonemask($(".phonemask"));

        $('#xlf').pixelFileInput({ placeholder: '只限 XLSX / XLSM / XLSB / ODS / XLS / XML ' });
        var xlf = document.getElementById('xlf');
        if(xlf.addEventListener) xlf.addEventListener('change', handleFile, false);
    });
</script>