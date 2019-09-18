<?
//Configure::write('debug', 2);
//debug($cutoffdatemsg); exit();
?>

<div class="row">
    <div class="col-sm-12">
        <?if (!empty($memberapplication['Member'])){?>
        <?php echo $this->Form->create('Memberapplication', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" ><?php echo __('取消續會'); ?></h4>
        </div>

        <div class="modal-body">

            <?if(!empty($cutoffdatemsg)){?>
                <div class="alert alert-danger">
                    <?=__($cutoffdatemsg)?>
                </div>
            <?}?>
            <?php echo $this->Form->hidden('Memberapplication.id',array('value'=>$memberapplication['Memberapplication']['id']))?>
            <div class="table">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th><?php echo __('會員姓名'); ?></th>
                        <th><?php echo __('現有會藉結束日期'); ?></th>
                        <th><?php echo __('取消續會後，會藉結束日期'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($memberapplication['Member'] as $key=>$member):?>

                        <?if($member['last_memberapplication_id'] == $memberapplication['Memberapplication']['id']){?>
                            <tr>
                                <td><?php echo h($member['c_name']); ?>&nbsp; <?php echo h($member['e_name']); ?></td>
                                <td><?php echo h($member['membershipdate'])?></td>
                                <td>
                                    <?php echo $this->Form->hidden("Member.{$key}.id", array('value'=>$member['id']));?>
                                    <div class="form-group">
                                        <div class="col-sm-9">
                                        <?php echo $this->Form->input("Member.{$key}.membershipdate", array('div'=>false, 'label'=>false, 'class'=>'input-sm form-control datepicker', 'required'=>true,'type'=>'text', 'placeholder'=>"最後日期", 'value'=>$memberapplication['Memberapplication']['startdate']));?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?}else{?>
                            <tr>
                                <td><?php echo h($member['c_name']); ?>&nbsp; <?php echo h($member['e_name']); ?></td>
                                <td><?php echo h($member['membershipdate'])?></td>
                                <td><?=__('會員已更新續會，不可取消此續會紀錄')?></td>
                            </tr>

                        <?}?>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>

        <?
         }else{
        ?>
        <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
             <h4 class="modal-title" ><?php echo __('取消續會'); ?></h4>
        </div>

        <div class="modal-body">
            <div class="alert alert-danger">
                <?=__('不可取消續會')?>
            </div>
        </div>
        <?
        }
        ?>
    </div>
</div>

<script>
//    $( document ).ready(function() {
//        // Multiselect
//
//    });

    $(document).ready(function () {

        validate_form();

    });

</script>

