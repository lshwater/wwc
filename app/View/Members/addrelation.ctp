
<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-users page-header-icon"></i>&nbsp;&nbsp;<?=__("新增關係")?>
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
        <?echo $this->Html->link(__("返回"), "javascript:history.go(-1)");?>
    </li>
    <li class="active"><?=__("新增關係")?></li>
</ul>

<?php echo $this->Form->create('Member', array('class'=>'panel validate_form preventDoubleSubmission', 'id'=>"form2submit")); ?>

<div class="row">
    <div class="col-sm-12">

        <div class="panel-heading">
            <span class="panel-title"><?php echo __('新增關系'); ?></span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <?php echo $this->Form->label('member_parent', __('會員1'), 'control-label required'); ?>
                    <p class="form-control-static">
                        <?=h($member['Member']['displayname'])?>
                    </p>
                </div>

                <div class="col-md-4">

                    <div class="form-group">
                        <?php echo $this->Form->label('member_child', __('會員2'), 'control-label required'); ?>
                        <div class="input-group">
                            <?php echo $this->Form->input('member_child_display', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>"member_child_display", 'readOnly'=>"readOnly", 'required'=>"required", 'placeholder'=>__('會員2')));?>
                            <span class="input-group-btn">
                                <?=$this->Html->link('<i class="fa fa-search"></i>', array('action' => 'popupsearch', 'ajax' => true), array('class' => 'btn btn-default', 'escape' => false, 'data-toggle' => "modal", 'data-target' => '#modal'));?>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('relationship_id', __('關係'), 'control-label required'); ?>
                        <?php echo $this->Form->input('relationship_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', 'empty'=>true, 'options'=>$memberrelations, 'required'=>"required", 'placeholder'=>__('關係')));?>

                    </div>
                </div>
                <div style="display: none">
                    <?php echo $this->Form->input('member_child', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>"member_child_value"));?>

                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-check"></i><? echo ' '.__('Submit');?></button>
        </div>
    </div>
</div>

<?php echo $this->Form->end(); ?>


<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function() {

        $("#modal").on("click", ".selectmember", function(){

            if($(this).data("mid") == <?=$member['Member']["id"]?>){
                alert("不能選擇自己");
            }else{
                $("#member_child_display").val($(this).data("displayname"));
                $("#member_child_value").val($(this).data("mid"));
                $("#modal").modal("hide");
            }

        });

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });
    });
</script>