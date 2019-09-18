<ul class="breadcrumb modaloff">
    <li>
        <?=$this->Html->link(__("會藉列表"), array("action"=>"index"))?>
    </li>
    <li class="active"><?=__("會藉記錄詳情")?></li>
</ul>

<div class="modal-header">
    <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo __('相關會員'); ?></h4>
</div>
<div class="modal-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <colgroup>
                <col class="col-xs-3">
                <col class="col-xs-5">
            </colgroup>
            <thead>
            <tr>
                <th><?php echo __('類別'); ?></th>
                <th><?php echo __('姓名'); ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo __('主申請人'); ?></td>
                <td><?php echo $this->Html->link(h($memberapplication['Mainmember']['c_name'])."&nbsp;".h($memberapplication['Mainmember']['e_name']), array("controller"=>"members", "action"=>"view", $memberapplication['Mainmember']['id'], 'ajax'=>true), array('escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal')); ?></td>
            </tr>
            <?php
            foreach($memberapplication['Member'] as $member):
                ?>
                <tr>
                    <td><?php echo __('附屬會員'); ?></td>
                    <td><?php echo $this->Html->link(h($member['c_name'])."&nbsp;".h($member['e_name']), array("controller"=>"members", "action"=>"view", $member['id'], 'ajax'=>true), array('escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal')); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal-header">
    <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo __('會藉資料'); ?></h4>
</div>
<div class="modal-body">

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <colgroup>
                <col class="col-xs-3">
                <col class="col-xs-5">
            </colgroup>
            <thead>
                <tr>
                    <th><?php echo __('table_content'); ?></th>
                    <th><?php echo __('table_details'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo __('申請方式'); ?></td>
                    <td><?php echo h($memberapplication['Memberapplicationtype']['name']); ?></td>
                </tr>
                <tr>
                    <td><?php echo __('payment_code'); ?></td>
                    <td><?php echo h($memberapplication['Memberapplication']['payment_code']); ?></td>
                </tr>
                <tr>
                    <td><?php echo __('付款日期'); ?></td>
                    <td><?php echo h($memberapplication['Memberapplication']['paymentdate']); ?></td>
                </tr>
                <tr>
                    <td><?php echo __('會藉類別'); ?></td>
                    <td><?php echo h($memberapplication['Membertype']['name']); ?></td>
                </tr>
                <tr>
                    <td><?php echo __('會藉開始日'); ?></td>
                    <td><?php echo h($memberapplication['Memberapplication']['startdate']); ?></td>
                </tr>
                <tr>
                    <td><?php echo __('會藉到期日'); ?></td>
                    <td><?php echo h($memberapplication['Memberapplication']['enddate']); ?></td>
                </tr>
                <tr>
                    <td><?php echo __('統計日期'); ?></td>
                    <td><?
                        if($memberapplication['Memberapplication']['report_date']){
                            echo h($memberapplication['Memberapplication']['report_date']);
                        }else{
                            echo "不適用";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo __('會藉有效期'); ?></td>
                    <td><?php echo h($memberapplication['Memberapplication']['period']) . __('年'); ?> </td>
                </tr>
                <tr>
                    <td><?php echo __('金額'); ?></td>
                    <td>$<?php echo money_format("%i", $memberapplication['Memberapplication']['price']); ?></td>
                </tr>
                <tr>
                    <td><?php echo __('填寫單位'); ?></td>
                    <td><?php echo h($memberapplication['Unit']['name']); ?></td>
                </tr>
                <tr>
                    <td><?php echo __('填寫職員'); ?></td>
                    <td><?php echo h($memberapplication['User']['name']); ?></td>
                </tr>
                <tr>
                    <td><?php echo __('備註'); ?></td>
                    <td><?php echo h($memberapplication['Memberapplication']['remarks']); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">

        <div class="modal-content">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

    $( document ).ready(function() {
        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal');
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('#modal .modalonly').show();
            $('#modal .modaloff').hide();
        });
    })

</script>

