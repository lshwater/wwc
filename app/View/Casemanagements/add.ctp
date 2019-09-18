
<?php $this->Html->script("barcode/jquery.scannerdetection.compatibility", array("inline"=>false)); ?>
<?php $this->Html->script('barcode/jquery.scannerdetection', array("inline"=>false)); ?>

<?php $this->Html->script('membercard', array("inline"=>false)); ?>

<style>
    .form-horizontal .form-group{
         margin-left: inherit;
         margin-right: inherit;
    }
</style>
<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-suitcase page-header-icon"></i>&nbsp;&nbsp;<?=__("新增個案")?>
        </h1>
        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
            </div>
        </div>
    </div>
</div>

<ul class="breadcrumb">
        <li>
        <?=$this->Html->link(__("我的個案"), array("action"=>"index"))?>
    </li>
    <li class="active"><?=__("新增個案")?></li>
</ul>

<div class="row">
    <div class="col-md-auto">
        <?php echo $this->Form->create('Casemanagement', array('class'=>'form-horizontal panel validate_form preventDoubleSubmission')); ?>
        <div class="panel-heading">
            <span class="panel-title"><?=__('主申請人資料')?></span>
        </div>
        <?php echo $this->Form->hidden("existing_member", array('value'=>1, 'id'=>'is_existing_member'));?>


        <div class="panel-body">

            <div class="col-md-12">

                <div class="panel-group panel-group-success panel-group-dark" id="select_member">
                    <div class="panel">
                        <div class="panel-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#select_member" href="#existing_member">
                                現有會員
                            </a>
                        </div>
                        <div id="existing_member" class="panel-collapse collapse in">
                            <div class="panel-body">

                                <?php echo $this->Form->hidden("membership_id", array('type'=>"text", "id"=>"membership_input"));?>
                                <?php echo $this->Form->hidden("member_id", array('type'=>"text", "id"=>"member_input"));?>

                                <table class="table " id="paidperson">
                                    <thead>
                                    <tr>
                                        <th>姓名</th>
                                        <th>相關會藉</th>
                                    </tr>
                                    <tr class="m-a-0 p-a-0">
                                        <td >
                                            <div class="form-group m-a-0">
                                                <div class="input-group">
                                                    <?php echo $this->Form->input("payer", array('div'=>false, 'label'=>false, 'class'=>'form-control', 'required'=>"required", 'id'=>'paidname', "readonly"=>"readonly"));?>
                                                    <span class="input-group-btn">
                                <?=$this->Html->link('<i class="fa fa-search"></i>', array('controller'=>"members", 'action' => 'popupsearch', 1, 'ajax' => true), array('class' => 'btn ', 'escape' => false, 'data-toggle' => "modal", 'data-target' => '#modal'));?>
                                </span>
                                                </div>
                                            </div>

                                        </td>
                                        <td><span id="paidmembership"></span></td>
                                    </tr>
                                    </thead>
                                </table>


                                <div class="table-responsive" id="records">
                                    <table class="table table-striped table-bordered table-condensed table-hover" id="jq-datatables" width="100%">
                                        <thead>
                                        <tr>
                                            <th>年度</th>
                                            <th>編號</th>
                                            <th>個案類別</th>
                                            <th>個案性質</th>
                                            <th>個案申請日期</th>
                                            <th>下次重檢日期</th>
                                            <th class="actions"><?=__('Actions')?></th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#select_member" href="#new_member">
                                新增服務對象
                            </a>
                        </div>
                        <div id="new_member" class="panel-collapse collapse">
                            <div class="panel-body">

                                <div class="panel">


                                    <div class="panel-heading">
                                        <span class="panel-title"><?php echo __('newmember_title_3'); ?></span>
                                    </div>

                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo $this->Form->label('Newmember.Member.c_name', __('newmember_title_5'), 'control-label'); ?>
                                                    <?php echo $this->Form->input('Newmember.Member.c_name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('c_name')));?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo $this->Form->label('Newmember.Member.e_name', __('姓名(英)'), 'control-label required'); ?>
                                                    <?php echo $this->Form->input('Newmember.Member.e_name', array('div'=>false, 'label'=>false, 'class'=>'form-control', "required"=>"required", 'placeholder'=>__('e_name_first')));?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <?php echo $this->Form->label('Newmember.Member.gender', __('性別'), 'control-label required'); ?>
                                                    <?php echo $this->Form->input('Newmember.Member.gender', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', "required"=>"required", 'empty'=>true, 'options'=>$genders, 'placeholder'=>__('性別')));?>
                                                </div> <!-- / .form-group -->
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo $this->Form->label('Newmember.Member.identitytype_id', __('身份証明文件'), 'control-label '.$required); ?>
                                                    <?php
                                                    if(!empty($member)){?>
                                                        <p class="form-control-static">  <?=$member['Identitytype']['name']?></p>
                                                    <?}else{
                                                        echo $this->Form->input('Newmember.Member.identitytype_id', array('div'=>false, 'label'=>false,'class'=>'form-control select2 allowClear isselect2' ,"required"=>$required, "id"=>"identitytypeID", 'empty'=>true));
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo $this->Form->label('Newmember.Member.identity', __('身份証明文件號碼'), 'control-label '.$required); ?>
                                                    <div class="input-group">
                                                        <?php
                                                        if(!empty($member)){?>
                                                            <p class="form-control-static">  <?=$member['Member']['identity']?></p>
                                                        <?}else{
                                                            echo $this->Form->input('Newmember.Member.identity', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control vd_identity', 'id'=>"identity", "required"=>$required, 'placeholder'=>__('身份証明文件號碼')));
                                                            ?>
                                                            <span class="input-group-btn" id="HKIDcheckbtndiv">
                                  <a href="javascript:void(0)" data-hkid="identity" class="btn btn-block btn-primary checkhkidbtn">認証</a>
                            </span>
                                                        <?}?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php echo $this->Form->label('Newmember.Member.dob', __('newmember_title_7'), 'control-label '.$required); ?>
                                                    <?php echo $this->Form->input('Newmember.Member.dob', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control bs_datepicker', "required"=>$required, 'placeholder'=>__('YYYY-MM-DD')));?>

                                                </div> <!-- / .form-group -->
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $this->Form->label('Newmember.Member.contact_tel_home', __('電話(住宅)'), 'control-label'); ?>
                                                    <?php echo $this->Form->input('Newmember.Member.contact_tel_home', array('div'=>false, 'label'=>false,'class'=>'form-control'));?>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $this->Form->label('Newmember.Member.contact_tel_mobile', __('電話(手提)'), 'control-label'); ?>
                                                    <?php echo $this->Form->input('Newmember.Member.contact_tel_mobile', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control'));?>

                                                </div> <!-- / .form-group -->
                                            </div>
                                        </div>

                                    </div>

                                    <table id="itemclone" style="display:none">

                                        <tr class="itemdiv">
                                            <td>
                                                <?php echo $this->Form->input("Newmember.Parentmember.__TMP__.identity", array('label'=>false ,'div'=>false, 'class'=>'form-control', 'id'=>'item_identity__TMP__', 'readonly'=>'readonly')); ?>
                                            </td>
                                            <td>
                                                <?php echo $this->Form->input("Newmember.Parentmember.__TMP__.displayname", array('label'=>false ,'div'=>false, 'class'=>'form-control', 'id'=>'item_displayname__TMP__', 'readonly'=>'readonly')); ?>
                                            </td>
                                            <td id='item_membershiplabel__TMP__'></td>
                                            <td>
                                                <div class="form-group m-a-0">
                                                    <?php echo $this->Form->input("Newmember.Parentmember.__TMP__.relationship_id", array('label'=>false ,'div'=>false, 'id'=>'item_relationship_id__TMP__', 'options'=>$memberrelations, 'class'=>'form-control ', 'escape'=>false, 'empty'=>true, 'required'=>'required')); ?>
                                                </div>
                                                <div style="display: none">
                                                    <?php echo $this->Form->input("Newmember.Parentmember.__TMP__.member_child", array('label'=>false ,'div'=>false, 'id'=>'item_member_child__TMP__', 'class'=>'form-control ', 'escape'=>false, 'required'=>'required')); ?>
                                                </div>
                                            </td>
                                            <td> <a href="javascript:void(0)" class="btn btn-danger btn-xs fbdeletebtn"><i class="fa fa-close"></i></a></td>
                                        </tr>

                                    </table>


                                    <div class="panel-heading">
                                        <span class="panel-title"><?php echo __('會員關係'); ?></span>
                                        <div class="panel-heading-controls">
                                            <?=$this->Html->link('<i class="fa fa-plus"></i> 加入新關係', array('controller' => 'members','action' => 'popupsearch', 'ajax' => true), array('class' => 'btn btn-info btn-xs', 'escape' => false, 'data-toggle' => "modal", 'data-target' => '#relation_modal'));?>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="relationshiptable">
                                                    <thead>
                                                    <tr>
                                                        <th><?php echo __('相關身份証明號碼'); ?></th>
                                                        <th><?php echo __('相關會員姓名'); ?></th>
                                                        <th><?php echo __('相關會員會藉'); ?></th>
                                                        <th><?php echo __('關係'); ?><span style="color: red;">*</span></th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?
                                                    foreach($relationship as $index=>$relation){
                                                        ?>
                                                        <tr>
                                                            <td><?php echo h($relation['Relatedmember']['identity']) ?></td>
                                                            <td>
                                                                <?php echo $this->Html->link(h($relation['Relatedmember']['c_name'])." ".h($relation['Relatedmember']['e_name']), array("controller"=>"members", "action"=>"view", $relation['Relatedmember']['id']), array("class"=>"openasnew"))?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                foreach($relation['Relatedmember']['Membership'] as $ms){
                                                                    if(!$ms['expired']){
                                                                        echo ' <span class="label label-success">'.h($ms['Membertype']['name']).' '.h($ms['code']).'</span>';
                                                                    }else{
                                                                        echo ' <span class="label label-danger">'.h($ms['Membertype']['name']).' '.h($ms['code']).'</span>';
                                                                    }

                                                                }
                                                                ?>&nbsp;
                                                            </td>
                                                            <td>
                                                                <div class="form-group m-a-0">
                                                                    <?php
                                                                    echo $this->Form->hidden("Newmember.Parentmember.{$index}.id", array('value'=>$relation['id']));
                                                                    echo $this->Form->input("Newmember.Parentmember.{$index}.relationship_id", array('div'=>false, 'options'=>$memberrelations, 'label'=>false, 'class'=>'form-control ', 'escape'=>false, 'required'=>'required'));
                                                                    ?>&nbsp;
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                        <?
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <? if(!empty($membertype)){?>
                                        <?php echo $this->Form->hidden("Newmember.Membership.valid", array("value"=>1));?>
                                        <?php echo $this->Form->hidden("Newmember.Member.membertype_id", array("value"=>$membertype['Membertype']['id']));?>
                                        <div class="panel-heading">
                                            <span class="panel-title"><?php echo __('會藉資料'); ?></span>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php echo $this->Form->label('Member.membertype', __('會藉'), 'control-label required'); ?>
                                                        <p class="form-control-static">
                                                            <span class="text-success font-size-15"><b><?=$membertype['Membertype']['name']?></b></span>
                                                            <?
                                                            $application_type = "( 新會藉 )";
                                                            echo $application_type;
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php echo $this->Form->label("Newmember.Membership.membercard", __('配對會員卡'), 'control-label'); ?>
                                                        <?php echo $this->Form->input("Newmember.Membership.membercard", array('div'=>false, 'label'=>false, 'class'=>'form-control membercard', "readonly"=>"readonly"));?>

                                                    </div> <!-- / .form-group -->
                                                </div>

                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <?php echo $this->Form->label('Newmember.Membership.remarks', __('備註'), 'control-label'); ?>
                                                        <?php echo $this->Form->input('Newmember.Membership.remarks', array('div'=>false, 'label'=>false, 'class'=>'form-control', "type"=>"textarea"));?>
                                                    </div> <!-- / .form-group -->
                                                </div>
                                            </div>
                                        </div>

                                    <?}?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>



        <div class="panel-heading">
            <span class="panel-title"><?=__('基本資料')?></span>
        </div>
        <?php echo $this->Form->hidden('user_id', array('value'=>$auth['id']));?>
        <div class="panel-body">


            <div class="form-group">
                <?php echo $this->Form->label('year_id', "年度*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('year_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', 'required'=>"required", "empty"=>true));?>
                </div>
            </div> <!-- / .form-group -->

<!--            <div class="form-group">-->
<!--                --><?php //echo $this->Form->label('type', __('類別')."*", 'col-sm-2 control-label'); ?>
<!--                <div class="col-sm-10">-->
<!--                    --><?php //echo $this->Form->input('type', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', "options"=>$casetypes, 'required'=>"required", "empty"=>true));?>
<!--                </div>-->
<!--            </div>-->

            <div class="form-group">
                <?php echo $this->Form->label('applicationdate', __('個案接觸日期')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('applicationdate', array('div'=>false, 'label'=>false, 'class'=>'form-control bs_datepicker', "type"=>"text",'required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

        </div>


        <div class="panel-heading">
            <span class="panel-title"><?=__('個案來源')?></span>
        </div>

        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('case_from', __('來源')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('case_from', array('div'=>false, 'label'=>false, 'class'=>'form-control select2 case_from', "options"=>$casefrom, 'required'=>"required"));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group referral" hidden>
                <?php echo $this->Form->label('referred_date', __('轉介日期')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('referred_date', array('type'=>'text','div'=>false, 'label'=>false, 'class'=>'form-control bs_datepicker is_required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group referral" hidden>
                <?php echo $this->Form->label('referred_org', __('轉介機構')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('referred_org', array('type'=>'text','div'=>false, 'label'=>false, 'class'=>'form-control is_required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group referral" hidden>
                <?php echo $this->Form->label('referred_by_person_title', __('職位'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('referred_by_person_title', array('type'=>'text','div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group referral" hidden>
                <?php echo $this->Form->label('referred_by_person', __('轉介人姓名')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('referred_by_person', array('type'=>'text','div'=>false, 'label'=>false, 'class'=>'form-control is_required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group referral" hidden>
                <?php echo $this->Form->label('referred_by_person_relation', __('與申請人關係')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('referred_by_person_relation', array('type'=>'text','div'=>false, 'label'=>false, 'class'=>'form-control is_required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group referral" hidden>
                <?php echo $this->Form->label('referred_by_person_contact', __('電話')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('referred_by_person_contact', array('type'=>'text','div'=>false, 'label'=>false, 'class'=>'form-control is_required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group referral" hidden>
                <?php echo $this->Form->label('referred_by_person_fax', __('傳真'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('referred_by_person_fax', array('type'=>'text','div'=>false, 'label'=>false, 'class'=>'form-control'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group referral" hidden>
                <?php echo $this->Form->label('referral_reason', __('轉介原因')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('referral_reason', array('type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'form-control is_required'));?>
                </div>
            </div> <!-- / .form-group -->


        </div>

        <div class="panel-heading">
            <span class="panel-title"><?=__('諮詢內容')?></span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('Caseenquiryform.enquiry', __('求助者/家人表達之問題及要求之協助')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Caseenquiryform.enquiry', array('type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'form-control ', 'required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->
        </div>

        <div class="panel-heading">
            <span class="panel-title"><?=__('評估結果')?></span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('status', __('評估結果')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('status', array('div'=>false, 'label'=>false, 'class'=>'form-control select2','options'=>$case_enquiry_assessment, 'required'=>'required', 'id'=>'case_status'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group followup" hidden>
                <?php echo $this->Form->label('Caseenquiryform.followup', __('建議跟進項目')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Caseenquiryform.followup', array('type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'form-control is_required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group closecase notopencasereason_id" hidden>
                <?php echo $this->Form->label('notopencasereason_id', __('原因')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('notopencasereason_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2 is_required', 'options'=>$notopencasereasons, 'id'=>'notopencasereason_id'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group closecase followup_agency" hidden>
                <?php echo $this->Form->label('followup_agency', __('請註明')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('followup_agency', array('div'=>false, 'label'=>false, 'class'=>'form-control is_required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group closecase reason_other" hidden>
                <?php echo $this->Form->label('notopencasereason_other', __('其他原因')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('notopencasereason_other', array('type'=>'textarea', 'div'=>false, 'label'=>false, 'class'=>'form-control is_required'));?>
                </div>
            </div> <!-- / .form-group -->


        </div>

        <div class="panel-heading casereferral title" hidden>
            <span class="panel-title"><?=__('轉介')?></span>
        </div>
        <div class="panel-body casereferral casereferral_id" hidden>
            <div class="form-group">
                <?php echo $this->Form->label('Casereferralform.casereferral_id', __('轉介到')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Casereferralform.casereferral_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2','options'=>$casereferrals, 'id'=>'casereferral_id'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group casereferral casereferral_other_agency" hidden>
                <?php echo $this->Form->label('Casereferralform.other_agency', __('其他政府部門/福利機構（請註明)')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Casereferralform.other_agency', array('type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'form-control is_required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group casereferral casereferral_other" hidden>
                <?php echo $this->Form->label('Casereferralform.other_specify', __('其他（請註明）')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Casereferralform.other_specify', array('type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'form-control is_required'));?>
                </div>
            </div> <!-- / .form-group -->

        </div>


        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('填寫個案服務評估表');?></button>
            <button type="submit" class="btn btn-danger" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('提交並稍後再繼續');?></button>
        </div>
        <?php echo $this->Form->end(); ?>

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="relation_modal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->


<script>

    function checkidentitytypeID(){
        var identitytypeID = $("#identitytypeID").val();
        if(identitytypeID == 1){
            $("#HKIDcheckbtndiv").show();
        }else{
            $("#HKIDcheckbtndiv").hide();
        }
    }

    function uniqId() {
        return Math.round(new Date().getTime() + (Math.random() * 100));
    }


    $(document).ready(function () {
        var itemclone = $("#itemclone").html();

        checkidentitytypeID();

        var member_id = null;

        $.validator.addClassRules("vd_identity", {
            remote: {
                url:"<?=$this->Html->url(array('controller'=>'members','action'=>'ajax_checkunique'));?>",
                type:"post",
                data:{
                    field: 'identity',
                    value: function() {
                        if($("#identity").val() != ""){
                            return $("#identity").val();
                        }else{
                            return "";
                        }

                    }
                }
            }
        });

        $("#identitytypeID").change(function(){
            checkidentitytypeID();
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

        $("#relation_modal").on("click", ".selectmember", function(){
            <?php
            if(!empty($member)){?>
            if($(this).data("mid") == <?=$member['Member']["id"]?>){
                alert("不能選擇自己");
                return;
            }
            <?}?>
            var itemcount = uniqId();
            var thishtmclone = itemclone.replace(/__TMP__/g, itemcount);
            $("#relationshiptable").append(thishtmclone);

            $('#item_identity'+itemcount).val($(this).data("identity"));
            $('#item_displayname'+itemcount).val($(this).data("displayname"));
            $('#item_member_child'+itemcount).val($(this).data("mid"));
            $("#item_membershiplabel"+itemcount).html($(this).closest('tr').find(".membershiplabel").html());

            $("#relation_modal").modal("hide");
        });


        var table = $('#jq-datatables').dataTable({
            dom: '<"top"<"toolbar">f<"clear">>rt<"bottom"lip<"clear">>',
            columnDefs: [
                {
                    className: 'control',
                    orderable: false,
                    targets:   [0,1,2,3,4,5]
                }
            ],
            order: [ 1, 'asc' ],
            language: {
                "sProcessing":   "<?=__('sProcessing')?>",
                "sLengthMenu":   "<?=__('sLengthMenu')?>",
                "sZeroRecords":  "<?=__('sZeroRecords')?>",
                "sInfo":         "<?=__('sInfo')?>",
                "sSearch":         "<?=__('sSearch')?>",
                "sInfoEmpty":    "<?=__('sInfoEmpty')?>",
                "sInfoFiltered": "<?=__('sInfoFiltered')?>",
                "oPaginate": {
                    "sFirst":    "<?=__('sFirst')?>",
                    "sPrevious": "<?=__('sPrevious')?>",
                    "sNext":     "<?=__('sNext')?>",
                    "sLast":     "<?=__('sLast')?>"
                }
            },
            "bProcessing": true,
            "searching":false,
            "bServerSide": true,
            "sAjaxSource": "<?=$this->Html->url(array("action"=>"ajax_list"))?>",
            fnServerParams: function ( aoData ) {
                aoData.push(
                    { "name": "member_id", "value": member_id } ,
                    { "name": "sort_member", "value": 1 } ,
                );
            },

            "aoColumns": [
                {mData:"year"},
                {mData:"code"},
                {mData:"casetype"},
                {mData:"casenature"},
                {mData:"applicationdate"},
                {mData:"nextreviewdate"},
                {mData:"action"}
            ],
        });

        $("#modal").on("click", ".selectmember", function(){
            $("#paidname").val($(this).data("displayname"));
            $("#paidmembership").html($(this).closest('tr').find(".membershiplabel").html());
            $("#membership_input").val($(this).data("msid"));
            $("#member_input").val($(this).data("mid"));
            member_id = $(this).data("mid");
            $("#modal").modal("hide");
        });

        $('.membercard').scannerdevice();

        $('.case_from').on('select2:selecting', function (e) {
            var data = e.params.args.data.id;
            console.log("select: "+data);
            if(data >= 3){
                $('.referral').show();
                $('.referral .is_required').attr('required','required');
            }else{
                $('.referral').hide();
                $('.referral .is_required').removeAttr('required');
            }
        });

        $('#existing_member').on('show.bs.collapse', function () {
            $('#is_existing_member').val(1);
        });

        $('#new_member').on('show.bs.collapse', function () {
            $('#is_existing_member').val(0);
        });


        $('#case_status').val(null).trigger('change');

        $('#case_status').on('select2:selecting', function (e) {
            var data = e.params.args.data.id;
            console.log("select: "+data);

            if(data == 1){
                $('.followup').show();
                $('.followup .is_required').attr('required','required');

            }else{
                $('.followup').hide();
                $('.followup').find('textarea').val(null).trigger('change');
                $('.followup .is_required').removeAttr('required');
            }

            if(data == -1){
                $('.closecase.notopencasereason_id').show();
                $('#notopencasereason_id').val(null).trigger('change');
                $('.closecase.notopencasereason_id .is_required').attr('required','required');
            }else{
                $('.closecase').hide();
                $('#notopencasereason_id').val(null).trigger('change');
                $('.closecase').find('input').val(null).trigger('change');
                $('.closecase').find('textarea').val(null).trigger('change');
                $('.closecase .is_required').removeAttr('required');
            }

            if(data == 5){
                $('.casereferral.title').show();
                $('.casereferral.casereferral_id').show();
                $('#casereferral_id').val(null).trigger('change');
                $('.casereferral.casereferral_id .is_required').attr('required','required');
            }else{
                $('.casereferral').hide();
                $('#casereferral_id').val(null).trigger('change');
                $('.casereferral').find('input').val(null).trigger('change');
                $('.casereferral').find('textarea').val(null).trigger('change');
                $('.casereferral .is_required').removeAttr('required');
            }

        });

        $('#notopencasereason_id').on('select2:selecting', function (e) {
            var data = e.params.args.data.id;

            // if(data ){
            //     $('.followup_agency').show();
            //     $('.followup_agency .is_required').attr('required','required');
            // }else{
            //     $('.followup_agency').hide();
            //     $('.followup_agency .is_required').removeAttr('required');
            // }

            if(data == 2){
                $('.followup_agency').show();
                $('.followup_agency .is_required').attr('required','required');
            }else{
                $('.followup_agency').hide();
                $('.followup_agency .is_required').removeAttr('required');
            }

            if(data == 5){
                $('.reason_other').show();
                $('.reason_other .is_required').attr('required','required');
            }else{
                $('.reason_other').hide();
                $('.reason_other .is_required').removeAttr('required');
            }

        });

        $('#casereferral_id').on('select2:selecting', function (e) {
            var data = e.params.args.data.id;
            console.log("select: "+data);

            if(data == 1){
                $('.casereferral_other_agency').show();
                $('.casereferral_other_agency .is_required').attr('required','required');
            }else{
                $('.casereferral_other_agency').hide();
                $('.casereferral_other_agency .is_required').removeAttr('required');
            }

            if(data == 6){
                $('.casereferral_other').show();
                $('.casereferral_other .is_required').attr('required','required');
            }else{
                $('.casereferral_other').hide();
                $('.casereferral_other .is_required').removeAttr('required');
            }

        });





    });
</script>