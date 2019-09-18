<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-university page-header-icon"></i>&nbsp;&nbsp;<?=__("units_index_txt_1")?>
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
        <?php echo $this->Form->create('Unit', array('class'=>'panel form-horizontal validate_form')); ?>

        <div class="panel-heading">
            <span class="panel-title"><?=__("units_add_txt_1")?></span>
        </div>

        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('name', __('Name'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false,'class'=>'form-control unique_code', 'placeholder'=>__('Name'), 'id'=>'name')); ?>
                    </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label("tel", __('phone'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('tel', array('label'=>false,'div'=>false, 'class'=>'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("fax", __('Fax'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('fax', array('label'=>false,'div'=>false, 'class'=>'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("address", __('Address'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('address', array('label'=>false,'div'=>false, 'class'=>'form-control')); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('agency_id', __('units_add_txt_3'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('agency_id', array('div'=>false, 'label'=>false, 'class'=>'select2-multiple form-control select2-offscreen', 'placeholder'=>__('units_add_txt_3')));?>
                </div>
            </div> <!-- / .form-group -->  

            <div class="form-group">
                <?php echo $this->Form->label('remark', __('units_add_txt_4'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('remark', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('units_add_txt_4')));?>
                </div>
            </div> <!-- / .form-group -->


        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="fa fa-check"></i><? echo ' '.__('Submit');?></button>
            <?php echo $this->Html->link('<span class="btn-primary"></span>'.__('Cancel'), array('action' => 'index'), array('escape'=>false, 'class'=>'btn btn-warning btn-labeled')); ?>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.validator.addClassRules("unique_code", {
            remote: {
                url:"<?=$this->Html->url(array('action'=>'ajax_checkunique'));?>",
                type:"post",
                data:{
                    field: 'name',
                    value: function() {
                        return $("#name").val();
                    }
                }
            }
        });
    });
</script>