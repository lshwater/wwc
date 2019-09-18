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
        <?=$this->Html->link(__("選擇個案類別"), array("action"=>"addtype"))?>
    </li>
    <li class="active"><?=__("新增非會員個案")?></li>
</ul>

<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Casemanagement', array('class'=>'form-horizontal panel validate_form preventDoubleSubmission')); ?>
        <div class="panel-heading">
            <span class="panel-title"><?=__('個案基本資料')?></span>
        </div>
        <?php echo $this->Form->hidden('user_id', array('value'=>$auth['id']));?>
        <div class="panel-body">


            <div class="form-group">
                <?php echo $this->Form->label('year_id', "年度*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('year_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', 'required'=>"required", "empty"=>true));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('type', __('類別')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('type', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', "options"=>$type, 'required'=>"required", "empty"=>true));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('applicationdate', __('個案申請日期')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('applicationdate', array('div'=>false, 'label'=>false, 'class'=>'form-control bs_datepicker', "type"=>"text"));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('referred_by', __('轉介機構')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('referred_by', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', "options"=>$referred_by_choices, 'required'=>"required", "empty"=>true));?>
                </div>
            </div> <!-- / .form-group -->

        </div>
        <div class="panel-heading">
            <span class="panel-title"><?=__('主申請人資料')?></span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('client_name_cn', __('中文姓名'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('client_name_en', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('主申請人')));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('client_name_en', __('英文姓名')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('client_name_en', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('主申請人'), 'required'=>"required"));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('client_identitytype_id', __('身份証明文件')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('client_identitytype_id', array('div'=>false, 'label'=>false,'class'=>'form-control select2 isselect2' ,"required"=>"required", "id"=>"identitytypeID", "options"=>$identitytypes));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('client_identity', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control vd_identity', 'id'=>"identity", "required"=>"required", 'placeholder'=>__('身份証明文件號碼')));?>
                </div>
            </div>
            <div class="form-group" id="HKIDcheckbtndiv">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <a href="javascript:void(0)" data-hkid="identity" class="btn btn-block btn-primary checkhkidbtn">香港身份証認証</a>
                </div>
            </div>

        </div>
        <div class="panel-heading">
            <span class="panel-title"><?=__('批核結果')?></span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('application_success', __('批核成功'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('application_success', array('div'=>false, 'label'=>false, 'class'=>'form-control', "type"=>"checkbox"));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('dateofapproval', __('個案批刻日期'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('dateofapproval', array('div'=>false, 'label'=>false, 'class'=>'form-control bs_datepicker', "type"=>"text", "required"=>""));?>
                </div>
            </div> <!-- / .form-group -->
        </div>
        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>

    </div>
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
        $(document).ready(function () {
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
        });
    </script>