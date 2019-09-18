<?php $this->Html->script("barcode/jquery.scannerdetection.compatibility", array("inline"=>true)); ?>
<?php $this->Html->script('barcode/jquery.scannerdetection', array("inline"=>true)); ?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">選擇會員</h4>
</div>
<div class="modal-body">
    <div class="row">

        <div class="col-md-2">
            <div class="input-group">
            <?php echo $this->Form->input('membercard', array(
                    'div'=>false, 'label'=>false,
                    'class'=>'form-control filterauto',
                    'id'=>"filter-membercard",
                    'placeholder'=>__("會員卡")
                )
            ); ?>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default" style="font-size: 13px;"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            <div class="input-group">
            <?php echo $this->Form->input('code', array(
                    'div'=>false, 'label'=>false,
                    'class'=>'form-control filterauto',
                    'id'=>"filter-code",
                    'placeholder'=>__("會藉編號")
                )
            ); ?>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default" style="font-size: 13px;"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            <div class="input-group">
            <?php echo $this->Form->input('displayname', array(
                    'div'=>false, 'label'=>false,
                    'class'=>'form-control filterauto',
                    'id'=>"filter-displayname",
                    'placeholder'=>__("姓名")
                )
            ); ?>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default" style="font-size: 13px;"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-3">
            <div class="input-group">
                <?php echo $this->Form->input('identity', array(
                        'div'=>false, 'label'=>false,
                        'class'=>'form-control filterauto',
                        'id'=>"filter-identity",
                        'placeholder'=>__("身份証明號碼")
                    )
                ); ?>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default" style="font-size: 13px;"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>

        <div class="col-md-2">
            <div class="input-group">
            <?php echo $this->Form->input('tel', array(
                    'div'=>false, 'label'=>false,
                    'class'=>'form-control filterauto',
                    'id'=>"filter-tel",
                    'placeholder'=>__("電話號碼")
                )
            ); ?>
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default" style="font-size: 13px;"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </div>

    </div>
    <hr/>
    <table class="table table-striped table-bordered table-condensed table-hover font-size-13" id="datatables" width="100%">
        <thead>
        <tr>
            <th nowrap><?php echo __('姓名'); ?></th>
            <th nowrap>身份証</th>
            <th nowrap>性別</th>
            <th nowrap>電話(住宅)</th>
            <th nowrap>電話(手提)</th>
            <th nowrap><?php echo __('會藉'); ?></th>
            <th nowrap><?=__('Actions')?></th>
        </tr>
        </thead>
        <tbody>

        </tbody>

    </table>
</div>

<script>
    $(document).ready(function() {
        var table = table = $('#datatables').dataTable({
            dom: '<"top"<"toolbar"><"clear">>rt<"bottom"lip<"clear">>',

            columnDefs: [
                {
                    className: 'control',
                    orderable: false,
                    targets:   1
                },
                {
                    className: 'control',
                    orderable: false,
                    targets:   2
                },
                {
                    className: 'control',
                    orderable: false,
                    targets:   3
                },
                {
                    className: 'control',
                    orderable: false,
                    targets:   4
                },
                {
                    className: 'control',
                    orderable: false,
                    targets:   5
                },
                {
                    className: 'control',
                    orderable: false,
                    targets:   6
                }

            ],
            order: [ 0, 'asc' ],
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
            },
            "bProcessing": true,
            "searching":true,
            "bServerSide": true,
            "sAjaxSource": "<?=(!$membership_mode)?$this->Html->url(array("action"=>"ajax_newmembershiplist")):$this->Html->url(array("controller"=>"memberships", "action"=>"ajax_membershiplist"))?>",
            fnServerParams: function ( aoData ) {
                aoData.push(
                    { "name": "code", "value": $("#filter-code").val() } ,
                    { "name": "name", "value": $("#filter-displayname").val() } ,
                    { "name": "tel", "value": $("#filter-tel").val() } ,
                    { "name": "identity", "value": $("#filter-identity").val() } ,
                    { "name": "membercard", "value": $("#filter-membercard").val() } ,
                );
            },

            "aoColumns": [
                {mData:"displayname"},
                {mData:"identity"},
                {mData:"gender"},
                {mData:"contact_tel_home"},
                {mData:"contact_tel_mobile"},
                {mData:"membership"},
                {mData:"action"}
            ],
        });

        $("body").scannerDetection({
            //preventDefault:true
        });

        $("body").bind('scannerDetectionComplete',function(e,data){
           $("#filter-membercard").val(data.string);
            table.fnDraw();
        });


        $("#filter-membercard").on("keyup", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });
        $("#filter-code").on("keyup", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });
        $("#filter-displayname").on("keyup", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });
        $("#filter-tel").on("keyup", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });
        $("#filter-identity").on("keyup", function() {
            table.fnDraw();  // In your case this would be 'tblOrders.fnDraw();'
        });
    });
</script>