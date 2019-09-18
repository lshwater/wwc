<?php $this->Html->script("barcode/jquery.scannerdetection.compatibility", array("inline"=>false)); ?>
<?php $this->Html->script('barcode/jquery.scannerdetection', array("inline"=>false)); ?>

<?php $this->Html->script('membercard', array("inline"=>false)); ?>
<?
//Configure::write('debug', 2);
//debug($availability);
?>
<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-user-md page-header-icon"></i>&nbsp;&nbsp;<?=__("volunteers_index_txt_1")?>
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
        <?=$this->Html->link(__("volunteers_index_table_title"), array("action"=>"index"))?>
    </li>
    <li class="active"><?=__("volunteers_add_txt_1")?></li>
</ul>

<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Volunteer', array('class'=>'form-horizontal panel validate_form preventDoubleSubmission')); ?>
        <?php echo $this->Form->hidden("code", array("value"=>uniqid()))?>
        <div class="panel-heading">
            <span class="panel-title"><?=__('volunteers_add_txt_2')?></span>
        </div>

        <div class="panel-body">

            <div class="form-group">
                <?php echo $this->Form->label("membercard", __('配對智能証'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input("membercard", array('div'=>false, 'label'=>false, 'class'=>'form-control membercard', "readonly"=>"readonly"));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('Volunteertype', __('身份'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Volunteertype', array( 'options'=> $volunteer_type, 'div'=>false, 'label'=>false, 'multiple'=>'true', 'class'=>'form-control select2-multiple', 'required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('Volunteertag', __('volunteers_add_txt_3'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Volunteertag', array('div'=>false, 'label'=>false, 'multiple'=>'true', 'class'=>'form-control select2-multiple'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('volunteerunit_id', __('機構(如有)'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('volunteerunit_id', array( 'div'=>false, 'label'=>false, 'class'=>'form-control select2-multiple', "empty"=>__('沒有所屬機構')));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('c_name', __('姓名(中)'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('c_name', array('div'=>false, 'label'=>false,'class'=>'form-control', 'placeholder'=>__('姓名（中）')));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('e_name', __('姓名(英)*'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('e_name', array('div'=>false, 'label'=>false, 'required'=>'required', 'class'=>'form-control', 'placeholder'=>__('姓名（英）')));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('identitytype_id', __('身份証明文件'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('identitytype_id', array('div'=>false, 'label'=>false,'class'=>'form-control select2' ));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('identity', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control vd_identity', 'id'=>"identity", 'placeholder'=>__('身份証明文件號碼')));?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('other_name', __('volunteers_add_txt_5'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('other_name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('別名')));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('gender', __('volunteers_add_txt_6'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('gender', array( 'options'=> array($gender), 'div'=>false, 'label'=>false, 'class'=>'form-control select2-multiple'));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('dob', __('volunteers_add_txt_7'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('dob', array('div'=>false, 'type'=> 'text', 'label'=>false, 'required'=>'required', 'class'=>'form-control bs_datepicker', 'placeholder'=>__('yyyy-mm-dd')));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('phone_main', __('phone_main')."*", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('phone_main', array('div'=>false, 'type'=>'text', 'label'=>false, 'required'=>'required', 'class'=>'form-control vd_phone', 'placeholder'=>__('phone_main')));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('phone_other', __('phone_other'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('phone_other', array('div'=>false, 'type'=>'text', 'label'=>false, 'class'=>'form-control vd_phone', 'placeholder'=>__('phone_other')));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('address', __('volunteers_add_txt_11'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('address', array('type'=>'textarea','div'=>false, 'label'=>false,  'required'=>'required', 'class'=>'form-control', 'placeholder'=>__('地址')));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('email', __('volunteers_add_txt_12'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('email', array('div'=>false, 'type'=>'email', 'label'=>false, 'class'=>'form-control vd_email', 'placeholder'=>__('電子郵箱')));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('facebook', __('volunteers_add_txt_13'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('facebook', array('div'=>false, 'type'=>'email', 'label'=>false, 'class'=>'form-control vd_email', 'placeholder'=>__('Facebook')));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('employmentstatus_id', __('volunteers_add_txt_14'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('employmentstatus_id', array('options'=>array($employment_status), 'div'=>false, 'label'=>false, 'class'=>'form-control select2-multiple'));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('education_level', __('volunteers_add_txt_15'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('education_level', array('options'=>array($education_level), 'div'=>false, 'label'=>false, 'class'=>'form-control select2-multiple'));?>
                </div>
            </div> <!-- / .form-group -->

        </div>

        <div class="panel-heading">
            <span class="panel-title"><?=__('volunteers_add_txt_16')?></span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('eventproposaltarget', __('volunteers_add_txt_17'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->select('Eventproposaltarget', $eventproposaltargets, array('div'=>false, 'label'=>false, 'class'=>'', 'required'=> 'required', 'multiple' => 'checkbox'));?>
                </div>
            </div> <!-- / .form-group -->

        </div>

        <div class="panel-heading">
            <span class="panel-title"><?=__('能提供義工服務的時間')?></span>
        </div>
        <div class="panel-body">
            <div class="form-group">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="text-center"><?=__('星期一')?></th>
                        <th class="text-center"><?=__('星期二')?></th>
                        <th class="text-center"><?=__('星期三')?></th>
                        <th class="text-center"><?=__('星期四')?></th>
                        <th class="text-center"><?=__('星期五')?></th>
                        <th class="text-center"><?=__('星期六')?></th>
                        <th class="text-center"><?=__('星期日')?></th>
                    </tr>
                </thead>
                <tbody>

                    <?
                    foreach($availability as $key => $session){
                        ?>
                        <tr>
                        <?
                        foreach($session as $index => $day){
                            $active = '';
                            $checked = false;
                            if(!empty($this->data['Availability'][$index])){
                                $active = 'active';
                                $checked = true;
                            }
                            ?>
                            <td>
                                <div data-toggle="buttons" class="text-center">
                                    <? echo "<label class='btn btn-primary btn-outline btn-flat ".$active."'>" ?>
                                        <?php echo $this->Form->input("Availability.{$index}.value", array('checked'=>$checked, 'type'=>'checkbox', 'div'=>false, 'label'=>false, 'hiddenField' => false));?>
                                        <span class="lbl"><?=__($key)?></span>
                                    </label>
                                </div>
                            </td>
                            <?
                        };
                        ?>
                        </tr>
                    <?
                    };
                    ?>
                </tbody>

            </table>
            </div>
        </div>


        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>

    </div>

    <script>

        window.operateEvents = {
            'click': function (e, value, row, index) {
                alert('You click like icon, row: ' + JSON.stringify(row));
                console.log(value, row, index);
            }
        };


        $(document).ready(function() {
            $('.membercard').scannerdevice();
            validate_form();

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

        });
    </script>