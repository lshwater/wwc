<?php $this->Html->script("datatable/dataTables.buttons.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/jszip.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/buttons.html5.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/buttons.flash.min", array("inline"=>false)); ?>
<?php $this->Html->css('datatable/buttons.dataTables.min', array("inline"=>false));?>
<?
$volunteertypename = h($volunteertype['Volunteertype']['name']);
?>
<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-magnet page-header-icon"></i>&nbsp;&nbsp;<?=$volunteertypename.__("配對")?>
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
        <?php echo $this->Form->create('Volunteer', array('class'=>'form', "id"=>"advserachform", "action"=>"ajax_matching")); ?>
        <?php echo $this->Form->hidden('Volunteertype', array('value'=>$volunteertype['Volunteertype']['id']));?>

        <div class="form-group">
            <?php echo $this->Form->label('volunteerunit',__('所屬機構'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="input">
                    <?php echo $this->Form->input("volunteerunit", array('div'=>false, 'label'=>false, 'class'=>'input-sm form-control select2-multiple', 'empty'=> __('沒有指定機構'), 'options'=>$volunteerunits));?>
                </div>
            </div>
        </div> <!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('eventproposaltarget',__('服務對象'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="input">
                    <?php echo $this->Form->input("eventproposaltarget", array('div'=>false, 'label'=>false, 'class'=>'input-sm form-control select2-multiple', 'multiple'=>'true', 'options'=>$eventproposaltargets));?>
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
            <?php echo $this->Form->label('',__('服務的時間'), 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
                    <colgroup>
                        <col class="col-xs-1">
                        <col class="col-xs-1">
                        <col class="col-xs-1">
                        <col class="col-xs-1">
                        <col class="col-xs-1">
                        <col class="col-xs-1">
                        <col class="col-xs-1">
                    </colgroup>
                    <thead>
                    <tr>
                        <th class="text-center"><?=__('星期一')?></th>
                        <th class="text-center"><?=__('星期二')?></th>
                        <th class="text-center"><?=__('星期三')?></th>
                        <th class="text-center"><?=__('星期四')?></th>
                        <th class="text-center"><?=__('星期五')?></th>
                        <th class="text-center"><?=__('星期六')?></th>
                        <th class="text-center"><?=__('星期日')?></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?
                    foreach($availability as $key => $session){
                        ?>
                        <tr>
                            <?
                            foreach($session as $index => $day){
                                ?>
                                <td>
                                    <div data-toggle="buttons" class="text-center">
                                        <label class="btn btn-primary btn-outline btn-flat">
                                            <?php echo $this->Form->input("Volunteer.availability.{$index}.value", array('type'=>'checkbox', 'div'=>false, 'label'=>false, 'hidden'=> true, 'hiddenField' => false, 'class'=>'input-sm availability'));?>
                                            <span class="lbl"><?=__($key)?></span>
                                        </label>
                                    </div>
                                </td>
                            <?
                            };
                            ?>
                        </tr>
                    <?
                    };
                    ?>
                    </tbody>

                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
<!--                    <button type="submit" class="btn btn-success btn-block" data-loading-text="Loading..." ><i class="fa fa-search"></i>搜尋</button>-->
                <button type="button" class="btn btn-success btn-block" onclick="advvolunteersearch();" data-loading-text="Loading..." id="volunteersearchbtn"><i class="fa fa-search"></i>&nbsp;<?=__('搜尋')?></button>
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
                        <th><?=__('編號')?></th>
                        <th><?=__('姓名')?></th>
                        <th><?=__('電話(主要)')?></th>
                        <th><?=__('電話(其他)')?></th>
                        <th><?=__('電郵')?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="advserachresult">

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

    function advvolunteersearch(){
        $("#volunteersearchbtn").button("loading");
        resulttable.clear().draw();

        $.ajax({
            type: "POST",
            url: "<?=$this->Html->url(array("controller"=>"volunteers", 'action'=>'ajax_matching'))?>",
            data: $("#advserachform").serialize(),
            dataType: "json"
        })
        .done(function( msg ) {
            if(msg.result){
                $.each(msg.result, function( index, value ) {
                    resulttable.row.add( [
                        escapeHtml(value.Volunteer['code']),
                        escapeHtml(value.Volunteer['c_name'])+' '+escapeHtml(value.Volunteer['e_name']),
                        ((typeof value.Volunteer['phone_main'] === 'undefined')?"":escapeHtml(value.Volunteer['phone_main'])),
                        ((typeof value.Volunteer['phone_other'] === 'undefined')?"":escapeHtml(value.Volunteer['phone_other'])),
                        ((typeof value.Volunteer['email'] === 'undefined')?"":escapeHtml(value.Volunteer['email'])),
                        '<a href="<?=$this->Html->url(array("controller"=>"volunteers", 'action'=>'view', "ajax"=>true))?>/'+escapeHtml(value.Volunteer['id'])+'" class="btn btn-primary" data-toggle="modal" data-target="#modal" ><i class="fa fa-info"></i></a>'
                    ]).draw( false );

                });

                $(document).scrollTop( $("#memberresult").offset().top );

            }else{
                $("#memberadvwarning_msg").html(msg.errormsg);
                $("#memberadvwarning").modal('show');
            }
        })
        .always(function(){
            $("#volunteersearchbtn").button("reset");
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

        $('.select2-multiple').select2({
            allowClear: true
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