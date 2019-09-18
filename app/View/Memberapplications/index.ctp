
<?
//Configure::write('debug', 2);
////
//debug($memberapplications); exit();
?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-users page-header-icon"></i>&nbsp;&nbsp;<?=__("會藉列表")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">

        <div class="row">
            <div class="col-sm-2">
                <?=__('有效會藉')?>
            </div>
            <div class="col-sm-2">
                <div id="filter-active"> </div>
            </div>
            <div class="col-sm-2">
                <?=__('會藉類別')?>
            </div>
            <div class="col-sm-2">
                <div id="filter-type"> </div>
            </div>
        </div>
        <div class="row padding-sm-vr">
            <div class="col-sm-2">
                <?=__('以會員編號搜尋')?>
            </div>
            <div class="col-sm-10">
                <?php echo $this->Form->input('code', array('placeholder'=>__('會員編號'),'div'=>false, 'id'=>'member_code','label'=>false));?>
                <span class="btn btn-sm btn-success modalbtn" id="btn_searchbymember"><i class="fa fa-search"></i></span>
            </div>
        </div>

        <div class="table-default">
            <table cellspacing="0" class="table table-striped nowrap"  id="jq-datatables" width="100%">
                <thead>
                <tr>
                    <th></th>
                    <th><?=__('記錄編號')?></th>
                    <th><?=__('續會方式')?></th>
                    <th><?=__('主會藉申請人')?></th>
                    <th><?=__('會藉日期')?></th>
                    <th><?=__('統計日期')?></th>
                    <th><?=__('有效')?></th>
                    <th><?=__('Actions')?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($memberapplications as $memberapplication): ?>
                    <tr>
                        <td></td>
                        <td><?php echo h($memberapplication['Memberapplication']['code']);?></td>
                        <td><?php echo h($memberapplication['Memberapplicationtype']['name']); ?></td>
                        <td><?php echo h($memberapplication['Mainmember']['c_name']); ?>&nbsp;<?php echo h($memberapplication['Mainmember']['e_name']); ?></td>
                        <td><?php echo h($memberapplication['Memberapplication']['startdate']); ?> - <?php echo h($memberapplication['Memberapplication']['enddate']); ?></td>
                        <td><?php
                            if($memberapplication['Memberapplication']['report_date']){
                                echo h($memberapplication['Memberapplication']['report_date']);
                            }else{
                                echo "不適用";
                            }
                        ?>
                        </td>
                        <td><?php
                            if (!$memberapplication['Memberapplication']['valid']) {
                                echo __("已作廢");
                            } else {
                                if($memberapplication['Memberapplication']['active']){
                                    echo __("有效");
                                }else{
                                    echo __("已過期");
                                }
                            }
                            ?>
                        </td>
                        <td class="actions">
                            <?php echo $this->Html->link('<button class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-info"></i></button>', array('action' => 'view', $memberapplication['Memberapplication']['id']), array('escape'=>false));  ?>
                            <?
                            $c_msg = '';
                            if ($memberapplication['Memberapplication']['active'] && $memberapplication['Memberapplication']['valid'] && $this->Cutoffdate->check($memberapplication['Memberapplication']['created'], $c_msg)) {
                                echo $this->Html->link('<button class="btn btn-sm btn-warning" style="width: 30px;"><i class="fa fa-undo"></i></button>', array('action' => 'rollback', $memberapplication['Memberapplication']['id'], 'ajax'=>true), array('class'=>'modalbtn', 'escape'=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal_view', 'data-backdrop'=>"static"));
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>

        <!-- /5. $DEFAULT_TABLES -->

    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal_view">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modal_error">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel">
                <div class="panel-heading">
                    <?php echo __('會藉搜尋'); ?>
                    <button type="button" class="close modalonly" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                </div>
                <div class="panel-body" id="error_message">
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="modal_searchbymember">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--            <div class="panel">-->
            <div class="modal-header">
                <?php echo __('會藉搜尋'); ?>
                <button type="button" class="close modalonly" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body" >
                <div class="table">
                    <table class="table table-bordered table-striped" width="100%" id="result_searchbymember">
                        <thead>
                        <tr>
                            <th></th>
                            <th><?=__('記錄編號')?></th>
                            <th><?=__('續會方式')?></th>
                            <th><?=__('主會藉申請人')?></th>
                            <th><?=__('會藉日期')?></th>
                            <th><?=__('統計日期')?></th>
<!--                            <th>--><?//=__('有效')?><!--</th>-->
<!--                            <th>--><?//=__('Actions')?><!--</th>-->
                        </tr>
                        </thead>
                        <tbody id="table_searchbymember">
                        </tbody>
                    </table>
                </div>
            </div>
            <!--        </div>-->
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>


        $(document).ready(function () {

            formatmask($("#member_code"), '<?=configure::read('Member.code_mask')?>');

            var result_searchbymember=$('#result_searchbymember').DataTable({
                searching: false,
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
                }
            });
            var table = $('#jq-datatables').DataTable({
                responsive: {
                    details: {
                        type: 'column',
                        target: 'tr'
                    }
                },
                columnDefs: [ {
                    className: 'control',
                    orderable: false,
                    targets:   0
                } ],
                order: [ 0, 'desc' ],

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
                deferRender: true,
                initComplete: function () {
                    this.api().column(6).each( function () {
                        var column = this;
                        var select = $('<select class="form-control select2-multiple"><option value=""></option></select>')
                            .appendTo( $('#filter-active').empty() )
                            .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                }
                            );
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+ d +'">'+d+'</option>' )
                        } );
                    } );

                    this.api().column(2).each( function () {
                        var column = this;
                        var select = $('<select class="form-control select2-multiple"><option value=""></option></select>')
                            .appendTo( $('#filter-type').empty() )
                            .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                        .search( val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                }
                            );
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+ d +'">'+d+'</option>' )
                        } );
                    } );
                    $(".select2-multiple").select2({
                        allowClear: true
                    });
                }
            });

            $('#jq-datatables_wrapper .table-caption').text('<?=__('members_index_table_title')?>');
            $('#jq-datatables_wrapper .dataTables_filter input').attr('placeholder', '<?=__('members_index_table_placeholder')?>');

            $('.active-switcher').switcher({
                on_state_content: 'ON',
                off_state_content: 'OFF'
            });

            $('#btn_searchbymember').click(function () {
                $('#error_message').empty();
                result_searchbymember.clear().draw();

                $.ajax({
                    type: "POST",
                    url: '<?=$this->Html->url(array('action'=>'ajax_searchbymember'))?>',
                    data: {member_code: $('#member_code').val()},
                    dataType: 'json'
                })
                    .done(function (data) {
                        if (!data.errormsg) {
                            console.log(data);
                            $('#modal_searchbymember').modal();

                            $('#modal_searchbymember').on('shown.bs.modal', function (e) {
                                result_searchbymember.clear();
                                for (var i =0;i <data.result.length;i++){
                                    var row =[
                                        escapeHtml(data.result[i]['code']),
                                        escapeHtml(data.result[i]['Memberapplicationtype']['name']),
                                        escapeHtml(data.result[i]['Mainmember']['c_name']) + "<br/> " + escapeHtml(data.result[i]['Mainmember']['e_name']),
                                        data.result[i]['startdate'],
                                        data.result[i]['enddate'],
                                        (data.result[i]['valid'])? "<?=__('有效')?>":"<?=__('已作廢')?>"
                                    ];
                                    result_searchbymember.row.add(row).draw();
                                }
                            })

                        }
                        else {
                            var div = document.createElement('div');
                            div.setAttribute('class', 'alert alert-danger');
                            div.innerText=data.errormsg;
                            $('#error_message').append(div);
                            $('#modal_error').modal();
                        }

                    })
                    .fail(function () {
                        var div = document.createElement('div');
                        div.setAttribute('class', 'alert alert-danger');
                        div.innerText="<?=__('錯誤！')?>";
                        $('#error_message').append(div);
                        $('#modal_error').modal();
                    });
            });

            $('#modal_view').on('hidden.bs.modal', function () {
                $('#modal_view').removeData();
            });

            $('#modal_searchbymember').on('hidden.bs.modal', function () {
                $('#modal_searchbymember').removeData();
            });

            $('#modal_error').on('hidden.bs.modal', function () {
                $('#modal_error').removeData();
            });

            $('#modal_view').on('loaded.bs.modal', function () {
                $('.modalonly').show();
                $('.modaloff').hide();
            });

        });
    </script>