<?//
//Configure::write('debug', 2);
//?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-suitcase page-header-icon"></i>&nbsp;&nbsp;<?=__("選擇個案類別")?>
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
    <div class="col-md-12">
        <? echo $this->Html->link(
            __('非會員'),
            array(
                'controller' => 'Casemanagements',
                'action' => 'addnonmember'
            ),
            array(
                'class' => 'btn btn-primary btn-lg btn-block'
            )
        );
        ?>
    </div>

</div>
<br />
<div class="row">
    <div class="col-md-12">
        <button id="ui-bootbox-prompt" data-toggle="modal" data-target="#familymodal" class="btn btn-primary btn-lg btn-block" disabled><?=__('現有會員');?></button>
    </div>
</div>


<div id="familymodal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><?=__('members_newmembertype_txt_3');?></h4>
            </div>
            <?php echo $this->Form->create('Member', array('class'=>'panel form-horizontal validate_form')); ?>
            <div class="modal-body">
                <div class="form-group">
                    <?php echo $this->Form->label("acc_no", __('新附屬會員數目*'), 'col-sm-3 control-label'); ?>
                    <div class="col-sm-9">
                        <?php echo $this->Form->input("acc_no", array('div'=>false,'label'=>false, 'class'=>'form-control', 'required'=>'required', "min"=>1));?>
                    </div>
                </div>

                <div class="form-group">
                    <?php echo $this->Form->label("mainmember_code", __('主申請人會員號碼 (如有)'), 'col-sm-3 control-label'); ?>
                    <div class="col-sm-9">
                        <?php echo $this->Form->input("mainmember_code", array('div'=>false,'label'=>false, 'class'=>'form-control membercode'));?>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-lg btn-block" ><?=__('確認');?></button>
            </div>
            <?php echo $this->Form->end(); ?>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>

<script>
    init.push(function () {
        formatmask($(".membercode"), '<?=configure::read('Member.code_mask')?>');
    });
</script>