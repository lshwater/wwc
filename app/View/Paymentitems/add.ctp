<div class="page-header">
    <h1 class="doc-header"><?php echo __('新增收款項目'); ?></h1>
</div>


<ul class="breadcrumb">
    <li>
        <?=$this->Html->link(__("收款項目清單"), array("action"=>"index"))?>
    </li>
    <li class="active"><?=__("新增收款項目")?></li>
</ul>
<div class="row">
    <?php echo $this->Form->create('Paymentitem', array('class'=>'panel form-horizontal validate_form preventDoubleSubmission')); ?>

    <div class="panel-body">
        <div class="form-group">
            <?php echo $this->Form->label('paymentitemcategory_id', "類別", 'col-sm-2 control-label required'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('paymentitemcategory_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', 'placeholder'=>'類別', 'required'=>"required", "empty"=>true));?>
            </div>
        </div> <!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label("code", __('code'), 'col-sm-2 control-label required'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('code', array('label'=>false,'div'=>false, 'class'=>'form-control' , 'required'=>"required")); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $this->Form->label("name", __('name'), 'col-sm-2 control-label required'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('name', array('label'=>false,'div'=>false, 'class'=>'form-control' , 'required'=>"required")); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $this->Form->label("unitprice", __('價格'), 'col-sm-2 control-label required'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('unitprice', array('label'=>false,'div'=>false, 'class'=>'form-control' , 'required'=>"required")); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $this->Form->label("active", __('生效'), 'col-sm-2 control-label required'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('active', array('label'=>false,'div'=>false, 'class'=>'form-control' , 'checked'=>"checked")); ?>
            </div>
        </div>



        <div class="form-group">
            <button type="submit" class="btn btn-success btn-lg btn-block" ><i class="fa fa-check"></i><? echo ' '.__('submit');?></button>
        </div>

    </div>
    <?php echo $this->Form->end(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>