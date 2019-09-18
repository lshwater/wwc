<?
//Configure::write('debug', 2);

//debug($para_list);
?>

<div class="row">
    <div class="col-md-12">

        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title"><?php echo __('Parameters'); ?> - <?php echo h($model_name); ?></span>
                <div class="panel-heading-controls">
                    <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                </div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <tr>
                        <?foreach($key_list as $key){?>
                            <th><?php echo $this->Paginator->sort($key, __($key)); ?></th>
                        <?}?>
                        <th><?php echo $this->Paginator->sort('active',__('active')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count = 0;
                    foreach ($para_list as $para):
                        $count++;
                        ?>
                        <tr>
                            <?foreach($key_list as $key){?>
                                <td><?php echo h($para[$model][$key]); ?>&nbsp;</td>
                            <?}?>
                            <td>
                                <?php
//                                if($para[$model]['editable']){
                                    if($para[$model]['active']){
                                        $checked = "checked";
                                    } else{
                                        $checked = "";
                                    }
//                                }
                                ?>

                                <label for="switcher-icon<?=$count?>" class="switcher switcher-success">
                                    <input type="checkbox" class="active-switcher" id="switcher-icon<?=$count?>" data-id="<?=$para[$model]['id']?>" data-model="<?=$model?>" <?=$checked?>>
                                    <div class="switcher-indicator">
                                        <div class="switcher-yes"><i class="fa fa-check"></i></div>
                                        <div class="switcher-no"><i class="fa fa-close"></i></div>
                                    </div>
                                    生效
                                </label>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<script>

    $( document ).ready(function() {
        // $('.active-switcher').switcher({
        //     on_state_content: 'ON',
        //     off_state_content: 'OFF'
        // });

        $('.active-switcher').click(function(){
            var obj = $(this);
            var id = obj.attr('data-id');
            var model = obj.attr('data-model');
            var checkval = obj.is(':checked')?1:0;
            obj.attr("disable", "disable");

            $.ajax({
                type: "POST",
                url: '<?=$this->Html->url(array('controller'=>'Parameters', 'action'=>'changeactive'))?>',
                data: {id:id, model:model, active:checkval},
                dataType: 'json'
            })
                .done(function(data) {
                    // if(data.result){
                    //     obj.val(data.active);
                    //     if(obj.val() == 1){
                    //         obj.switcher('on');
                    //     }else{
                    //         obj.switcher('off');
                    //     }
                    //     obj.switcher('enable');
                    // }
                    // else
                    // {
                    //     alert('Update Fail!');
                    // }


                })
                .fail(function() {
                    alert('Active Fail! Please try again');
                });
        });

    })

</script>