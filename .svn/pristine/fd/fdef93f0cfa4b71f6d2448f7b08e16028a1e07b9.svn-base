<div class="page-header">

    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage"><i class="fa fa-rss page-header-icon"></i>&nbsp;&nbsp;<?php echo __('站內公佈'); ?></h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">

                <!-- Margin -->
                <div class="visible-xs clearfix form-group-margin"></div>
            </div>
        </div>
    </div>
</div>

<div class="table-default">
    <table class="table table-striped nowrap" cellspacing="0" id="jq-datatables" width="100%">
        <thead>
        <tr>
            <th></th>
            <th ><?php echo __("標題"); ?></th>
            <th>公佈時間</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($announcements as $announcement):
                if($announcement['needconfirm'] && empty($announcement['AnnouncementUser'])){
                    $needconfirmlb = '<span href="#" class="label ticket-label label-warning">未確認</span>';
                }else{
                    $needconfirmlb = "";
                }
            ?>
            <tr>
                <td></td>
                <td>
                    <?=$needconfirmlb?>
                    <?php echo $this->Html->link(h($announcement['title']), array('action' => 'view', $announcement['id'], 'redirect'=>urlencode($this->Html->url(null, true))));  ?>
                </td>
                <td >
                    <em>
                        <?
                        echo $this->Time->timeAgoInWords($announcement['created'],  array(
                            'format' => __('time_format'),
                            'accuracy' => array('hour' => 'hour'),
                            'end' => '2 hour'
                        ));
                        ?>
                    </em>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>


<script>
    $(document).ready(function () {
        $('#jq-datatables').dataTable({
            responsive: {
                details: {
                    type: 'column',
                    target: 'tr'
                }
            },
            columnDefs: [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],
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
            }
        });
    });
</script>