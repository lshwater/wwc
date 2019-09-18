<div class="page-header">
    <h1 class="doc-header"><?php  echo __('edit').__('user'); ?></h1>
</div>


<ul class="breadcrumb">
    <li>
        <?=$this->Html->link(__("職員清單"), array("action"=>"index"))?>
    </li>
    <li>
        <?=$this->Html->link(__("檢視職員資料"), array("action"=>"view", $this->data['User']['id']))?>
    </li>
    <li class="active"><?php echo __('edit').__('user'); ?></li>
</ul>

<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('User', array('class'=>'panel form-horizontal validate_form preventDoubleSubmission')); ?>
        <? echo $this->Form->input('id');?>
        <div class="panel-heading">
            <span class="panel-title"><?php echo __('edit').__('user'); ?></span>
        </div>
        <div class="panel-body">

            <div class="form-group">
                <?php echo $this->Form->label("code", __('user').__('code'), 'col-sm-2 control-label required'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('code', array('label'=>false,'div'=>false, 'class'=>'form-control', 'required'=>"required")); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('unit_id', "單位", 'col-sm-2 control-label required'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('unit_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', 'required'=>"required", 'placeholder'=>'Select a Unit'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('Group', "系統權限", 'col-sm-2 control-label required'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Group', array('div'=>false, 'label'=>false, 'multiple'=>false, 'class'=>'form-control select2','placeholder'=>'職級','required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('ranking', "職級", 'col-sm-2 control-label required'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('ranking', array('div'=>false, 'label'=>false, 'class'=>'form-control','placeholder'=>'職級','required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('Viewunit', "管理單位", 'col-sm-2 control-label required'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Viewunit', array('div'=>false, 'label'=>false, 'multiple'=>true, 'class'=>'form-control select2','placeholder'=>'管理單位', "options"=>$units,'required'=>'required'));?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label("username", __('username'), 'col-sm-2 control-label required'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('username', array('label'=>false,'div'=>false, 'class'=>'form-control', 'required'=>'required')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("name", __('user').__('name'), 'col-sm-2 control-label required'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', array('label'=>false,'div'=>false, 'class'=>'form-control', 'required'=>'required')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("phone", __('phone'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('phone', array('label'=>false,'div'=>false, 'class'=>'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("email", __('email'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('email', array('label'=>false,'div'=>false, 'class'=>'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("remark", __('remark'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('remark', array('label'=>false,'div'=>false, 'class'=>'form-control')); ?>
                </div>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('submit');?></button>
            </div>

        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>