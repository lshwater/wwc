<? if(!empty($layout['nogroup'])){?>


        <?

        foreach($layout['nogroup'] as $k=>$field){

            if(!$field['hidden']){?>
                <tr>
                    <td><?php echo h($field['label']); ?></td>
                    <td>
                        <?php echo h($custom_field[$field['field_id']]['value_text']); ?>
                    </td>
                </tr>
                <?
            }
        }?>
<?}?>
<?

foreach($layout['group'] as $j=>$group){?>
    <?if(!empty($group['fields'])){?>
        <tr>
            <th colspan="2"><?=$group['name']?></th>
        </tr>
            <?foreach($group['fields'] as $k=>$field){

                if(!$field['hidden']){?>

                    <tr>
                        <td><?php echo h($field['label']); ?></td>
                        <td>
                            <?php echo h($custom_field[$field['field_id']]['value_text']);?>
                        </td>
                    </tr>


                    <?
                }
            }?>
    <?}?>
<?}?>

<script>

    $(document).ready(function() {

    });

</script>
