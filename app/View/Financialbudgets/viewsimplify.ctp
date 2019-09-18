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

                            <?foreach($budgetdetail['Financialbudgetincome'] as $income){
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
                            <?foreach($budgetdetail['Financialbudgetexpense'] as $expense){
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
                                <h3>$<?=money_format("%i", $budgetdetail['Financialbudget']['total_income'])?></h3>
                            </div>
                        </div>
                        <div class="col-xs-6" align="right">
                            <div class="col-md-8">
                                <h3><?=__('總支出')?> : </h3>
                            </div>
                            <div class="col-md-4">
                                <h3>$<?=money_format("%i", $budgetdetail['Financialbudget']['total_expense'])?></h3>
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
                                <h3>$<?=money_format("%i", $budgetdetail['Financialbudget']['total_income'] - $budgetdetail['Financialbudget']['total_expense'])?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?
    if($budgetdetail['Financialbudget']['editable'])
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

<!--<div class="panel">-->
<!--    <div class="panel-heading">-->
<!--        <h3>--><?//=__('預支款項')?><!--</h3>-->
<!---->
<!--        <div>-->
<!--            --><?//=__('總預支金額')?><!-- ：-->
<!--            --><?//
//            foreach($budgetdetail['Prepayment'] as $prepayment){
//                $total_prepayment += $prepayment['amount'];
//            }
//            echo $total_prepayment;
//            ?>
<!--        </div>-->
<!--        --><?php //echo $this->Html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-plus"></i></button>', array('action' => 'addprepayment', $budgetdetail['Financialbudget']['id'], $id, $model, 'redirect'=>urlencode($redirecturl), 'apex'=>true), array('class'=>'', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal')); ?>
<!--    </div>-->
<!--    <div class="panel-body">-->
<!--        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-condensed" id="jq-datatables">-->
<!--            <thead>-->
<!--            <tr>-->
<!--                <th>--><?php //echo $this->Paginator->sort('date',__('預支日期')); ?><!--</th>-->
<!--                <th>--><?php //echo $this->Paginator->sort('amount',__('預支金額')); ?><!--</th>-->
<!--                <th>--><?php //echo $this->Paginator->sort('cheque_no',__('支票號碼')); ?><!--</th>-->
<!--                <th class="actions">--><?php //echo __('Actions'); ?><!--</th>-->
<!--            </tr>-->
<!--            </thead>-->
<!--            <tbody>-->
<!---->
<!--            --><?//foreach($budgetdetail['Prepayment'] as $prepayment){
//
//                ?>
<!--                <tr>-->
<!--                    <td>-->
<!--                        --><?php //echo h($prepayment['date']); ?><!--&nbsp;-->
<!--                    </td>-->
<!--                    <td>-->
<!--                        --><?php //echo h($prepayment['amount']); ?><!--&nbsp;-->
<!--                    </td>-->
<!--                    <td>-->
<!--                        --><?php //echo h($prepayment['cheque_no']); ?><!--&nbsp;-->
<!--                    </td>-->
<!--                    <td class="actions">-->
<!--                        --><?php //echo $this->Html->link('<button class="btn btn-sm btn-warning" style="width: 30px;"><i class="fa fa-pencil"></i></button>', array('action' => 'editprepayment', $prepayment['id'], $id, $model, 'redirect'=>urlencode($redirecturl), 'ajax'=>true), array('class'=>'', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static")); ?>
<!--                        --><?php //echo $this->Form->postLink('<button class="btn btn-sm btn-danger" style="width: 30px;"><i class="fa fa-times"></i></button>', array('action' => 'delprepayment', $prepayment['id'], $id, $model, 'redirect'=>urlencode($redirecturl)), array('escape'=>false), __('Are you sure you want to delete # %s?', $prepayment['id'])); ?>
<!--                    </td>-->
<!--                </tr>-->
<!--            --><?//
//            }
//            ?>
<!---->
<!--            </tbody>-->
<!--        </table>-->
<!--    </div>-->
<!--</div>-->



<script>
    $( document ).ready(function() {

        $('#jq-datatables').dataTable();

    });

</script>