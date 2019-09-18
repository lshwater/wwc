<div class="row">
    <div class="col-xs-3"></div>
    <div class="col-xs-6">
        <h2><?php echo __('重設密碼 － '.$user['User']['username']); ?></h2>
        <div class="users well well-lg">

            <?php echo $this->Form->create('User', array('form'=>'role', 'class'=>'validate_form')); ?>
            <fieldset>

                <div class="form-group">
                    <? echo $this->Form->input('password', array('label'=>'輸入新密碼*', 'type'=>'password', 'value'=>'', 'class'=>'form-control vd_password'));?>
                </div>
                <div class="form-group">
                    <? echo $this->Form->input('password2', array('label'=>'再次輸入新密碼*', 'type'=>'password', 'value'=>'', 'class'=>'form-control vd_password2'));?>
                </div>
            </fieldset>
            <div>
                <button type="submit" class="btn btn-success btn-lg btn-block" ><i class="icon-ok-sign icon-white"></i> <? echo __('submit');?></button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>

    </div></div>