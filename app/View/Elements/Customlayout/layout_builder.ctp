<? if(!empty($layout['nogroup'])){?>
<div class="panel-body">
    <?

    $timestamp = array();
    $timestamp_counter = 0;
    foreach($layout['nogroup'] as $k=>$field){

        if(!$field['hidden']){

            $required = "";
            ($field['required'])?$required="required":$required="";

            ($field['required'])?$star=" *":$star="";

            ?>

            <div class="<?=$field['div_class']?>">
                <div class="row">
                    <div class="col-sm-1" style="padding-left: 0px;padding-right: 0px; padding-top:25px;">
                        <?php echo $this->Html->link('<button class="btn btn-sm btn-warning"><i class="fa fa-caret-left"></i></button>', array('controller'=>'customlayouts','action' => 'moveup', $field['layout_id']), array('escape'=>false));  ?>
                    </div>
                    <div class="col-sm-8" style="padding-right: 5px;">
                        <div class="form-group">
                            <?php echo $this->Form->label("Customtype.$k.".$field['name'], $field['label'] .$star, 'control-label'); ?>
                            <?php echo $this->Form->hidden("Customtype.$k.field_id", array('value'=>$field['field_id']))?>
                            <?php echo $this->Form->hidden("Customtype.$k.model_id", array('value'=>$field['model_id']))?>
                            <?php echo $this->Form->hidden("Customtype.$k.type_id", array('value'=>$field['type_id']))?>
                            <?php

                            $field['name'] = "Customtype.$k.value";
                            $options = array(
                                'div'=>false,
                                'label'=>false,
                                'class'=>'form-control',
                                'placeholder'=>$field['placeholder'],
                                'required'=>$required,
                                'default'=>$field['default']
                            );

                            if(!empty($field['attribute'])){
                                foreach ($field['attribute'] as $name=>$val){
                                    $options[$name]=$val;
                                }
                            }

                            switch ($field['type']){
                                case 'text':
                                    $options['type'] = "text";
                                    echo $this->Form->input($field['name'], $options);
                                    break;
                                case 'int':
                                case 'float':
                                    $options['type'] = "number";
                                    echo $this->Form->input($field['name'], $options);
                                    break;
                                case 'textarea':
                                    $options['type'] =  "textarea";
                                    echo $this->Form->input($field['name'], $options);
                                    break;
                                case 'select':
                                    $options['class'] .=  " select2";
                                    $options['type'] =  "select";
                                    if(!$required){
                                        $options['class'] .=  " allowClear";
                                    }

                                    if($field['multiple']){
                                        $options['multiple'] = 'true';

                                    }
                                    $options['options'] = $field['options'];
                                    echo $this->Form->input($field['name'], $options);
                                    break;
                                case 'bool':
                                    $options['type'] =  "checkbox";
//                                            $options['options'] = array(
//                                                1=>'是',
//                                                0=>'否',
//                                            );
                                    echo $this->Form->hidden($field['name'], array('value'=>0));
                                    echo $this->Form->input($field['name'], $options);
                                    break;
                                case 'date':
                                    $options['type'] =  "text";
                                    $options['id'] = "timestamp_".$k;
                                    $options['class'] .= " bs_datepicker";
                                    $timestamp[$timestamp_counter]['id'] = "timestamp_".$k;
                                    $timestamp[$timestamp_counter]['attribute'] = $field['attribute'];
                                    $timestamp[$timestamp_counter]['type'] = $field['type'];
                                    $timestamp_counter ++;
                                    echo $this->Form->input($field['name'], $options);
                                    break;
                                case 'time':
                                    $options['type'] =  "text";
                                    $options['id'] = "timestamp_".$k;
                                    $options['class'] .= " timepicker";
                                    $timestamp[$timestamp_counter]['id'] = "timestamp_".$k;
                                    $timestamp[$timestamp_counter]['attribute'] = $field['attribute'];
                                    $timestamp[$timestamp_counter]['type'] = $field['type'];
                                    $timestamp_counter ++;
                                    echo $this->Form->input($field['name'], $options);
                                    break;
                                case 'datetime':
                                    $options['type'] =  "text";
                                    $options['id'] = "timestamp_".$k;
                                    $options['class'] .= " bs_datetimepicker";
                                    $timestamp[$timestamp_counter]['id'] = "timestamp_".$k;
                                    $timestamp[$timestamp_counter]['attribute'] = $field['attribute'];
                                    $timestamp[$timestamp_counter]['type'] = $field['type'];
                                    $timestamp_counter ++;
                                    echo $this->Form->input($field['name'], $options);
                                    break;
                                case 'daterange':
                                    $options['type'] =  "text";
                                    $options['id'] = "timestamp_".$k;
                                    $options['class'] .= " bs_daterangepicker";
                                    $timestamp[$timestamp_counter]['id'] = "timestamp_".$k;
                                    $timestamp[$timestamp_counter]['attribute'] = $field['attribute'];
                                    $timestamp[$timestamp_counter]['type'] = $field['type'];
                                    $timestamp_counter ++;
                                    echo $this->Form->input($field['name'], $options);
                                    break;
                                default:
                                    break;
                            }

                            //                        debug($timestamp);
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-1" style="padding-left: 0px;padding-right: 0px; padding-top: 25px;">
                        <?php echo $this->Html->link('<button class="btn btn-sm btn-success" ><i class="fa fa-caret-right"></i></button>', array('controller'=>'customlayouts','action' => 'movedown', $field['layout_id']), array('escape'=>false));  ?>

                    </div>

                </div>

            </div> <!-- / .form-group -->
            <?
        }
    }?>
</div>
<?}?>
    <?

    foreach($layout['group'] as $j=>$group){?>
        <?if(!empty($group['fields'])){?>
        <div class="panel-heading">
            <div class="panel-title">
                <?=$group['name']?>
            </div>
        </div>
        <div class="panel-body">
            <?foreach($group['fields'] as $k=>$field){

                if(!$field['hidden']){

                    $required = "";
                    ($field['required'])?$required="required":$required="";

                    ($field['required'])?$star=" *":$star="";

                    ?>

                    <div class="<?=$field['div_class']?>">
                        <div class="row">
                            <div class="col-sm-1" style="padding-left: 0px;padding-right: 0px; padding-top:25px;">
                                <?php echo $this->Html->link('<button class="btn btn-sm btn-warning"><i class="fa fa-caret-left"></i></button>', array('controller'=>'customlayouts','action' => 'moveup', $field['layout_id']), array('escape'=>false));  ?>
                            </div>
                            <div class="col-sm-8" style="padding-right: 5px;">
                                <div class="form-group">
                                    <?php echo $this->Form->label("Customtype.99$j$k.".$field['name'], $field['label'] .$star, 'control-label'); ?>
                                    <?php echo $this->Form->hidden("Customtype.99$j$k.field_id", array('value'=>$field['field_id']))?>
                                    <?php echo $this->Form->hidden("Customtype.99$j$k.model_id", array('value'=>$field['model_id']))?>
                                    <?php echo $this->Form->hidden("Customtype.99$j$k.type_id", array('value'=>$field['type_id']))?>
                                    <?php

                                    $field['name'] = "Customtype.99$j$k.value";
                                    $options = array(
                                        'div'=>false,
                                        'label'=>false,
                                        'class'=>'form-control',
                                        'placeholder'=>$field['placeholder'],
                                        'required'=>$required,
                                        'default'=>$field['default']
                                    );

                                    if(!empty($field['attribute'])){
                                        foreach ($field['attribute'] as $name=>$val){
                                            $options[$name]=$val;
                                        }
                                    }

                                    switch ($field['type']){
                                        case 'text':
                                            $options['type'] = "text";
                                            echo $this->Form->input($field['name'], $options);
                                            break;
                                        case 'int':
                                        case 'float':
                                            $options['type'] = "number";
                                            echo $this->Form->input($field['name'], $options);
                                            break;
                                        case 'textarea':
                                            $options['type'] =  "textarea";
                                            echo $this->Form->input($field['name'], $options);
                                            break;
                                            case 'select':
                                            $options['class'] .=  " select2";
                                            $options['type'] =  "select";
                                            if(!$required){
                                                $options['class'] .=  " allowClear";
                                            }

                                            if($field['multiple']){
                                                $options['multiple'] = 'true';

                                            }
                                            $options['options'] = $field['options'];
                                            echo $this->Form->input($field['name'], $options);
                                            break;
                                        case 'bool':
                                            $options['type'] =  "checkbox";

                                            echo $this->Form->hidden($field['name'], array('value'=>0));
                                            echo $this->Form->input($field['name'], $options);
                                            break;
                                        case 'date':
                                            $options['type'] =  "text";
                                            $options['id'] = "timestamp_".$k;
                                            $options['class'] .= " bs_datepicker";
                                            $timestamp[$timestamp_counter]['id'] = "timestamp_".$k;
                                            $timestamp[$timestamp_counter]['attribute'] = $field['attribute'];
                                            $timestamp[$timestamp_counter]['type'] = $field['type'];
                                            $timestamp_counter ++;
                                            echo $this->Form->input($field['name'], $options);
                                            break;
                                        case 'time':
                                            $options['type'] =  "text";
                                            $options['id'] = "timestamp_".$k;
                                            $options['class'] .= " timepicker";
                                            $timestamp[$timestamp_counter]['id'] = "timestamp_".$k;
                                            $timestamp[$timestamp_counter]['attribute'] = $field['attribute'];
                                            $timestamp[$timestamp_counter]['type'] = $field['type'];
                                            $timestamp_counter ++;
                                            echo $this->Form->input($field['name'], $options);
                                            break;
                                        case 'datetime':
                                            $options['type'] =  "text";
                                            $options['id'] = "timestamp_".$k;
                                            $options['class'] .= " bs_datetimepicker";
                                            $timestamp[$timestamp_counter]['id'] = "timestamp_".$k;
                                            $timestamp[$timestamp_counter]['attribute'] = $field['attribute'];
                                            $timestamp[$timestamp_counter]['type'] = $field['type'];
                                            $timestamp_counter ++;
                                            echo $this->Form->input($field['name'], $options);
                                            break;
                                        case 'daterange':
                                            $options['type'] =  "text";
                                            $options['id'] = "timestamp_".$k;
                                            $options['class'] .= " bs_daterangepicker";
                                            $timestamp[$timestamp_counter]['id'] = "timestamp_".$k;
                                            $timestamp[$timestamp_counter]['attribute'] = $field['attribute'];
                                            $timestamp[$timestamp_counter]['type'] = $field['type'];
                                            $timestamp_counter ++;
                                            echo $this->Form->input($field['name'], $options);
                                            break;
                                        default:
                                            break;
                                    }

                                    //                        debug($timestamp);
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-1" style="padding-left: 0px;padding-right: 0px; padding-top: 25px;">
                                <?php echo $this->Html->link('<button class="btn btn-sm btn-success" ><i class="fa fa-caret-right"></i></button>', array('controller'=>'customlayouts','action' => 'movedown', $field['layout_id']), array('escape'=>false));  ?>

                            </div>

                        </div>

                    </div>
                    <?
                }
            }?>
        </div>
        <?}?>
    <?}?>

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
