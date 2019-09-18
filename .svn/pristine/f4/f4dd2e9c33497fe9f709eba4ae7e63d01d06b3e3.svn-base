
<?echo $this->Html->css('bootstrap-datetimepicker.min');?>
<?echo $this->Html->script('bootstrap-datetimepicker.min');?>

<ul class="breadcrumb">
    <li>
        <?=$this->Html->link('Model', array("action"=>"index"));?>
    </li>
    <li class="active">Preview</li>
</ul>


<div class="panel-body">

    <div class="row">
        <div class="col-sm-12">


            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                        <?=$type['Customtype']['type_oname']?>
                        <?echo $this->Html->link('<button class="btn btn-sm btn-warning" style="width: 30px;"><i class="fa fa-eye"></i></button>', array('controller'=>'customtypes','action' => 'layout',$type['Customtype']['id']), array('class'=>' ', 'escape'=>false)); ?>
                    </div>

                </div>
                <div class="panel-body">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                All Custom Fields
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?foreach($object as $k=>$field){
                                        if(!$layout[$field['field_id']]){
                                            echo "<a href='".$this->Html->url(array('controller'=>'Customlayouts','action'=>'add',$type['Customtype']['id'], $field['field_id'],'ajax'=>true))."' class='label label-info' data-toggle='modal' data-target='#modal'>".$field['alias']."</a> ";
                                        }
                                    } ?>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                Added Fields
                                <?echo $this->Html->link('<button class="btn btn-sm btn-warning">Add Group</button>', array('controller'=>'customgroups','action' => 'add',$type['Customtype']['id'], 'ajax'=>true), array('class'=>'modalbtn', 'data-toggle'=>'modal', 'data-target'=>'#modal', 'escape'=>false)); ?>

                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?foreach($layout as $k=>$field){
                                        if(empty($field['group_id'])){
                                            echo "<span class='label label-info' >"."<a href='".$this->Html->url(array('controller'=>'Customlayouts', 'action'=>'edit',$field['layout_id'],'ajax'=>true))."' data-toggle='modal' data-target='#modal'>".$field['alias']."</a> ".$this->Form->postLink('<i class="fa fa-remove"></i>', array('controller'=>'Customlayouts', 'action' => 'delete', $field['layout_id']), array('escape'=>false), __('Are you sure you want to delete # %s?', $field['alias']))."</span> ";
                                        }
                                    } ?>

                                    <hr>
                                    <?if(!empty($group)){?>
                                        <?foreach($group as $g){?>
                                            <div class="panel">
                                                <div class="panel-heading">
                                                    <div class="panel-title">
                                                        <?=$g['Customgroup']['display_name']?>
                                                        <?echo $this->Html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-pencil"></i></button>', array('controller'=>'customgroups','action' => 'edit',$g['Customgroup']['id']), array('class'=>' modalbtn','data-toggle'=>'modal','data-target'=>'#modal', 'escape'=>false)); ?>
                                                        <?echo $this->Form->postLink('<button class="btn btn-sm btn-danger" style="width: 30px;"><i class="fa fa-remove"></i></button>', array('controller'=>'customgroups', 'action' => 'delete', $g['Customgroup']['id']), array('escape'=>false), __('Are you sure you want to delete # %s?', $g['Customgroup']['display_name'])); ?>
                                                        <?php echo $this->Html->link('<button class="btn btn-sm btn-warning" style="width: 30px;"><i class="fa fa-arrow-up"></i></button>', array('controller'=>'customgroups','action' => 'moveup', $g['Customgroup']['id']), array('escape'=>false));  ?>
                                                        <?php echo $this->Html->link('<button class="btn btn-sm btn-success" style="width: 30px;"><i class="fa fa-arrow-down"></i></button>', array('controller'=>'customgroups','action' => 'movedown', $g['Customgroup']['id']), array('escape'=>false));  ?>


                                                    </div>
                                                </div>
                                                <div class="panel-body">
                                                    <?foreach($layout as $k=>$field){
                                                        if($field['group_id'] == $g['Customgroup']['id']){
                                                            echo "<span class='label label-info' >"."<a href='".$this->Html->url(array('controller'=>'Customlayouts', 'action'=>'edit',$field['layout_id'],'ajax'=>true))."' data-toggle='modal' data-target='#modal'>".$field['alias']."</a> ".$this->Form->postLink('<i class="fa fa-remove"></i>', array('controller'=>'Customlayouts', 'action' => 'delete', $field['layout_id']), array('escape'=>false), __('Are you sure you want to delete # %s?', $field['alias']))."</span> ";
                                                        }
                                                    } ?>
                                                </div>

                                            </div>


                                        <?}?>


                                    <?}?>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
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

	$(document).ready(function() {
        // Multiselect
        $(".select2-multiple").select2({
        });
        validate_form();

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

<!--        --><?//
//
//        if(!empty($timestamp)){
//            foreach($timestamp as $counter=>$item){
//                $format = "YYYY-MM-DD";
//                if($item['type'] == 'datetime'){
//                    $format = "YYYY-MM-DD HH:mm";
//                }
//                ?>
//                console.log('<?//=$item['id']?>//');
//                $('#<?//=$item['id']?>//').datepicker({
//                    format:"<?//=$format?>//"
//                });
//                <?//
//            }
//        }
//        ?>

        $('.timepicker').timepicker({
            template: 'dropdown',
            minuteStep: 1,
            showSeconds: false,
            showMeridian: false,
            // explicitMode: true
        });

        $('.bs_datetimepicker').daterangepicker({
            timePicker: true,
            locale: {
                format: 'YYYY-MM-DD HH:mm'
            },
            singleDatePicker: true,
            showDropdowns: true,
            drops: "down",
        });

        $(".bs_daterangepicker").daterangepicker(
            {
                autoUpdateInput: false,
                ranges: {
                    '<?=__('today')?>': [moment(), moment()],
                    '<?=__('yesterday')?>': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    '<?=__('last_7')?>': [moment().subtract('days', 6), moment()],
                    '<?=__('last_30')?>': [moment().subtract('days', 29), moment()],
                    '<?=__('this_month')?>': [moment().startOf('month'), moment().endOf('month')],
                    '<?=__('prev_month')?>': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                // dateLimit: { months: 2 },
                separator: " - ",
                locale: {
                    applyLabel: '<?=__('submit')?>',
                    cancelLabel: '<?=__('cancel')?>',
                    fromLabel: '<?=__('from')?>',
                    toLabel: '<?=__('to')?>',
                    format: 'YYYY-MM-DD',
                    customRangeLabel: '<?=__('custom')?>'
                }
            }
        );

        $('.bs_daterangepicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('.bs_daterangepicker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');

        });



	});

</script>
