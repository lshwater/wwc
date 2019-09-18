<?
echo $this->Html->script('chart');
echo $this->Html->script('chartmore');
echo $this->Html->script('modules/exporting');
?>

<style>
    .no-border {
        border: 0px;
        margin-top: 3px;
        margin-bottom: 3px;
    }
</style>

    <div class="modal-header">
        <span class="panel-title">
            存貨資料
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span
                    aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </span>
<!--        <div class="panel-heading-controls">-->
<!--        --><?php //echo $this->Html->link('<span class="btn-success"></span>'.__('修改'), array('action'=>'edit',$stock['Stock']['id']), array('escape'=>false, 'class'=>'btn btn-success')); ?>
<!--        --><?php //echo $this->Html->link('<span class="btn-success"></span>'.__('返回'), array('action'=>'index'), array('escape'=>false, 'class'=>'btn btn-success')); ?>

<!--        </div>-->
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <colgroup>
                    <col class="col-xs-3">
                    <col class="col-xs-5">
                </colgroup>
                <tbody>
                <tr>
                    <td><?php echo __('名稱'); ?></td>
                    <td><?php echo h($stock['Stock']['name']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td><?php echo __('圖片'); ?></td>
                    <td>
                        <?if($stock['Stock']['image_path']){?>
                            <img src="<?=$this->Html->url("/img/stock_img/". $stock['Stock']['image_path']);?>" alt="images" height="100">
                        <?}else{?>
                            <img src="<?=$this->Html->url("/img/dummy-avatar.png");?>" alt="images" height="100">
                        <?}?>
                        <?if($auth['allow_action']['stock']['edit']){?>
                        <hr class="no-border">
                        <button class="btn btn-sm btn-success updatephoto" >更新相片</button>
                        <?}?>
                    </td>
                </tr>
                <?if($auth['allow_action']['stock']['edit']){?>
                <tr>
                    <td colspan="2" class="selectphoto" hidden>
                        <?php echo $this->Form->create("Stock", array('url'=>$this->Html->url(array('controller'=>'stocks','action'=>'updatephoto')),'class'=>'form-horizontal validate_form preventDoubleSubmission', 'type' => 'file')); ?>
                        <?php echo $this->Form->hidden('stock_id',array('value'=>$stock['Stock']['id']))?>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php echo $this->Form->input("image", array("type" => "file", "label" => false, "div" => false, "class" => "form-control styled-finput")); ?>
                            </div>

                        </div>
                        <div class="row ">
                            <div class="col-sm-12">
                                <button type='submit' class=" btn btn-sm btn-block btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>


                    </td>
                </tr>
                <script>
                    $('.updatephoto').on('click',function(){
                        $('.selectphoto').toggle();
                    });
                    validate_form();
                </script>
                <?}?>
                <tr>
                    <td><?php echo __('簡介'); ?></td>
                    <td><?php echo h($stock['Stock']['description']); ?></td>
                </tr>
                <tr>
                    <td>單位</td>
                    <td><?php echo h($stock['Unit']['name']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>位置</td>
                    <td><?php echo h($stock['Stock']['location_detail']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>價格</td>
                    <td><?php if($stock['Stock']['cost']) echo "HKD $".money_format($stock['Stock']['cost'], 2); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>購自</td>
                    <td><?php echo h($stock['Stock']['acquired_from']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>現時持有</td>
                    <td><?if($stock['Holder']['name']){
                            echo h($stock['Holder']['name']);
                        }else{
                            echo "未借出";
                        }?>&nbsp;</td>
                </tr>

                <tr>
                    <td>Voucher No.</td>
                    <td><?php echo h($stock['Voucher']['code']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>Voucher Date</td>
                    <td><?php echo h($stock['Voucher']['voucher_date']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>Invoice No.</td>
                    <td><?php echo h($stock['Voucher']['invoice_no']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>Invoice Date</td>
                    <td><?php echo h($stock['Voucher']['invoice_date']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>Source of Fund</td>
                    <td><?php echo h($stock['Voucher']['source_of_fund']); ?>&nbsp;</td>
                </tr>


                </tbody>
            </table>


        </div>
    </div>
<!---->
<!---->
<!--<div class="panel">-->
<!--    <div class="panel-heading">-->
<!--        <span class="panel-title">-->
<!--            轉介資料-->
<!--        </span>-->
<!--        <div class="panel-heading-controls">-->
<!--            --><?php //echo $this->Html->link('<span class="btn-success"></span>'.__('新增'), array('action'=>'add_transfer',$member['Stock']['id']), array('escape'=>false, 'class'=>'btn btn-success')); ?>
<!--        </div>-->
<!--    </div>-->
<!--    <div class="panel-body">-->
<!--        --><?//if(empty($member['Transfer'])){
//            echo "沒有相關資料";
//
//        }else{?>
<!--            <div class="table-responsive">-->
<!--                <table class="table table-bordered table-striped">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th>轉介機構</th>-->
<!--                        <th>轉介社工</th>-->
<!--                        <th>個案編號</th>-->
<!--                        <th>行動</th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    --><?//foreach($member['Transfer'] as $transfer){?>
<!--                        <tr>-->
<!--                            <td>-->
<!--                                --><?//=h($transfer['transfer_unit_name'])?><!--<br>-->
<!--                                --><?//="類別: ".$unit_type[$transfer['transfer_unit_type']]?>
<!--                            </td>-->
<!--                            <td>--><?//=h($transfer['worker_name'])?>
<!--                            --><?//if($transfer['worker_contact']){
//                                echo "<br>轉介社工電話: ".$transfer['worker_contact'];
//                            }?>
<!---->
<!--                            --><?//if($transfer['worker_fax']){
//                                    echo "<br>傳真: ".$transfer['worker_fax'];
//                            }?>
<!--                            </td>-->
<!--                            <td>--><?//=($transfer['case_number'])?h($transfer['case_number']):"沒有資料"?><!--</td>-->
<!--                            <td>-->
<!--                                --><?php //echo $this->Html->link('<span class="btn-success"></span>'.__('修改'), array('action'=>'edit_transfer',$transfer['id']), array('escape'=>false, 'class'=>'btn btn-success')); ?>
<!--                                --><?php //echo $this->Form->postLink('<span class="btn-danger"></span>'.__('刪除'), array('action' => 'delete_transfer', $transfer['id']), array('class' => 'btn btn-danger', 'escape' => false), __('確定刪除嗎?'));?>
<!--                            </td>-->
<!--                        </tr>-->
<!--                    --><?//}?>
<!--                    </tbody>-->
<!--                </table>-->
<!--            </div>-->
<!--        --><?//}?>
<!--    </div>-->
<!--</div>-->


<script>
    function draw(){
        var index = 0;
        var allval = [];
        $('.chartpic:checked').each(function() {
            allval[index] = $(this).val();
            index++;
        });
        $.ajax({
            url: "<?=$this->Html->url(array('controller'=>"Stockpoints",'action'=>'chartresult', "ajax"=>1));?>",
            type: "POST",
            data: {info: allval},
            dataType: "Html"
        }).done(function (msg) {
                console.log(msg);
                $("#chartcontent").html(msg);
        });
    }

    $(document).ready(function () {

        $('.collapse').on('hide.bs.collapse', function () {
            $("#more").html("(查看更多)");
        });

        $('.collapse').on('show.bs.collapse', function () {
            $("#more").html("(縮小)");
        });

        $('body').on('hidden.bs.modal', '.modal', function () {
            $(this).removeData('bs.modal');
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });
        //
        // $('.bs-x-editable-points').editable({
        //     format: 'yyyy-mm-dd',
        //     viewformat: 'yyyy-mm-dd',
        //     datepicker: {
        //         weekStart: 1
        //     },
        //     success: function(response, newValue) {
        //         $("#dayinter").html(response);
        //     }
        // });

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

    });
</script>

