<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-folder-o page-header-icon"></i>&nbsp;&nbsp;<?=__("eventproposals_add_txt_1")?>
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
    <?php echo $this->Form->create('Eventproposal', array('class'=>'form-horizontal panel validate_form preventDoubleSubmission')); ?>
    <div class="panel-heading">
        <span class="panel-title"><?=__('eventproposals_add_txt_1')?></span>
    </div>

    <div class="panel-body">
        <div class="form-group">
            <?php echo $this->Form->label('name', __('eventproposals_add_txt_2'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('eventproposals_add_txt_2'), 'required'=>"required"));?>
            </div>
        </div> <!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('year_id', "年度", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('year_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2-nosearch', 'required'=>"required", "empty"=>true));?>
            </div>
        </div> <!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('proposaltype', "計劃類別", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('proposaltype', array('div'=>false, 'label'=>false, 'options'=>array('活動'=>'活動', '小組'=>'小組'), 'class'=>'form-control select2-nosearch', 'required'=>"required", "empty"=>true));?>
            </div>
        </div>

        <?php echo $this->Form->hidden('user_id', array('value'=>$auth['id']));?>

         <div class="form-group">
            <?php echo $this->Form->label('Supervisors', __('eventproposals_add_txt_5'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('Supervisors', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', 'required'=>"required"));?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $this->Form->label('UserIncharge', __('eventproposals_add_txt_6'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('UserIncharge', array('div'=>false, 'label'=>false, 'class'=>'form-control select2'));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('target', __('對象'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('target', array('div'=>false, 'label'=>false, 'id'=>'targetinput', 'placeholder'=>array("對象"), 'class'=>'form-control', 'required'=>"required"));?>
            </div>
        </div> <!-- / .form-group -->
    </div>
    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-primary btn-lg" ><i class="fa fa-check"></i><? echo ' '.__('Submit');?></button>
    </div>
    <?php echo $this->Form->end(); ?>

</div>

<script>
    $(document).ready(function () {
        var $input = $("#targetinput");
        $input.typeahead({
            minLength: 0,
            highlight: true,
            showHintOnFocus: true,
            source: <?=json_encode($targetjson)?>,
        });
    });
</script>