<?php $this->Html->script("datatable/dataTables.buttons.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/jszip.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/buttons.html5.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/buttons.flash.min", array("inline"=>false)); ?>
<?php $this->Html->css('datatable/buttons.dataTables.min', array("inline"=>false));?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-magnet page-header-icon"></i>&nbsp;&nbsp;<?=__("會員搜尋")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
            </div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-body">
        <?php echo $this->Form->create('Member', array('class'=>'form', "id"=>"advserachform", "action"=>"ajax_matching")); ?>

        <div class="form-group">
            <?php echo $this->Form->label('', __('會員類別'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <?php echo $this->Form->input('membertype', array( 'options'=>$membertypes, 'div'=>false, 'label'=>false, 'multiple'=>'true', 'class'=>'input-sm form-control select2-multiple'));?>
            </div>
        </div> <!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('',__('希望服務對象'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="input">
                    <?php echo $this->Form->input("eventproposaltarget", array('div'=>false, 'label'=>false, 'class'=>' form-control select2-multiple', 'multiple'=>'true', 'options'=>$eventproposaltargets));?>
                </div>
            </div>
        </div> <!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('',__('所在地'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="input">
                    <?php echo $this->Form->input("district", array('div'=>false, 'label'=>false, 'class'=>'input-sm form-control select2-multiple', 'multiple'=>'true', 'options'=>$district));?>
                </div>
            </div>
        </div> <!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('',__('教育程度'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="input">
                    <?php echo $this->Form->input("educationlevel", array('div'=>false, 'label'=>false, 'class'=>'input-sm form-control select2-multiple', 'multiple'=>'true', 'options'=>$education_level));?>
                </div>
            </div>
        </div> <!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('',__('性別'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="input">
                    <?php echo $this->Form->input("gender", array('div'=>false, 'label'=>false, 'class'=>'input-sm form-control select2-multiple', 'multiple'=>'true', 'options'=>$gender));?>
                </div>
            </div>
        </div> <!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('',__('工作狀態'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="input">
                    <?php echo $this->Form->input("employmentstatus", array('div'=>false, 'label'=>false, 'class'=>'input-sm form-control select2-multiple', 'multiple'=>'true', 'options'=>$employment_status));?>
                </div>
            </div>
        </div> <!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('',__('年齡由'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="input-daterange input-group" id="range">
                    <?php echo $this->Form->input('from_age', array('div'=>false, 'label'=>false, 'class'=>'input-sm form-control vd_number', 'placeholder'=>__('歲'), 'type'=>"text"));?>
                    <span class="input-group-addon"><?=__('至')?></span>
                    <?php echo $this->Form->input('to_age', array('div'=>false, 'label'=>false, 'class'=>'input-sm form-control vd_number', 'placeholder'=>__('歲'), 'type'=>"text"));?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo $this->Form->label('',__('閒置時間'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="input-group">
                    <?php echo $this->Form->input("idle_period", array('div'=>false, 'label'=>false, 'class'=>'text-center input-sm  form-control vd_number', 'placeholder'=>__('月'), 'type'=>"text"));?>
                    <span class="input-group-addon"><?=__('個月內沒有參加任何活動')?></span>
                </div>
            </div>
        </div> <!-- / .form-group -->

        <br />
        <div class="row">
            <div class="col-xs-12">
                <button type="button" class="btn btn-success btn-block" onclick="advmembersearch();" data-loading-text="Loading..." id="membersearchbtn"><i class="fa fa-search"></i>&nbsp;<?=__('搜尋')?></button>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
        <!--                            !!!!!form-->
        <!--result-->
        <div class="row" id="memberresult">
            <hr />
            <div class="panel-heading">
                <span class="panel-title"><?php echo __('結果');?>&nbsp;</span>
            </div>
            <div class="panel-body">
                <table class="table" id="resulttable">
                    <thead>
                    <tr>
                        <th><?=__('會員編號')?></th>
                        <th><?=__('姓名')?></th>
                        <th><?=__('電話(主要)')?></th>
                        <th><?=__('電話(其他)')?></th>
                        <th><?=__('電郵')?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="memberadvwarning" class="modal modal-alert modal-warning fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-warning"></i>
            </div>
            <div class="modal-title"><?=__('結果')?></div>
            <div class="modal-body" id="memberadvwarning_msg"><?=__('沒有記錄')?></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><?=__('返回')?></button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    var resulttable;

    function advmembersearch(){
        $("#membersearchbtn").button("loading");

        resulttable.clear().draw();

        $.ajax({
            type: "POST",
            url: "<?=$this->Html->url(array("controller"=>"members", 'action'=>'ajax_matching'))?>",
            data: $("#advserachform").serialize(),
            dataType: "json"
        })
        .done(function( msg ) {
            if(msg.result){
                $.each(msg.result, function( index, value ) {
                    resulttable.row.add( [
                        escapeHtml(value.Member['code']),
                        escapeHtml(value.Member['c_name'])+' '+escapeHtml(value.Member['e_name']),
                        ((typeof value.MemberCustomField['<?=configure::read("Memberinputfield.phone_main_index")?>'] === 'undefined')?"":escapeHtml(value.MemberCustomField['<?=configure::read("Memberinputfield.phone_main_index")?>']['value'])),
                        ((typeof value.MemberCustomField['<?=configure::read("Memberinputfield.phone_other_index")?>'] === 'undefined')?"":escapeHtml(value.MemberCustomField['<?=configure::read("Memberinputfield.phone_other_index")?>']['value'])),
                        ((typeof value.MemberCustomField['<?=configure::read("Memberinputfield.email_index")?>'] === 'undefined')?"":escapeHtml(value.MemberCustomField['<?=configure::read("Memberinputfield.email_index")?>']['value'])),
                        '<a href="<?=$this->Html->url(array("controller"=>"members", 'action'=>'view', "ajax"=>true))?>/'+escapeHtml(value.Member['id'])+'" class="btn btn-primary" data-toggle="modal" data-target="#modal" ><i class="fa fa-info"></i></a>'
                    ]).draw( false );
                });
                $(document).scrollTop( $("#memberresult").offset().top );
            }else{
                $("#memberadvwarning_msg").html(msg.errormsg);
            }
        })
        .always(function(){
            $("#membersearchbtn").button("reset");
        });
    }

    $( document ).ready(function() {
        resulttable = $('#resulttable').DataTable({
            dom: '<"top"Bf<"clear">>rt<"bottom"lip<"clear">>',
            buttons: [
                'copy',
                'excel'
            ],
            language: {
                "sProcessing":   "<?=__('sProcessing')?>",
                "sLengthMenu":   "<?=__('sLengthMenu')?>",
                "sZeroRecords":  "<?=__('sZeroRecords')?>",
                "sInfo":         "<?=__('sInfo')?>",
                "sSearch":         "<?=__('sSearch')?>",
                "sInfoEmpty":    "<?=__('sInfoEmpty')?>",
                "sInfoFiltered": "<?=__('sInfoFiltered')?>",
                "oPaginate": {
                    "sFirst":    "<?=__('sFirst')?>",
                    "sPrevious": "<?=__('sPrevious')?>",
                    "sNext":     "<?=__('sNext')?>",
                    "sLast":     "<?=__('sLast')?>"
                }
            },
            deferRender: true
        });

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('#modal .modalonly').show();
            $('#modal .modaloff').hide();
        });
    });
</script>