<div class="page-header">
    <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
        <?php echo __('收款項目'); ?>
    </h1>
    <div class="col-xs-12 col-sm-8">
        <div class="row">
            <hr class="visible-xs no-grid-gutter-h">
            <!-- "Create project" button, width=auto on desktops -->
            <!-- "Create project" button, width=auto on desktops -->
            <div class="text-right col-xs-12 col-sm-auto">
                <?php echo $this->Html->link('<span class="icon fa fa-plus"></span> '.__('新增'), array("action"=>"add"), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled')); ?>
            </div>

            <!-- Margin -->
            <div class="visible-xs clearfix form-group-margin"></div>
        </div>
    </div>
</div>

<table class="table table-striped table-bordered table-condensed table-hover" id="datatables">
    <thead>
    <tr>
        <th>編號</th>
        <th>名稱</th>
        <th>類別</th>
        <th>價格</th>
        <th>生效</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($paymentitems as $item):?>
        <tr>
            <td><?php echo h($item['Paymentitem']['code']); ?>&nbsp;</td>
            <td>
                <?php echo h($item['Paymentitem']['name']); ?>
            </td>

            <td>
                <?php echo h($item['Paymentitemcategory']['name']); ?>
            </td>
            <td>
                $<?php echo money_format("%i", $item['Paymentitem']['unitprice']); ?>
            </td>
            <td><?=($item['Paymentitem']['active'])?"生效":""; ?>&nbsp;</td>
            <td>
                <?php
                echo $this->Html->link('<span class="fa fa-pencil"></span> '.__('修改'), array('action' => 'edit', $item['Paymentitem']['id']),array('class'=>"btn btn-warning btn-sm", 'escape' => false));
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