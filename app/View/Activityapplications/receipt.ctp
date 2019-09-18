<!-- 5. $INVOICE_PAGE ==============================================================================

		Invoice page
-->
<?
//Configure::write('debug', 2);
//debug($activityapplication);
?>
<?php $this->layout='receipt-print';?>

<? if (!empty($activityapplication['Activityapplication']['systemlog'])) { ?>
    <div id="pa-page-alerts-box">
        <div class="alert alert-page pa_page_alerts_default " data-animate="true" style="">
            <button type="button" class="close">×</button>
            <strong>系統記錄</strong>
            <?= h($activityapplication['Activityapplication']['systemlog']) ?>
        </div>
    </div>
<? } ?>

<?php
$page_break = false;
foreach ($activityapplication['Activityapplicant'] as $index=>$item) {
    ?>
    <?if($page_break){?>
        <P class="breakhere">
    <?}?>
    <div class="invoice">
        <div class="invoice-header">
            <h3>
                <div>
                    <small><? echo $this->Html->image('cLogo.png', array('alt' => 'Logo', 'style' => 'height:80px;')); ?><br/></small>
                </div>
            </h3>
            <!--<address>-->

            <!--</address>-->
            <div class="invoice-date">
                <?
                    if($activityapplication['Activityapplication']['printed']){
                ?>
                        <strong>收據重印</strong><br><br>
                <?
                    }
                ?>

                <small><strong>發出日期</strong></small><br>
                <?= date("F d, Y", strtotime($activityapplication['Activityapplication']['date'])) ?>
            </div>
        </div> <!-- / .invoice-header -->

        <div class="invoice-info">
            <div class="invoice-total" style="float: left; text-align: left; height: inherit; line-height: inherit;">
                收據號碼: <strong>#<?= h($activityapplication['Activityapplication']['payment_code']) ?></strong><br>
                負責職員: <strong><?= h($activityapplication['User']['name']) ?></strong>
            </div> <!-- / .invoice-recipient -->
            <div class="invoice-total" style="float: right; text-align: right;  height: inherit; line-height: inherit;">
                總收費: <strong style="font-weight: 600; font-size: 24px; margin-left: 15px;">$<?= h($activityapplication['Activityapplication']['totalcost']) ?></strong>

            </div> <!-- / .invoice-total -->
        </div> <!-- / .invoice-info -->
        <hr>


        <div class="invoice-table">
            <table>
                <thead>
                <tr>
                    <th>
                        活動名稱 ／ 編號
                    </th>
                    <th style="width:30%">
                        活動日期
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <?= h($item['Activity']['activity_code']) ?>
                        ／ <?= h($item['Activity']['name']) ?>
                        <div class="invoice-description">

                        </div>

                    </td>
                    <td>
                        由 <?= h($item['Activity']['startdate']) ?>
                        至 <?= h($item['Activity']['enddate']) ?>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-11">
                <table>
                    <thead>
                    <tr>
                        <th>
                            參加者
                        </th>
                        <th style="width:30%">
                            費用
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <?= h($item['e_name']) ?>
                            <?
                            if (!empty($item['Member']['c_name'])) {
                                echo  "(".h($item['Member']['c_name']).")";
                            }?>

                            <? if ($item['ismember']) { ?>
                                <div class="invoice-description">
                                    會員編號： <?= h($item['Member']['code']) ?>
                                    ( <?= h($item['Member']['Membertype']['name']) ?> )
                                </div>
                            <? } ?>

                        </td>
                        <td>
                            $<?= money_format("%i", $item['cost']) ?>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <br/>
        <hr>

    </div> <!-- / .invoice -->
    <?
    $page_break = true;
}
?>
