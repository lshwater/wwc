<div class="modal-header">
    單位資料
    <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
</div>
<div class="modal-body">
<ul id="uidemo-tabs-default-demo" class="nav nav-tabs" data-tabs="tabs">
    <li class="active">
        <a href="#unit_info" data-toggle="tab"><?=__("單位資料")?></a>
    </li>
    <li>
        <a href="#userlist" data-toggle="tab"><?=__("職員名單")?></a>
    </li>

</ul>

<div class="tab-content tab-content-bordered">
    <div class="tab-pane fade active in" id="unit_info">
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
                    <td><?php echo __('Name'); ?></td>
                    <td><?php echo h($unit['Unit']['name']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('Agency'); ?></td>
                    <td><?php echo $this->Html->link($unit['Agency']['name'], array('controller' => 'agencies', 'action' => 'view', $unit['Agency']['id'])); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('Name'); ?></td>
                    <td><?php echo h($unit['Unit']['name']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('Address'); ?></td>
                    <td><?php echo h($unit['Unit']['address']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('Phone'); ?></td>
                    <td><?php echo h($unit['Unit']['tel']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('Fax'); ?></td>
                    <td><?php echo h($unit['Unit']['fax']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('Email'); ?></td>
                    <td><?php echo h($unit['Unit']['email']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('備註'); ?></td>
                    <td><?php echo h($unit['Unit']['remark']); ?>&nbsp;</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div class="tab-pane" id="userlist">
        <?
        if (empty($unit['User'])){
            echo __('沒有職員');
        }else{
            ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th><?php echo __('Name'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?
                foreach($unit['User'] as $user){
                    ?>
                    <tr>
                        <td><?=$this->Html->link($user['name'], array("controller"=>"users", "action"=>"view", $user['id']))?>&nbsp;</td>
                    </tr>
                <?
                }
                ?>
                </tbody>
            </table>
        </div>
        <?
        }
        ?>

    </div>
</div>

</div>