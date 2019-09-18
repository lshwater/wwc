<ul class="breadcrumb">
    <li>
        <?=$this->Html->link("返回", $redirecturl)?>
    </li>
    <li class="active"><?=__('財政預算')?></li>
</ul>

<div class="panel">
    <div class="panel-heading">
        <h2>
            <?=__('財政預算')?>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </h2>
    </div>
    <?php echo $this->Form->create('Financialbudget', array('class'=>'form-horizontal validate_form','type' => 'file', 'id'=>'financialbudgetform')); ?>
    <?php echo $this->Form->hidden('Financialbudget.editable', array('value'=>1));?>
    <?php echo $this->Form->hidden('Financialbudget.user_id', array('value'=>$auth['id']));?>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-6">
                <h3 class="sub-header"><?=__('收入')?></h3>
                <div class="row clearfix">
                    <div class="col-sm-12 column">
                        <table class="table table-bordered table-hover" id="tab_income">
                            <thead>
                            <tr>
                                <th class="col-sm-1 text-center">
                                    #
                                </th>
                                <th class="col-sm-4 text-center">
                                    <?=__('項目')?>
                                </th>
                                <th class="col-sm-2 text-center">
                                    <?=__('數目')?>
                                </th>
                                <th class="col-sm-2 text-center">
                                    <?=__('單價(HKD)')?>
                                </th>
                                <th class="col-sm-2 text-center">
                                    <?=__('總金額(HKD)')?>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style="display:none" class="dummy" id="income_row">
                                <td class="col-sm-1">
                                    <span class="btn btn-sm btn-danger delete_row"><i class="fa fa-close"></i></span>
                                </td>
                                <td class="col-sm-4">
                                    <div class="form-group no-margin no-padding ">
                                        <?php echo $this->Form->select('financialitem_id', $income, array('div'=>false, 'label'=>false));?>
                                    </div>
                                </td>
                                <td class="col-sm-2">
                                    <div class="form-group no-margin no-padding">
                                        <?php echo $this->Form->input('quantity', array('type'=>'text', 'min'=>'0', 'div'=>false, 'label'=>false, 'placeholder'=>__('Quantity')));?>
                                    </div>
                                </td>
                                <td class="col-sm-2">
                                    <div class="form-group no-margin no-padding">
                                        <?php echo $this->Form->input('unit_cost', array('type'=>'text', 'min'=>'0', 'step'=>'0.01', 'div'=>false, 'label'=>false, 'placeholder'=>__('Cost')));?>
                                    </div>
                                </td>
                                <?php echo $this->Form->hidden('type', array('value'=>'income'));?>
                                <td class="col-sm-2">
                                    <div class="form-group no-margin no-padding">
                                        <input type="text" class="form-control row_sum" value="$0.00" disabled/>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <a id="add_income_row" class="btn btn-default pull-left"><?=__('新增項目')?></a>
            </div>
            <div class="col-xs-6">
                <h3 class="sub-header"><?=__('支出')?></h3>
                <div class="row clearfix">
                    <div class="col-sm-12 column">
                        <table class="table table-bordered table-hover" id="tab_expense">
                            <thead>
                            <tr>
                                <th class="col-sm-1 text-center">
                                    #
                                </th>
                                <th class="col-sm-4 text-center">
                                    <?=__('項目')?>
                                </th>
                                <th class="col-sm-2 text-center">
                                    <?=__('數目')?>
                                </th>
                                <th class="col-sm-2 text-center">
                                    <?=__('單價(HKD)')?>
                                </th>
                                <th class="col-sm-2 text-center">
                                    <?=__('總金額(HKD)')?>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style="display:none" class="dummy" id="expense_row">
                                <td class="col-sm-1">
                                    <span class="btn btn-sm btn-danger delete_row"><i class="fa fa-close"></i></span>
                                </td>
                                <td class="col-sm-4">
                                    <div class="form-group no-margin no-padding">
                                        <?php echo $this->Form->select('financialitem_id', $expense, array('div'=>false, 'label'=>false));?>
                                    <div>
                                </td>
                                <td class="col-sm-2">
                                    <div class="form-group no-margin no-padding">
                                        <?php echo $this->Form->input('quantity', array('type'=>'text', 'min'=>'0', 'div'=>false, 'label'=>false, 'placeholder'=>__('Quantity')));?>
                                    </div>
                                </td>
                                <td class="col-sm-2">
                                    <div class="form-group no-margin no-padding">
                                        <?php echo $this->Form->input('unit_cost', array('type'=>'text', 'min'=>'0', 'step'=>'0.01', 'div'=>false, 'label'=>false, 'placeholder'=>__('Cost')));?>
                                    </div>
                                </td>
                                <?php echo $this->Form->hidden('type', array('value'=>'expense'));?>
                                <td class="col-sm-2">
                                    <div class="form-group no-margin no-padding">
                                        <input type="text" class="form-control row_sum" value="$0.00" disabled/>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a id="add_expense_row" class="btn btn-default pull-left"><?=__('新增項目')?></a>
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
                                <h3 id="total_income">$0.00</h3>
                            </div>
                        </div>
                        <div class="col-xs-6" align="right">
                            <div class="col-md-8">
                                <h3><?=__('總支出')?> : </h3>
                            </div>
                            <div class="col-md-4">
                                <h3 id="total_expense">$0.00</h3>
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
                                <h3 id="balance">$0.00</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->hidden('total_expense', array('id'=>'form_total_expense', 'value'=>0));?>
    <?php echo $this->Form->hidden('total_income', array('id'=>'form_total_income', 'value'=>0));?>
    <div class="panel-footer text-right">
        <?php echo $this->Html->link('<i class="glyphicon glyphicon-remove-sign"></i>&nbsp;'.__('Cancel'), $redirecturl,  array('escape'=>false, 'class'=>'btn btn-danger btn-labeled')); ?>
        <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i>&nbsp;<?=__('Save');?></button>
    </div>
    <?php echo $this->Form->end(); ?>
