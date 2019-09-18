<?php

    $paymentmethod = array(
        "現金",
        "支票",
        "八達通"
    );

    $paymenttype = array(
        "租借",
        "補拎會員証",
        "飯票",
        "其他"
    );
?>


<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-usd page-header-icon"></i>&nbsp;&nbsp;<?=__("收款")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Member', array('class'=>'panel form-horizontal validate_form preventDoubleSubmission')); ?>
        <?php echo $this->Form->hidden('active', array('value'=>1));?>
        <div class="panel-heading">
            <span class="panel-title"><?php echo __('收款資料'); ?></span>
            <div class="panel-heading-controls">
            </div>
        </div>

        <div class="panel-body">

            <div class="form-group">
                <?php echo $this->Form->label('Memberapplication.paymentmethod', __('收款方式*'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('Memberapplication.paymentmethod', array(
                            'label'=>false,
                            'div'=>false,
                            'options'=>$paymentmethod,
                            'class'=>'form-control select2-multiple',
                            'required'=>true,
                            "empty"=>true
                        )
                    );?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('Memberapplication.membertype_id', __('收款類別*'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('Memberapplication.membertype_id', array(
                            'label'=>false,
                            'div'=>false,
                            'options'=>$paymenttype,
                            'class'=>'form-control select2-multiple',
                            'required'=>true,
                            "empty"=>true
                        )
                    );?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('Memberapplication.price', __('費用')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Memberapplication.price', array('div'=>false, 'label'=>false, 'class'=>'form-control', "required"=>"required"));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('Memberapplication.remarks', __('備註'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Memberapplication.remarks', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->

        </div>

        <div class="panel-heading">
            <span class="panel-title"><?php echo __('內部用途'); ?></span>
        </div>

        <div class="panel-body">

            <div class="form-group">
                <?php echo $this->Form->label('Memberapplication.unit_id', __('填寫單位*'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('Memberapplication.unit_id', array(
                            'label'=>false,
                            'div'=>false,
                            'class'=>'form-control select2-multiple',
                            'required'=>true,
                            "empty"=>true
                        )
                    );?>

                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('t.username', __('填寫職員'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('t.username', array('div'=>false, 'label'=>false, 'class'=>'form-control', "default"=>$auth['name'], 'disabled'=>"disabled"));?>
                </div>
            </div>

        </div>

        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>

    </div>

    <!-- Success -->
    <div id="hkidok" class="modal modal-alert modal-success fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa fa-check-circle"></i>
                </div>
                <div class="modal-title">香港身份証認証</div>
                <div class="modal-body">正確</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                </div>
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div> <!-- / .modal -->
    <!-- / Success -->

    <!-- Danger -->
    <div id="hkidfail" class="modal modal-alert modal-danger fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa fa-times-circle"></i>
                </div>
                <div class="modal-title">香港身份証認証</div>
                <div class="modal-body">不正確</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
                </div>
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div> <!-- / .modal -->
    <!-- / Danger -->


    <script>

        //    var matching_card = false;

        function cal_expect_expiry_date(){
            var org = $("#startdate").val();
            var period = $("#periodinput").val();
            period = parseInt(period);
            if(!period){
                period = 0;
            }
            if(org){
                var newdate = new Date(org);
                newdate.setFullYear(newdate.getFullYear() + period);

                var yyyy = newdate.getFullYear().toString();
                var mm = newdate.getMonth().toString(); // getMonth() is zero-based
                var dd  = newdate.getDate().toString();
                $('#enddate').datepicker('setDate',  new Date(yyyy, mm, dd));
            }
            cal_membershipt_period_d();
        }

        function cal_membershipt_period_d(){
            var end = $("#enddate").val();
            var org = $("#startdate").val();

            if(end && org){

                moment().format();
                var startdate = moment(org);
                var enddate = moment(end);
                var diffDays = Math.ceil(enddate.diff(startdate, 'days'));

                $("#period_d").val(diffDays);
            }
        }

        function cal_membershipt_period(){
            var end = $("#enddate").val();
            var org = $("#startdate").val();

            if(end && org){

                moment().format();
                var startdate = moment(org);
                var enddate = moment(end);
                var diffDays = Math.ceil(enddate.diff(startdate, 'years', true));

                $("#periodinput").val(diffDays);
                cal_membershipt_period_d();
            }
        }

        function checkidentitytypeID(){
            var identitytypeID = $("#identitytypeID").val();
            if(identitytypeID == 1){
                $("#HKIDcheckbtndiv").show();
            }else{
                $("#HKIDcheckbtndiv").hide();
            }
        }

        function importmembertmp(mcode){
            $.ajax({
                type: "POST",
                url: "<?=$this->Html->url(array("controller"=>"membertmps", 'action'=>'ajax_import'))?>",
                data: {
                    code: mcode
                },
                dataType: "json"
            })
                .done(function( msg ) {
                    if(!msg){
                        bootbox.alert({
                            message: "找不到相關記錄",
                            callback: function() {

                            },
                            className: "bootbox-sm"
                        });
                    }else{
                        var obj = $.parseJSON(msg.Membertmp.json);
                        $.each(obj, function(key, value){
                            if(key === "Member"){
                                $.each(value, function(k, v){
                                    if($("[name='data["+key+"]["+k+"]']" ).hasClass('select2')){
                                        $("[name='data["+key+"]["+k+"]']").select2("val", v);
                                    }else if($("[name='data["+key+"]["+k+"]']" ).is(':checkbox')){
                                        if(v == "1"){
                                            $("[name='data["+key+"]["+k+"]']" ).prop('checked', true);
                                        }
                                        else{
                                            $("[name='data["+key+"]["+k+"]']" ).prop('checked', false);
                                        }
                                    }else{
                                        $("[name='data["+key+"]["+k+"]']" ).val(v);
                                    }
                                })
                            }
                            if(key === "MemberCustomField"){
                                $.each(value, function(k, v){
                                    if($("[name='data["+key+"]["+ v.memberinputfield_id+"][value]']" ).hasClass('isselect2')){
                                        $("[name='data["+key+"]["+ v.memberinputfield_id+"][value]']" ).select2("val", v.value);
                                    }else{
                                        $("[name='data["+key+"]["+ v.memberinputfield_id+"][value]']" ).val(v.value);
                                    }
                                })
                            }
                        });
                        $.growl.notice({ title: "成功", message: "匯入成功" });
                    }
                })
                .always(function(){
                    $(".checkhkidbtn").button("reset");
                });
        }

        $(document).ready(function() {
            validate_form();
            checkidentitytypeID();

            $('.membercard').scannerdevice();

            var options2 = {
                autoclose: true,
                todayBtn: "linked",
                format: 'yyyy-mm-dd',
                orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
                <?if(!empty($_cutoffdate)){?>
                startDate:'<?=h($_cutoffdate['Cutoffdate']['name'])?>'
                <?}?>
            };
            $('.datepicker-range').datepicker(options2);

            $('#startdate').datepicker()
                .on('hide', function(e){
                        cal_expect_expiry_date();
                    }
                );

            $('#enddate').datepicker()
                .on('hide', function(e){
                        cal_membershipt_period();
                    }
                );

            var paymentdateoptions = {
                orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayBtn: "linked"
                <?
                if(!empty($_cutoffdate)){
                ?>
                ,startDate:'<?=h($_cutoffdate['Cutoffdate']['name'])?>'
                <?
                }
                ?>
            };
            $('#paymentdate').datepicker(paymentdateoptions);

            $.validator.addClassRules("vd_identity", {
                remote: {
                    url:"<?=$this->Html->url(array('action'=>'ajax_checkunique'));?>",
                    type:"post",
                    data:{
                        field: 'identity',
                        value: function() {
                            return $("#identity").val();
                        }
                    }
                }
            });

            $("#identitytypeID").change(function(){
                checkidentitytypeID();
            });

            $("#periodinput").change(function(){
                cal_expect_expiry_date();
            });

            $(".checkhkidbtn").click(function(){
                var targetid = $(this).attr('data-hkid');
                $(".checkhkidbtn").button('loading');
                $.ajax({
                    type: "POST",
                    url: "<?=$this->Html->url(array("controller"=>"members", 'action'=>'ajax_checkidentity'))?>",
                    data: {
                        hkid: $("#"+targetid).val()
                    },
                    dataType: "json"
                })
                    .done(function( msg ) {
                        if(msg){
                            $("#hkidok").modal('show');
                        }else{
                            $("#hkidfail").modal('show');
                        }
                    })
                    .always(function(){
                        $(".checkhkidbtn").button("reset");
                    });
            });

            $(".importmembertmpbtn").click(function(){
                bootbox.prompt({
                    title: "會員表格登記號碼",
                    callback: function(result) {
                        if (result === null) {
                            //alert("請填上登記號碼！");
                        } else {
                            importmembertmp(result);
                        }
                    },
                    className: "bootbox-sm"
                });
            });
        });
    </script>
