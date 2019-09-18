<?

$total_prepayment = 0;
?>


<div class="panel">

    <div class="panel-body">
        <div class="row">
            <div class="col-xs-6">
                <h3 class="sub-header"><?=__('收入')?></h3>
                <div class="row clearfix">
                    <div class="col-sm-12 column">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="col-sm-4 text-center">
                                    <?=__('項目')?>
                                </th>
                                <th class="col-sm-2 text-center">
                                    <?=__('數目')?>
                                </th>
                                <th class="col-sm-2 text-center">
                                    <?=__('單價')?>
                                </th>
                                <th class="col-sm-2 text-center">
                                    <?=__('總金額')?>
                                </th>
                            </tr>
                            </thead>
                            <tbody>

                            <?foreach($balancedetail['Financialbalanceincome'] as $income){
                            ?>
                            <tr>
                                <td class="col-sm-4">
                                    <?php echo h($income['Financialitem']['name']); ?>&nbsp;
                                </td>
                                <td class="col-sm-2 text-center">
                                    <?php echo h($income['quantity']); ?>&nbsp;
                                </td>
                                <td class="col-sm-2 text-right">
                                    $<?php echo money_format("%i", $income['unit_cost']); ?>&nbsp;
                                </td>
                                <td class="col-sm-2 text-right">
                                    $<?php echo money_format("%i", $income['unit_cost']*$income['quantity']); ?>
                                </td>
                            </tr>
                            <?
                            }
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <h3 class="sub-header"><?=__('支出')?></h3>
                <div class="row clearfix">
                    <div class="col-sm-12 column">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="col-sm-4 text-center">
                                    <?=__('項目')?>
                                </th>
                                <th class="col-sm-2 text-center">
                                    <?=__('數目')?>
                                </th>
                                <th class="col-sm-2 text-center">
                                    <?=__('單價')?>
                                </th>
                                <th class="col-sm-2 text-center">
                                    <?=__('總金額')?>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?foreach($balancedetail['Financialbalanceexpense'] as $expense){
                            ?>
                            <tr>
                                <td class="col-sm-4">
                                    <?php echo h($expense['Financialitem']['name']); ?>&nbsp;
                                </td>
                                <td class="col-sm-2 text-center">
                                    <?php echo h($expense['quantity']); ?>&nbsp;
                                </td>
                                <td class="col-sm-2 text-right">
                                    $<?php echo money_format("%i", $expense['unit_cost']); ?>&nbsp;
                                </td>
                                <td class="col-sm-2 text-right">
                                    $<?php echo money_format("%i", $expense['unit_cost']*$expense['quantity']); ?>
                                </td>
                            </tr>
                            <?
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-transparent">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6" align="right">
                            <div class="col-md-8">
                                <h3><?=__('總收入')?> : </h3>
                            </div>
                            <div class="col-md-4">
                                <h3>$<?=money_format("%i", $balancedetail['Financialbalance']['total_income'])?></h3>
                            </div>
                        </div>
                        <div class="col-xs-6" align="right">
                            <div class="col-md-8">
                                <h3><?=__('總支出')?> : </h3>
                            </div>
                            <div class="col-md-4">
                                <h3>$<?=money_format("%i", $balancedetail['Financialbalance']['total_expense'])?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                        </div>
                        <div class="col-xs-6" align="right">
                            <div class="col-md-8">
                                <h3><?=__('總收支')?> : </h3>
                            </div>
                            <div class="col-md-4">
                                <h3>$<?=money_format("%i", $balancedetail['Financialbalance']['total_income'] - $balancedetail['Financialbalance']['total_expense'])?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?
    if($balancedetail['Financialbalance']['editable'])
    {
        ?>
        <div class="panel-footer">
            <? echo $this->Html->link(
                __('修改'),
                array(
                    'action' => 'edit', $id, $model, 'redirect'=>urlencode($redirecturl)
                ),
                array(
                    'class' => 'btn btn-primary btn-lg btn-block'
                )
            );
            ?>
        </div>
    <?
    }
    ?>

</div>
