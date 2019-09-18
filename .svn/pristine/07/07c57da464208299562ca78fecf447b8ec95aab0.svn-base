<ul class="breadcrumb">
    <li>
        <?=$this->Html->link(__("eventproposals_viewdetail_txt_1").h($eventproposal['Eventproposal']['name']), array("action"=>"view", $eventproposal['Eventproposal']['id']))?>
    </li>
    <li class="active">修改角色</li>
</ul>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-folder-o page-header-icon"></i>&nbsp;&nbsp;<?=__("eventproposals_index_txt_1")?>
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
        <?php echo $this->Form->create('Eventproposal', array('class'=>'form-horizontal panel validate_form')); ?>
        <?php echo $this->Form->hidden('id');?>
        <div class="panel-heading">
            <span class="panel-title">修改角色</span>
        </div>

        <div class="panel-body">
            <?
            if($isadmin){
            ?>
                <div class="form-group">
                    <?php echo $this->Form->label('user_id', __('主要負責職員'), 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('user_id', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', 'required'=>"required"));?>
                    </div>
                </div> <!-- / .form-group -->
            <?
            }
            ?>
            <div class="form-group">
                <?php echo $this->Form->label('Supervisors', __('eventproposals_add_txt_5'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('Supervisors', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', 'required'=>"required"));?>
                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('UserIncharge', __('eventproposals_add_txt_6'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <?php echo $this->Form->input('UserIncharge', array('div'=>false, 'label'=>false, 'class'=>'form-control select2'));?>
                </div>
            </div> <!-- / .form-group -->
        </div>
        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>

    </div>

    <script>
        $(document).ready(function () {

        });
    </script>