<div class="page-header">
    <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
        <?php echo __('站內公佈管理'); ?>
    </h1>
    <div class="col-xs-12 col-sm-8">
        <div class="row">
            <hr class="visible-xs no-grid-gutter-h">
            <!-- "Create project" button, width=auto on desktops -->
            <!-- "Create project" button, width=auto on desktops -->
            <div class="text-right col-xs-12 col-sm-auto">
                <?php echo $this->Html->link('<span class="icon fa fa-plus"></span> '.__('新增公佈'), array("action"=>"add"), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled')); ?>
            </div>

            <!-- Margin -->
            <div class="visible-xs clearfix form-group-margin"></div>
        </div>
    </div>
</div>

<table class="table table-striped table-bordered table-condensed table-hover" id="datatables">
    <thead>
    <tr>
        <th><?php echo __("標題"); ?></th>
        <th >公佈時間</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($announcements as $announcement):
        ?>
        <tr>
            <td>
                <?php echo $this->Html->link(h($announcement['Announcement']['title']), array('action' => 'view', $announcement['Announcement']['id'], 'redirect'=>urlencode($this->Html->url(null, true))));  ?>
                <?
                if($announcement['Announcement']['needconfirm']){
                ?>
                    <i class="fa fa-bar-chart text-default"></i>
                <?
                }?>
            </td>
            <td>
                <em>
                    <?echo $this->Time->timeAgoInWords($announcement['Announcement']['created'],  array(
                        'format' => __('time_format'),
//                            'format' => 'F jS, Y',
                        'accuracy' => array('hour' => 'hour'),
                        'end' => '2 hour'
                    ));?>
                </em>
            </td>
            <td class="actions">
                <?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $announcement['Announcement']['id'], 'redirect'=>urlencode($this->Html->url(null, true))), array('class'=>'btn btn-sm btn-warning', 'escape'=>false));  ?>
                <?php echo $this->Form->postLink('<i class="fa fa-times"></i>', array('action' => 'delete', $announcement['Announcement']['id'], 'redirect'=>urlencode($this->Html->url(null, true))), array('class'=>'btn btn-sm btn-danger', 'escape'=>false), __('Are you sure you want to delete?')); ?>
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