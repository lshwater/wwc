<div class="page-header">
    <h1 class="doc-header"><?php echo __('user').__('清單'); ?></h1>
</div>
<table class="table table-striped table-bordered table-condensed table-hover" id="datatables">
    <thead>
    <tr>
        <th><?php echo __('user').__('code'); ?></th>
        <th><?php echo __('unit'); ?></th>
        <th class="hidden-phone"><?php echo __('username'); ?></th>
        <th><?php echo __('user').__('name'); ?></th>
        <th><?php echo __('Active'); ?></th>
        <th class="actions" width="165"><?php echo __('actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user):?>
        <tr>
            <td><?php echo h($user['User']['code']); ?>&nbsp;</td>
            <td>
                <?php echo h($user['Unit']['name']); ?>
            </td>
            <td class="hidden-phone"><?php echo h($user['User']['username']); ?>&nbsp;</td>

            <td><?php echo h($user['User']['name']); ?>&nbsp;</td>
            <!-- 		<td class="hidden-phone"><?php echo h($user['User']['email']); ?>&nbsp;</td> -->
            <td><?php
                if($user['User']['active']){
                    echo "✔";
                }
                ?>&nbsp;
            </td>
            <td class="actions">
                <?php echo $this->Html->link('<span class="fa fa-eye"></span> '.__('查看'), array('action' => 'view', $user['User']['id']),array('class'=>"btn btn-info btn-sm", 'escape' => false)); ?>
                <?php
                if($user['User']['id'] != $auth['id'] && $user['User']['readonly'] != 1){
                    echo $this->Html->link('<span class="fa fa-pencil"></span> '.__('修改'), array('action' => 'edit', $user['User']['id']),array('class'=>"btn btn-warning btn-sm", 'escape' => false));
                }
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function() {
        $('#datatables').dataTable();
        $('#datatables_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
    });
</script>