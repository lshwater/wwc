<!-- 5. $INVOICE_PAGE ==============================================================================

		Invoice page
-->
<?
//Configure::write('debug', 2);
//debug($activityapplication);
?>
<?php $this->Html->script("barcode/JsBarcode.all.min", array("inline"=>false)); ?>
<?php $this->layout='receipt-print';?>
<style>
    @media print{@page {size: landscape}}

</style>
<div class="row">
    <div class="col-xs-6 m-a-0 p-a-0 p-b-0 p-r-1 p-l-1 b-r-1">
        <div class="panel-body p-l-1 p-r-1 p-b-0 p-t-1">
            <div class="box m-a-0">
                <div class="box-row valign-middle">
                    <div class="box-cell pull-left">
                        <?=$this->Html->image('llsy_logo', array("width"=>'65px'))?>
                    </div>
                    <div class="box-cell pull-left m-l-2">
                        <div class="display-inline-block valign-middle font-size-15">
                            <div><?=h($payment["Unit"]['Agency']['name'])?> <?=h($payment['Unit']['name'])?></div>
                            <div><?=h($payment['Unit']['address'])?></div>
                            <div>Tel: <?=h($payment['Unit']['tel'])?> Fax: <?=h($payment['Unit']['fax'])?></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="panel-body p-l-1 p-r-0 p-b-0 p-t-0 ">
            <div class="box m-a-0">
                <div class="box-row valign-middle">
                    <div class="box-cell col-xs-7 p-r-0 m-a-0">
                        <div class="pull-xs-right font-size-20 font-weight-bold">
                            <?
                            if($payment['Payment']['printed']){
                                ?>
                                <u>收據重印</u>
                                <?
                            }else{?>
                                <u>正式收據</u>
                            <?}
                            ?>
                        </div>
                    </div>
                    <div class="box-cell col-xs-5 p-a-0 m-a-0">
                        <div class="pull-xs-right font-size-15">
                            <svg class="barcode"
                                 jsbarcode-format="CODE128"
                                 jsbarcode-text="收據編號 <?=h($payment['Payment']['code'])?>"
                                 jsbarcode-value="<?=h($payment['Payment']['code'])?>"
                                 jsbarcode-width="1"
                                 jsbarcode-height="30"
                                 jsbarcode-fontSize="14"
                                 jsbarcode-textmargin="0">
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body p-l-2 p-r-2 p-t-1 p-b-0 m-a-0">
            <div class="box">
                <div class="box-cell col-xs-12 font-size-16 text-left">
                    <strong>發出日期: <?=date("Y年m月d日", strtotime($payment['Payment']['paymentdate']))?></strong><br />
                    <strong>打印時間: <?=date("Y年m月d日 H:i")?></strong><br />
                    <strong>會員姓名: <?=h($payment['Payment']['payer'])?></strong><br />
                    <strong>會員編號: <?=h($payment['Membership']['code'])?></strong>
                </div>
            </div>
        </div>

        <div class="panel-body p-l-2 p-r-2 p-t-0 p-b-0 font-size-16">
            <table class="table m-a-0">
                <thead>
                <tr>
                    <th class="p-x-1">
                        項目
                    </th>
                    <th class="p-x-1">
                        數量
                    </th>
                    <th class="p-x-1">
                        費用
                    </th>
                </tr>
                </thead>
                <tbody class="">

                <?php
                foreach ($payment['Paymentrecord'] as $rd){?>
                    <tr>
                        <td class="p-a-1">
                            <div class="font-weight-semibold"><?=h($rd['name'])?></div>
                        </td>
                        <td class="p-a-1">
                            <strong><?=h($rd['quantity'])?></strong>
                        </td>
                        <td class="p-a-1">
                            <strong>$<?=money_format("%i", $rd['price'])?></strong>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

            <?
            if(!empty($payment['Payment']['remarks'])){?>

                <div class="col-sm-12" style="font-size: 13px;">
                    備註: <?=h($payment['Payment']['remarks'])?>
                </div>

            <?  }
            ?>
        </div>

        <div class="panel-body p-a-2 font-size-13">
            <table class="table m-a-0">
                <tr>
                    <th class="p-x-1">
                        <strong>總收費: $<?=money_format("%i", $payment['Payment']['sellingprice'])?> ( <?=h($payment['Paymentmethod']['name'])?> )</strong>
                    </th>
                    <th class="p-x-1">
                        簽發人: <?=h($payment["User"]["name"])?>
                    </th>
                </tr>
            </table>
        </div>

    </div>
    <div class="col-xs-6 m-a-0 p-a-0 p-b-0 p-r-1 p-l-1 b-r-0">
        <div class="panel-body p-l-1 p-r-1 p-b-0 p-t-1">
            <div class="box m-a-0">
                <div class="box-row valign-middle">
                    <div class="box-cell pull-left">
                        <?=$this->Html->image('llsy_logo', array("width"=>'65px'))?>
                    </div>
                    <div class="box-cell pull-left m-l-2">
                        <div class="display-inline-block valign-middle font-size-15">
                            <div><?=h($payment["Unit"]['Agency']['name'])?> <?=h($payment['Unit']['name'])?></div>
                            <div><?=h($payment['Unit']['address'])?></div>
                            <div>Tel: <?=h($payment['Unit']['tel'])?> Fax: <?=h($payment['Unit']['fax'])?></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="panel-body p-l-1 p-r-0 p-b-0 p-t-0 ">
            <div class="box m-a-0">
                <div class="box-row valign-middle">
                    <div class="box-cell col-xs-7 p-r-0 m-a-0">
                        <div class="pull-xs-right font-size-20 font-weight-bold">
                            <?
                            if($payment['Payment']['printed']){
                                ?>
                                <u>收據重印</u>
                                <?
                            }else{?>
                                <u>正式收據</u>
                            <?}
                            ?>
                        </div>
                    </div>
                    <div class="box-cell col-xs-5 p-a-0 m-a-0">
                        <div class="pull-xs-right font-size-15">
                            <svg class="barcode"
                                 jsbarcode-format="CODE128"
                                 jsbarcode-text="收據編號 <?=h($payment['Payment']['code'])?>"
                                 jsbarcode-value="<?=h($payment['Payment']['code'])?>"
                                 jsbarcode-width="1"
                                 jsbarcode-height="30"
                                 jsbarcode-fontSize="14"
                                 jsbarcode-textmargin="0">
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-body p-l-2 p-r-2 p-t-1 p-b-0 m-a-0">
            <div class="box">
                <div class="box-cell col-xs-12 font-size-16 text-left">
                    <strong>發出日期: <?=date("Y年m月d日", strtotime($payment['Payment']['paymentdate']))?></strong><br />
                    <strong>打印時間: <?=date("Y年m月d日 H:i")?></strong><br />
                    <strong>會員姓名: <?=h($payment['Payment']['payer'])?></strong><br />
                    <strong>會員編號: <?=h($payment['Membership']['code'])?></strong>
                </div>
            </div>
        </div>

        <div class="panel-body p-l-2 p-r-2 p-t-0 p-b-0 font-size-16">
            <table class="table m-a-0">
                <thead>
                <tr>
                    <th class="p-x-1">
                        項目
                    </th>
                    <th class="p-x-1">
                        數量
                    </th>
                    <th class="p-x-1">
                        費用
                    </th>
                </tr>
                </thead>
                <tbody class="">

                <?php
                foreach ($payment['Paymentrecord'] as $rd){?>
                    <tr>
                        <td class="p-a-1">
                            <div class="font-weight-semibold"><?=h($rd['name'])?></div>
                        </td>
                        <td class="p-a-1">
                            <strong><?=h($rd['quantity'])?></strong>
                        </td>
                        <td class="p-a-1">
                            <strong>$<?=money_format("%i", $rd['price'])?></strong>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

            <?
            if(!empty($payment['Payment']['remarks'])){?>

                <div class="col-sm-12" style="font-size: 13px;">
                    備註: <?=h($payment['Payment']['remarks'])?>
                </div>

            <?  }
            ?>
        </div>

        <div class="panel-body p-a-2 font-size-13">
            <table class="table m-a-0">
                <tr>
                    <th class="p-x-1">
                        <strong>總收費: $<?=money_format("%i", $payment['Payment']['sellingprice'])?> ( <?=h($payment['Paymentmethod']['name'])?> )</strong>
                    </th>
                    <th class="p-x-1">
                        簽發人: <?=h($payment["User"]["name"])?>
                    </th>
                </tr>
            </table>
        </div>

    </div>

</div>

<script>
    $(document).ready(function() {
        JsBarcode(".barcode").init();
    });

</script>


<style>
    body{
        color: black;
    }
</style>