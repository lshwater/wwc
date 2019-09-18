
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

    <h3 class="modal-title">
        <?=__("付款")?>

    </h3>
</div>
<?php echo $this->Form->create('Member', array('class'=>'validate_form')); ?>
<div class="modal-body">

    <div class="row">
        <div class="col-sm-12">
            <div class="table-default">
                <table cellspacing="0" class="table nowrap" id="jq-datatables" width="100%" style="font-size: 20px;">
                    <thead>
                    <tr>
                        <th style="width:55%">項目</th>
                        <th style="width:15%">數量</th>
                        <th style="width:15%">單價</th>
                        <th style="width:15%">價格</th>
                        <th style="width:15%"></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>補領會員証</td>
                            <td>1</td>
                            <td>$10</td>
                            <td>$10</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>愛心米 2KG</td>
                            <td>2</td>
                            <td>$60</td>
                            <td>$120</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>中國水墨畫 初班</td>
                            <td>1</td>
                            <td>$120</td>
                            <td>$120</td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>

                    <tr>
                        <th class="text-right" colspan="2">總價</th>
                        <td></td>
                        <th>$250</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th class="text-right" colspan="2">現金</th>
                        <td></td>
                        <th><input class="form-control" value="150"/></th>
                        <th><button class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></button></th>
                    </tr>
                    <tr>
                        <th class="text-right" colspan="2">八達通</th>
                        <td></td>
                        <th><input class="form-control" value="50"/></th>
                        <th><button class="btn btn-sm btn-danger"><i class="fa fa-remove"></i></button></th>
                    </tr>
                    <tr>
                        <th class="text-right" colspan="2"></th>
                        <td></td>
                        <th>-$50</th>
                        <th></th>
                    </tr>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
<div class="modal-header">

    <h3 class="modal-title">
        <?=__("付款方法")?>
    </h3>
</div>
<div class="modal-body">
    <button type="submit" class="btn ">現金</button>
    <button type="submit" class="btn btn-success">EPS</button>
    <button type="submit" class="btn">八達通</button>
    <button type="submit" class="btn btn-success">信用卡</button>
    <button type="submit" class="btn btn-success">積分</button>
    <button type="submit" class="btn btn-success">調整收費</button>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-block btn-danger"><? echo ' '.__('Submit');?></button>
</div>
<?php echo $this->Form->end(); ?>
<script>
    $( document ).ready(function() {
        // Multiselect
        validate_form();

    });


</script>