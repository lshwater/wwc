<div class="page-header">

    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12"><i class="fa fa-signal page-header-icon"></i>&nbsp;&nbsp;提款請求
        </h1>
    </div>
</div>
<div class="row">

    <div class="col-sm-1">
        選項
    </div>
    <div>
        <div class="col-sm-2">
            <?php
            $options = array(
                1=>"已退會",
                2=>'無效',
                3=>'有效'
            );
            echo $this->Form->input('狀態', array('div'=>false,'label'=>false,'class'=>'form-control required select2 allowClear','empty'=>true, "placeholder"=>__("狀態"), "id"=>"filter-status", 'options'=>$options)); ?>
        </div>

        <div class="col-sm-5">
            <?php
            $options = array(
                1=>array('name'=>'Payment Request','value'=>1,'locked'=>'locked'),
                2=>array('name'=>'Petty Cash','value'=>2,'locked'=>'locked'),
//                3=>array('name'=>'Payment Request','value'=>2,'locked'=>'locked'),
            );
            echo $this->Form->input('類別', array('div'=>false,'label'=>false,'class'=>'form-control required select2 allowClear','empty'=>true, "placeholder"=>__("狀態"), "id"=>"filter-status", 'options'=>$options, 'multiple'=>true)); ?>
        </div>
        <div class="col-sm-2">
            <?php
            $options = array(
                1=>"已退會",
                2=>'無效',
                3=>'有效'
            );
            echo $this->Form->input('狀態', array('div'=>false,'label'=>false,'class'=>'form-control required select2 allowClear','empty'=>true, "placeholder"=>__("項目"), "id"=>"filter-status", 'options'=>$options)); ?>
        </div>
        <div class="col-sm-2">
            <?=$this->Form->input('發起人', array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>true, "placeholder"=>__("發起人"), "id"=>"filter-status")); ?>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="table-default">
            <table cellspacing="0" class="table table-striped" id="resulttable" width="100%">
                <thead>
                    <tr>
                        <th style="width:15%">類別</th>
                        <th style="width:10%">負責職員</th>
                        <th style="width:20%">提交時間</th>
                        <th style="width:10%">狀態</th>
                        <th style="width:10%">金額</th>
                        <th style="width:20%">詳情</th>
                        <th style="width:20%">行動</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Petty Cash</td>
                        <td>黎志華</td>
                        <td>2019-08-26 16:20:31</td>
                        <td><span class="label label-success">通過2級批閱</span></td>
                        <td>$5000</td>
                        <td></td>
                        <td><span class="btn btn-sm btn-info">查看</span> <span class="btn btn-sm btn-danger">取消</span></td>
                    </tr>
                    <tr>
                        <td>Petty Cash</td>
                        <td>區振豪</td>
                        <td>2019-08-25 16:20:31</td>
                        <td><span class="label">等待批閱</span></td>
                        <td>$2000</td>
                        <td></td>
                        <td><span class="btn btn-sm btn-info">查看</span> <span class="btn btn-sm btn-danger">取消</span></td>
                    </tr
                    <tr>
                        <td>Payment Request</td>
                        <td>黎瑞芳</td>
                        <td>2019-08-20 14:20:53</td>
                        <td><span class="label label-success">可退款</span></td>
                        <td>$140</td>
                        <td>會費退款 - 會員編號 (#192371)</td>
                        <td><span class="btn btn-sm btn-info">查看</span> <span class="btn btn-sm btn-success">列印報表</span></td>
                    </tr>
                    <tr>
                        <td>Payment Request</td>
                        <td>周慧琛</td>
                        <td>2019-08-20 14:20:53</td>
                        <td><span class="label label-success">通過1級批閱</span></td>
                        <td>$3320</td>
                        <td>PO:PO100008<br>
                            供應商:XXX有限公司<br>
                            Invoice: #1191911238</td>
                        <td><span class="btn btn-sm btn-info">查看</span> <span class="btn btn-sm btn-danger">取消</span></td>
                    </tr>
                    <tr>
                        <td>Payment Request</td>
                        <td>周慧琛</td>
                        <td>2019-08-17 09:50:22</td>
                        <td><span class="label label-danger">拒絕批閱</span></td>
                        <td>$10210</td>
                        <td>PO:PO100009<br>供應商:XXX有限公司<br>Invoice: #1191919113</td>
                        <td><span class="btn btn-sm btn-info">查看</span></td>
                    </tr>
                    <tr>
                        <td>Payment Request</td>
                        <td>胡偉國</td>
                        <td>2019-08-15 11:05:13</td>
                        <td><span class="label label-success">可退款</span></td>
                        <td>$50</td>
                        <td>
                            班組退款 - 中國水墨畫 初班 (08/10/2019)
                        </td>
                        <td><span class="btn btn-sm btn-info">查看</span> <span class="btn btn-sm btn-success">列印報表</span></td>
                    </tr>
                </tbody>
            </table>
            <div class="bottom"><div class="dataTables_length" id="jq-datatables_length"><label>每頁顯示數目 <select name="jq-datatables_length" aria-controls="jq-datatables" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> </label></div><div class="dataTables_info" id="jq-datatables_info" role="status" aria-live="polite">顯示第 76 至 83 項結果，共 83 項 (從 94 項結果過濾)</div><div class="dataTables_paginate paging_simple_numbers" id="jq-datatables_paginate"><ul class="pagination"><li class="paginate_button previous" id="jq-datatables_previous"><a href="#" aria-controls="jq-datatables" data-dt-idx="0" tabindex="0">上頁</a></li><li class="paginate_button "><a href="#" aria-controls="jq-datatables" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="jq-datatables" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="jq-datatables" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button active"><a href="#" aria-controls="jq-datatables" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button next disabled" id="jq-datatables_next"><a href="#" aria-controls="jq-datatables" data-dt-idx="5" tabindex="0">下頁</a></li></ul></div><div class="clear"></div></div>
        </div>
    </div>

</div>