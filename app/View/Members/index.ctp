<?php $this->Html->script("datatable/dataTables.buttons.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/jszip.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/buttons.html5.min", array("inline"=>false)); ?>
<?php $this->Html->script("datatable/buttons.flash.min", array("inline"=>false)); ?>
<?php $this->Html->css('datatable/buttons.dataTables.min', array("inline"=>false));?>


<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-users page-header-icon"></i>&nbsp;&nbsp;<?=__("服務對象")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
                <!-- "Create project" button, width=auto on desktops -->
                <div class="text-right col-xs-12 col-sm-auto">
                    <?php echo $this->Html->link('<span class="icon fa fa-print"></span> '.__('Export Smart Card'), array("action"=>"export", 'ajax'=>true), array('escape'=>false, 'class'=>'btn btn-info btn-labeled', 'data-toggle'=>"modal", 'data-target'=>'#modal')); ?>
                    <?php echo $this->Html->link('<span class="icon fa fa-print"></span> '.__('Export Address Label'), array("action"=>"exportaddrlabel", 'ajax'=>true), array('escape'=>false, 'class'=>'btn btn-info btn-labeled', 'data-toggle'=>"modal", 'data-target'=>'#modal')); ?>
<!--                    --><?php //echo $this->Html->link('<span class="icon fa fa-plus"></span> '.__('新增對象'), array("action"=>"add"), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled')); ?>

                </div>

                <!-- Margin -->
                <div class="visible-xs clearfix form-group-margin"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <?
        $filter_options = array();
        $selected_options = array();

        foreach($model['Dbfield'] as $k=>$field){
            if($field['can_filter']){
                $single_option = array("name"=>(!empty($field['oname']))?$field['oname']:$field['db_field'], "value"=>$k, "alias"=>$field['alias'], 'from'=>'model');

                if($field['default_filter']){
                    $selected_options[] = $k;
                    $single_option['locked'] = "locked";
                }
                $filter_options[$k] = $single_option;
            }
        }?>

        <?
        foreach($struct as $k=>$field){
            if($field['can_filter']){
                $single_option = array("name"=>(!empty($field['label']))?$field['label']:$field['alias'], "value"=>$k,"alias"=>$field['alias']  , 'from'=>'struct');

                if($field['default_filter']){
                    $selected_options[] = $k;
                    $single_option['locked'] = "locked";
                }
                $filter_options[$k] = $single_option;
            }
        }?>


        <?php echo $this->Form->input('field', array(
                'div'=>false, 'label'=>false,'options'=>$filter_options,
                'class'=>'form-control form-group-margin select2 filterauto', 'empty'=>true, 'value'=>$selected_options, 'multiple'=>true,
                'id'=>"filter-field",
                'placeholder'=>"篩選"
            )
        );?>
    </div>

<!--    <div class="col-sm-6">-->
<!--        --><?//
//        $filter_options = array();
//        $selected_options = array();
//
//        foreach($struct as $k=>$field){
//            if($field['can_filter']){
//                $single_option = array("name"=>(!empty($field['label']))?$field['label']:$field['alias'], "value"=>$k,"alias"=>$field['alias']);
//
//                if($field['default_filter']){
//                    $selected_options[] = $k;
//                    $single_option['locked'] = "locked";
//                }
//                $filter_options[$k] = $single_option;
//            }
//        }?>
<!--        --><?php //echo $this->Form->input('field', array(
//                'div'=>false, 'label'=>false,'options'=>$filter_options,
//                'class'=>'form-control form-group-margin select2 filterauto allowClear', 'empty'=>true, 'value'=>$selected_options, 'multiple'=>true,
//                'id'=>"filter-custom-field",
//                'placeholder'=>"更多篩選"
//            )
//        );?>
<!--    </div>-->
</div>


<div class="row m-t-1" id="filter_row">

    <?
    foreach($model['Dbfield'] as $k=>$field){

        if($field['default_filter']){
            ?>
            <div class="col-sm-2">
            <?=(!empty($field['oname']))?$field['oname']:$field['db_field']."<br>";?>

            <?if($field['is_dropdown']){
                $options = array();

                foreach($field['Dbfielddropdown'] as $item){
                    $options[$item['value']] = $item['oname'];
                }

                echo $this->Form->input($field['db_field'], array(
                        'div'=>false, 'label'=>false,'options'=>$options,
                        'class'=>'form-control form-group-margin select2 filterauto allowClear', 'empty'=>true,
                        'id'=>"filter-".$field['db_field'],
                        'placeholder'=>$field['oname']
                    )
                );
            }else{
                $date = "";

                if($field['is_date']){
                    $date = "daterangepicker";
                } echo $this->Form->input($field['db_field'], array(
                        'div'=>false, 'label'=>false,
                        'class'=>'form-control form-group-margin filterauto '.$date, 'empty'=>true,
                        'id'=>"filter-".$field['db_field'],
                        'placeholder'=>$field['oname']
                    )
                ); ?>

            <?}?>
            </div>
        <?}
    }?>

</div>