</div>


<script>

    function refresh_amount(){
        var sum_income = 0;
        $("#tab_income td").each(function(){
            if (typeof $(this).find('.row_sum').val() == 'string' ){
                sum_income +=parseInt($(this).find('.row_sum').val().replace(/\$/g, ''));
            }

        });
        $('#total_income').text('$'+sum_income.toFixed(2));
        $('#form_total_income').val(sum_income);

        var sum_expense = 0;
        $("#tab_expense td").each(function(){
            if (typeof $(this).find('.row_sum').val() == 'string' ){
                sum_expense +=parseInt($(this).find('.row_sum').val().replace(/\$/g, ''));
            }
        });
        $('#total_expense').text('$'+sum_expense.toFixed(2));
        $('#form_total_expense').val(sum_expense);

        $('#balance').text('$'+(sum_income-sum_expense).toFixed(2));

    }

    $(document).ready(function(){


        var lastRow = 0;

        $("#add_income_row").click(function(){
            lastRow++;
            $('#income_row').clone(true).attr('id','record'+lastRow).css("display","").removeClass("dummy").appendTo('#tab_income');
            $("#record"+lastRow+" select:first").attr('name','data[Financialbudgetdetail]['+lastRow+'][financialitem_id]').attr('id','Financialbudgetdetail'+lastRow+'FinancialitemId').attr('required', '').addClass('form-control');
            $("#record"+lastRow+" input:first").attr('name','data[Financialbudgetdetail]['+lastRow+'][quantity]').attr('id','Financialbudgetdetail'+lastRow+'Quantity').attr('required', '').addClass('form-control vd_number quantity');
            $("#record"+lastRow+" input:eq(1)").attr('name','data[Financialbudgetdetail]['+lastRow+'][unit_cost]').attr('id','Financialbudgetdetail'+lastRow+'UnitCost').attr('required', '').addClass('form-control vd_number cost');
            $("#record"+lastRow+" input:eq(2)").attr('name','data[Financialbudgetdetail]['+lastRow+'][type]').attr('id','Financialbudgetdetail'+lastRow+'Type');
            $('#Financialbudgetdetail'+lastRow+'FinancialitemId').addClass("select2").select2().attr('style','display:block; position:absolute; bottom: 0; left: 0; clip:rect(0,0,0,0);');

            $('.select2-multiple').select2({
                allowClear: true
            });
        });

        $("#add_expense_row").click(function(){
            lastRow++;
            $('#expense_row').clone(true).attr('id','record'+lastRow).css("display","").removeClass("dummy").appendTo('#tab_expense');
            $("#record"+lastRow+" select:first").attr('name','data[Financialbudgetdetail]['+lastRow+'][financialitem_id]').attr('id','Financialbudgetdetail'+lastRow+'FinancialitemId').attr('required', '').addClass('form-control');
            $("#record"+lastRow+" input:first").attr('name','data[Financialbudgetdetail]['+lastRow+'][quantity]').attr('id','Financialbudgetdetail'+lastRow+'Quantity').attr('required', '').addClass('form-control vd_number quantity');
            $("#record"+lastRow+" input:eq(1)").attr('name','data[Financialbudgetdetail]['+lastRow+'][unit_cost]').attr('id','Financialbudgetdetail'+lastRow+'UnitCost').attr('required', '').addClass('form-control vd_number cost');
            $("#record"+lastRow+" input:eq(2)").attr('name','data[Financialbudgetdetail]['+lastRow+'][type]').attr('id','Financialbudgetdetail'+lastRow+'Type');
            $('#Financialbudgetdetail'+lastRow+'FinancialitemId').addClass("select2").select2().attr('style','display:block; position:absolute; bottom: 0; left: 0; clip:rect(0,0,0,0);');

            $('.select2-multiple').select2({
                allowClear: true
            });
        });

        $(".delete_row").click(function(){
            $(this).closest('tr').remove();
            refresh_amount();
        });

        $("table tr input").on(
            "input change", function(){
                var cost = $(this).closest('tr').find('.cost').val();
                var q = $(this).closest('tr').find('.quantity').val();
                var sum = parseFloat(cost) * parseInt(q);
                if (!isNaN(sum)){
                    $(this).closest('tr').find('.row_sum').val('$'+sum.toFixed(2));
                }else{
                    $(this).closest('tr').find('.row_sum').val('$0.00');
                }
                refresh_amount();
            });

    });

</script>