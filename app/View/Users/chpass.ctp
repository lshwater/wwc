<div class="panel">
    <div class="panel-heading">
        <h2>更新密碼</h2>
    </div>

    <div class="panel-body">
        <?php echo $this->Form->create('User', array('form'=>'role')); ?>
        <fieldset>

            <div class="form-group">
                <? echo $this->Form->input('current_password', array('label'=>'現正使用的密碼*', 'type'=>'password', 'requested'=>'requested', 'value'=>'', 'div'=>false, 'class'=>'form-control'));?>
            </div>
            <div class="form-group">
                <? echo $this->Form->input('password', array('label'=>'輸入新密碼*', 'type'=>'password', 'value'=>'', 'div'=>false, 'class'=>'form-control'));?>
            </div>
            <div class="form-group">
                <? echo $this->Form->input('password2', array('label'=>'再次輸入新密碼*', 'type'=>'password', 'value'=>'', 'div'=>false, 'class'=>'form-control'));?>
            </div>
        </fieldset>
        <div>
            <button type="submit" class="btn btn-success btn-lg btn-block" ><i class="icon-ok-sign icon-white"></i> 提交</button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>