<div class="row m-t-1">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover" id="jq-datatables">
                <thead>
                <tr>
                    <th><?php echo __('姓名'); ?></th>
                    <th>身份証明號碼</th>
                    <th>性別</th>
                    <th>電話(住宅)</th>
                    <th>電話(手提)</th>
                    <th><?php echo __('會藉'); ?></th>
                    <th class="actions"><?=__('Actions')?></th>
                </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function () {

        var model = <?=json_encode($model);?>;
        var struct = <?=json_encode($struct);?>;
        console.log(model);
        model = model['Dbfield'];

        var table = $('#jq-datatables').dataTable({
            dom: '<"top"<"toolbar">B<"clear">>rt<"bottom"lip<"clear">>',
            buttons: [
                {
                    extend: 'excel',
                    // exportOptions: {
                    //     columns: [ 0, 1, 2, 3, 4, 5 ]
                    // }
                },
            ],
            columnDefs: [
                {
                    className: 'control',
                    orderable: false,
                    targets:   0
                }
            ],
            order: [ 1, 'asc' ],
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
            "bProcessing": true,
            "searching":true,
            "bServerSide": true,
            "sAjaxSource": "<?=$this->Html->url(array("action"=>"ajax_list"))?>",
            fnServerParams: function ( aoData ) {
                aoData.push(
                    { "name": "status", "value": $("#filter-status").val() } ,
                );
                <?foreach($model['Dbfield'] as $field){?>
                aoData.push(
                    {"name": "<?=$field['db_field']?>", "value": $("#filter-<?=$field['db_field']?>").val()},
                );
                <?}?>
                <?foreach($struct as $field){?>
                aoData.push(
                    {"name": "<?=$field['alias']?>", "value": $("#filter-<?=$field['alias']?>").val()},
                );
                <?}?>

            },

            "aoColumns": [
                {mData:"displayname"},
                {mData:"identity"},
                {mData:"gender"},
                {mData:"contact_tel_home"},
                {mData:"contact_tel_mobile"},
                {mData:"membership"},
                {mData:"action"}
            ],
        });

        <?foreach($model['Dbfield'] as $field){
            if($field['default_filter']){
        ?>

        $("#filter-<?=$field['db_field']?>").on("change", function () {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        <?
            }
        }?>



        $('#jq-datatables_wrapper .table-caption').text('<?=__('members_index_table_title')?>');
        $('#jq-datatables_wrapper .dataTables_filter input').attr('placeholder', '<?=__('members_index_table_placeholder')?>');



        $("#filter-type").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $("#filter-status").on("change", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

        var filter = $("#filter-field");

        filter.on("select2:selecting", function(event) {

            var last = event.params.args.data.id;

            var from = $(this).children('[value="'+last+'"]').attr('from');

            if(from == "model"){
                if(model[last]['is_dropdown']){

                    var new_filter = '<div class="col-sm-2">' +
                        model[last]['oname']+'<br>'+
                        '<select name="data['+model[last]['db_field']+']" class="form-control form-group-margin filterauto select2" id="filter-'+model[last]['db_field']+'" placeholder="'+model[last]['oname']+'" tabindex="-1" title="" >';

                    // new_filter += '<option value=""></option>';
                    $.each(model[last]['Dbfielddropdown'],function( index, value ) {
                        new_filter += '<option value="'+value['value']+'">'+value['oname']+'</option>';
                    });

                    new_filter += '</select>';


                }else{
                    var new_filter = '<div class="col-sm-2">' +
                        model[last]['oname']+'<br>'+
                        '<input name="data['+model[last]['db_field']+']" class="form-control form-group-margin filterauto " id="filter-'+model[last]['db_field']+'" placeholder="'+model[last]['oname']+'" type="text" autocomplete="off">' +
                        '</div>';
                }



                $('#filter_row').append(new_filter);

                if(model[last]['is_dropdown']){
                    $("#filter-"+model[last]['db_field']).select2({
                        allowClear:true,
                        placeholder :'請選擇'
                    });

                    $("#filter-"+model[last]['db_field']).val(null).trigger('change');
                }



                $("#filter-"+model[last]['db_field']).on("change", function() {

                    table.fnDraw();
                });


            }else if(from == "struct"){


                if(struct[last]['type'] == 'select'){

                    var new_filter = '<div class="col-sm-2">' +
                        struct[last]['label']+'<br>'+
                        '<select name="data[Customfield]['+struct[last]['alias']+']" class="form-control form-group-margin filterauto select2" id="filter-'+struct[last]['alias']+'" placeholder="'+struct[last]['label']+'" tabindex="-1" title="" >';

                    $.each(struct[last]['options'],function( index, value ) {
                        new_filter += '<option value="'+index+'">'+value+'</option>';
                    });

                    new_filter += '</select>';

                }else{
                    var new_filter = '<div class="col-sm-2">' +
                        struct[last]['label']+'<br>'+
                        '<input name="data[Customfield]['+struct[last]['alias']+']" class="form-control form-group-margin filterauto " id="filter-'+struct[last]['alias']+'" placeholder="'+struct[last]['label']+'" type="text" autocomplete="off">' +
                        '</div>';
                }


                $('#filter_row').append(new_filter);

                if(struct[last]['type'] == 'select'){
                    $("#filter-"+struct[last]['alias']).select2({
                        allowClear:true,
                        placeholder :'請選擇'
                    });
                    $("#filter-"+struct[last]['alias']).val(null).trigger('change');
                }



                $("#filter-"+struct[last]['alias']).on("change", function() {
                    table.fnDraw();
                });


            }



        });

        filter.on("select2:unselecting", function(event) {

            var last = event.params.args.data.id;

            var from = $(this).children('[value="'+last+'"]').attr('from');

            if(from =="model"){

                $('#filter-'+model[last]['db_field']).closest("div").remove();
                table.fnDraw();

            }else if(from == "struct"){

                $('#filter-'+struct[last]['alias']).closest("div").remove();
                table.fnDraw();

            }


        });


    });
</script>