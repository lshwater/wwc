<?php $this->Html->script("barcode/jquery.scannerdetection.compatibility", array("inline"=>false)); ?>
<?php $this->Html->script('barcode/jquery.scannerdetection', array("inline"=>false)); ?>
<?php $this->Html->script('membercard', array("inline"=>false)); ?>

<div class="page-header">
    <div class="page-header">
        <div class="row">
            <!-- Page header, center on small screens -->
            <h1 class="col-xs-12 flashMessage">
                <i class="fa fa-search page-header-icon"></i>&nbsp;續借物品
            </h1>

        </div>
    </div>

    <div class="panel">
        <div class="panel-body">
            <?php echo $this->Form->create('Stock', array('class'=>'form', "id"=>"advserachform")); ?>

            <div class="form-group" id="member">
                <?php echo $this->Form->label("stockcard", __('配對物品'), 'col-sm-2 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input("stockcard", array('div'=>false, 'label'=>false, 'class'=>'form-control stockcard', "readonly"=>"readonly"));?>
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-danger" id="close" >退出</button>
                </div>
            </div>


            <?php echo $this->Form->end(); ?>
        </div>
    </div>

    <div class="alert alert-success" id="success" hidden>
  <span>
  </span>
    </div>

    <div class="alert alert-warning" id="alert" hidden>
  <span>
  </span>
    </div>



    <div id="memberadvwarning" class="modal modal-alert modal-warning fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="fa fa-warning"></i>
                </div>
                <div class="modal-title">結果</div>
                <div class="modal-body" id="memberadvwarning_msg">沒有記錄</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">OK</button>
                </div>
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>


    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-heading">
                    <h4><?php echo __('存取記錄'); ?></h4>
                </div>
                <div class="panel-body">
                    <div class="table-default">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables">
                            <thead>
                            <tr>
                                <th></th>
                                <th style="width:12%"><?php echo __('相片'); ?></th>
                                <th style="width:12%"><?php echo __('Fix Asset No.'); ?></th>
                                <th style="width:10%"><?php echo __('物品名稱'); ?></th>
                                <th style="width:20%"><?php echo __('職員名稱'); ?></th>
                                <th style="width:10%"><?php echo __('Unit'); ?></th>
                                <th style="width:15%">借出時間</th>
                                <th style="width:10%">預期歸還日</th>
                                <th><?=__('行動')?></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script>
        var resulttable1 = $('#resulttable1').DataTable(
            {
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
                "searching":false,
                "bPaginate": false
            }
        );

        var resulttable2 = $('#resulttable2').DataTable(
            {
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
                "searching":false,
                "bPaginate": false
            }
        );


        $( document ).on( "click", "a.openmodal", function(ev) {
            //alert("HI");
            ev.preventDefault();
            var target = $(this).attr("href");

            // load the url and show modal on success
            $("#modal .modal-content").load(target, function() {
                $('#modal .modalonly').show();
                $('#modal .modaloff').hide();
            });
        });

        $( document ).ready(function() {

            var user_id = "<?=$user_id?>";
            console.log(user_id);
            //phonemask($('.phonemask'));
            //var stock_id = "<?//=$stock['Stock']['id']?>//";
            var showwarning = <?=($showwarning)?1:0?>;
            var showsuccess = <?=($showsuccess)?1:0?>;

            if(showwarning == 1){
//            $("#memberadvwarning_msg").html("<?//=$errormsg;?>//");
//            $("#memberadvwarning").modal('show');

                $('#alert').html("<?=$errormsg;?>");
                $('#alert').show();
            }

            if(showsuccess == 1){
//            $("#memberadvwarning_msg").html("<?//=$errormsg;?>//");
//            $("#memberadvwarning").modal('show');

                $('#success').html("<?=$successmsg;?>");
                $('#success').show();
            }

            $.fn.clearForm = function() {
                return this.each(function() {
                    $("#membercode").unmask();

                    var type = this.type, tag = this.tagName.toLowerCase();
                    if (tag == 'form')
                        return $(':input',this).clearForm();
                    if (type == 'text' || type == 'password' || tag == 'textarea')
                        this.value = '';
                    else if (type == 'checkbox' || type == 'radio')
                        this.checked = false;
                    else if (tag == 'select')
                        this.selectedIndex = -1;

                    formatmask($("#membercode"), '<?=configure::read('Member.code_mask')?>');
                });
            };

            formatmask($("#membercode"), '<?=configure::read('Member.code_mask')?>');


//         $('#cancel').on('click',function(e){
//             e.preventDefault();
//             parentcard = 0;
//             $('#parent').show();
//             $('.parentcard').scannerdevice(
//                 {
//                     startNow: true,
//                     onAfterScan: function () {
// //                    advmembersearch();
//                         $('#advserachform').submit();
//                     }
//                 }
//             );
//             $('.parentcard').val('');
//             $('#member').hide();
//
//         });

            $('#close').on('click',function(e){
                e.preventDefault();
                window.close();
            });


            $('.stockcard').scannerdevice(
                {
                    startNow: true,
                    onAfterScan: function () {
//                    advmembersearch();
                        $('#advserachform').submit();
                    }
                }
            );



            $('#modal').on('hidden.bs.modal', function () {
                $('#modal').removeData('bs.modal')
            });

            $('#modal').on('loaded.bs.modal', function () {
                $('#modal .modalonly').show();
                $('#modal .modaloff').hide();
            });

            var table = $('#jq-datatables').dataTable({
//            buttons: [
//                'selectAll',
//                'selectNone'
//            ],
                select: true,
                dom: '<"top"<"toolbar">f<"clear">>rt<"bottom"lip<"clear">>',
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
                "order": [[ 5, "desc" ]],
                "bProcessing": true,
                "searching":false,
                "bServerSide": true,
                "sAjaxSource": "<?=$this->Html->url(array("controller"=>"attendances","action"=>"ajax_list"),true)?>",
                fnServerParams: function ( aoData ) {
                    aoData.push(
                        { "name": "date", "value": "<?=date('Y-m-d')?>" },
                        { "name": "user_id", "value": user_id },
                        { "name": 'reload', "value": 1}
                    );
                },

                "aoColumns": [
                    {mData:"id"},
                    {mData:"image"},
                    {mData:"fix_asset_no"},
                    {mData:"item_name"},
                    {mData:"user_name"},
                    {mData:"unit"},
                    {mData:"out_time"},
                    {mData:"expected_return_time"},
                    {mData:"action"}
                ],
                "fnRowCallback":function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {


                },
                "aoColumnDefs":[

                    {
                        "aTargets": [ 0 ],
                        bSortable: false,
                        bVisible: false
                    },
                ]
            } );

        });
    </script>