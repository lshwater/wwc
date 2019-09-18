
<?php echo $this->Form->create('Volunteer', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>

<?
//Configure::write('debug', 2);
//debug($volunteer);
?>

<div class="modal-header">
    <span class="panel-title"><?=__('義工個人資料')?></span>
    <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
</div>

<div class="modal-body">
    <?php echo $this->Form->input('id'); ?>

    <div class="form-group">
        <?php echo $this->Form->label('Volunteertype', __('身份'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('Volunteertype', array( 'options'=> $volunteer_type, 'div'=>false, 'label'=>false, 'multiple'=>'true', 'class'=>'form-control select2-multiple', 'required'=>'required'));?>
        </div>
    </div> <!-- / .form-group -->

    <div class="form-group">
        <?php echo $this->Form->label('Volunteertag', __('volunteers_add_txt_3'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('Volunteertag', array('div'=>false, 'label'=>false, 'multiple'=>'true', 'class'=>'form-control select2-multiple'));?>
        </div>
    </div> <!-- / .form-group -->

    <div class="form-group">
        <?php echo $this->Form->label('volunteerunit_id', __('機構 （如有）'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('volunteerunit_id', array( 'div'=>false, 'label'=>false, 'class'=>'form-control select2-multiple', "empty"=>__('沒有所屬機構')));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('c_name', __('姓名（中）'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('c_name', array('div'=>false, 'label'=>false,'class'=>'form-control', 'placeholder'=>__('姓名（中）')));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('e_name', __('姓名（英*'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('e_name', array('div'=>false, 'label'=>false, 'required'=>'required', 'class'=>'form-control', 'placeholder'=>__('姓名（英）')));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('identitytype_id', __('身份証明文件'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('identitytype_id', array('div'=>false, 'label'=>false,'class'=>'form-control select2-multiple' ));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-9">
            <?php echo $this->Form->input('identity', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control vd_identity', 'id'=>"identity", 'placeholder'=>__('身份証明文件號碼')));?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $this->Form->label('other_name', __('別名'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('other_name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('別名')));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('gender', __('性別'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('gender', array( 'options'=> array($gender), 'div'=>false, 'label'=>false, 'class'=>'form-control select2-multiple'));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('dob', __('出生日期'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('dob', array('div'=>false, 'type'=> 'text', 'label'=>false, 'required'=>'required', 'class'=>'form-control bs_datepicker', 'placeholder'=>__('yyyy-mm-dd')));?>
        </div>
    </div> <!-- / .form-group -->

    <div class="form-group">
        <?php echo $this->Form->label('phone_main', __('phone_main')."*", 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('phone_main', array('div'=>false, 'type'=>'text', 'label'=>false, 'required'=>'required', 'class'=>'form-control vd_phone', 'placeholder'=>__('phone_main')));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('phone_other', __('phone_other'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('phone_other', array('div'=>false, 'type'=>'text', 'label'=>false, 'class'=>'form-control vd_phone', 'placeholder'=>__('phone_other')));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('address', __('volunteers_add_txt_11'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('address', array('type'=>'textarea','div'=>false, 'label'=>false, 'required'=>'required', 'class'=>'form-control', 'placeholder'=>__('地址')));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('email', __('電子郵箱'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('email', array('div'=>false, 'type'=>'email', 'label'=>false, 'class'=>'form-control vd_email', 'placeholder'=>__('電子郵箱')));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('facebook', __('Facebook'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('facebook', array('div'=>false, 'type'=>'email', 'label'=>false, 'class'=>'form-control vd_email', 'placeholder'=>__('Facebook')));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('employmentstatus_id', __('工作狀態'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('employmentstatus_id', array('options'=>array($employment_status), 'div'=>false, 'label'=>false, 'class'=>'form-control select2-multiple'));?>
        </div>
    </div> <!-- / .form-group -->
    <div class="form-group">
        <?php echo $this->Form->label('education_level', __('學歷'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->input('education_level', array('options'=>array($education_level), 'div'=>false, 'label'=>false, 'class'=>'form-control select2-multiple'));?>
        </div>
    </div> <!-- / .form-group -->

</div>

<div class="modal-header">
    <span class="panel-title"><?=__('義工服務資料')?></span>
</div>
<div class="modal-body">
    <div class="form-group">
        <?php echo $this->Form->label('eventproposaltarget', __('希望服務對象'), 'col-sm-3 control-label'); ?>
        <div class="col-sm-9">
            <?php echo $this->Form->select('Eventproposaltarget', $eventproposaltargets, array('div'=>false, 'label'=>false, 'class'=>'', 'required'=> 'required', 'multiple' => 'checkbox'));?>
        </div>
    </div> <!-- / .form-group -->

</div>

<div class="panel-heading">
    <span class="panel-title"><?=__('可以提供義工服務的時間')?></span>
</div>
<div class="panel-body">
    <div class="form-group">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
            <colgroup>
                <col class="col-xs-2">
                <col class="col-xs-2">
                <col class="col-xs-2">
                <col class="col-xs-2">
                <col class="col-xs-2">
                <col class="col-xs-2">
                <col class="col-xs-2">
            </colgroup>
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
                        ?>
                        <td>
                            <div data-toggle="buttons" class="text-center">
                                    <?
                                    $active = '';
                                    $checked = false;
                                        if(!empty($this->data['Availability'][$index])){
//                                            debug($volunteer['Availability']);
                                            $active = 'active';
                                            $checked = true;
                                        }
                                    ?>
                                    <? echo "<label class='btn btn-primary btn-outline btn-flat ".$active."'>" ?>
<!--                                    --><?php //echo $this->Form->input("Availability.{$index}.value", array('type'=>'checkbox', 'div'=>false, 'label'=>false, 'hidden'=> true, 'hiddenField' => false));?>
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

<div class="modal-footer">
    <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
</div>
<?php echo $this->Form->end(); ?>


<script>

    $(document).ready(function() {
        validate_form();

        $(".select2-multiple").select2({
        });
    });
</script>