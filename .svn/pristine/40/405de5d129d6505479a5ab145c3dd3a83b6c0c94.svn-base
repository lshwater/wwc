<?php $this->Html->script("barcode/jquery.scannerdetection.compatibility", array("inline"=>false)); ?>
<?php $this->Html->script('barcode/jquery.scannerdetection', array("inline"=>false)); ?>
<?php $this->Html->script('membercard', array("inline"=>false)); ?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-search page-header-icon"></i>&nbsp;&nbsp;會員快速搜尋
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
            </div>
        </div>
    </div>
</div>

<div class="panel">
    <div class="panel-body">
        <?php echo $this->Form->create('Member', array('class'=>'form', "id"=>"advserachform", "action"=>"ajax_checkinfo")); ?>

        <div class="form-group">
            <?php echo $this->Form->label("membercard", __('會員卡'), 'col-sm-3 control-label'); ?>
            <div class="col-sm-9">
                <?php echo $this->Form->input("membercard", array('div'=>false, 'label'=>false, 'class'=>'form-control membercard', "readonly"=>"readonly"));?>
            </div>
        </div> <!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('code', __('會員編號'), 'col-sm-3 control-label'); ?>
            <div class="col-sm-9">
                <?php echo $this->Form->input('code', array('div'=>false, 'label'=>false, 'class'=>'form-control', "id"=>"membercode"));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('c_name', __('姓名(中)'), 'col-sm-3 control-label'); ?>
            <div class="col-sm-9">
                <?php echo $this->Form->input('c_name', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('e_name', __('姓名(英文)'), 'col-sm-3 control-label'); ?>
            <div class="col-sm-9">
                <?php echo $this->Form->input('e_name', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('identity', __('身份証明文件'), 'col-sm-3 control-label'); ?>
            <div class="col-sm-9">
                <?php echo $this->Form->input('identity', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'type'=>'text'));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('phone_main', __('電話(主要)'), 'col-sm-3 control-label'); ?>
            <div class="col-sm-9">
                <?php echo $this->Form->input('phone_main', array('div'=>false, 'label'=>false, 'class'=>'form-control phonemask'));?>
            </div>
        </div> <!-- / .form-group -->
        <br />
        <div class="row">
            <div class="col-xs-12">
                <button type="button" class="btn btn-success btn-block" onclick="advmembersearch();" data-loading-text="Loading..." id="membersearchbtn"><i class="fa fa-search"></i>搜尋</button>                                </div>
        </div>
        <?php echo $this->Form->end(); ?>
        <!--                            !!!!!form-->
        <!--result-->
        <div class="row" id="memberresult" style="display:none">
            <hr />
            <div class="panel-heading">
                結果
            </div>
            <div class="panel-body">
                <div class="table-default">
                    <table class="table" id="resulttable">
                        <thead>
                        <tr>
                            <th>會員編號</th>
                            <th>姓名</th>
                            <th>身份証/出世紙號碼</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="advserachresult">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
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

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    var resulttable = $('#resulttable').DataTable(
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
            }
        }
    );

    function advmembersearch(){
        $("#memberresult").hide();
        $("#membersearchbtn").button("loading");
        resulttable.clear().draw();

        $.ajax({
            type: "POST",
            url: "<?=$this->Html->url(array("controller"=>"members", 'action'=>'ajax_checkinfo'))?>",
            data: $("#advserachform").serialize(),
            dataType: "json"
        })
            .done(function( msg ) {
                if(msg.result){
                    $.each(msg.result, function( index, value ) {
                        resulttable.row.add( [
                            escapeHtml(value.Member['code']),
                            escapeHtml(value.Member['e_name'])+"<br />"+escapeHtml(value.Member['c_name']),
                            escapeHtml(value.Member['identity']),
                            '<a href="<?=$this->Html->url(array("controller"=>"members", 'action'=>'view', "ajax"=>true))?>/'+escapeHtml(value.Member['id'])+'" class="btn btn-primary" data-toggle="modal" data-target="#modal" ><i class="fa fa-info"></i></a>'
                        ]).draw( false );
                    });

                    $("#memberresult").show();
                    $(document).scrollTop( $("#memberresult").offset().top );
                }else{
                    $("#memberadvwarning_msg").html(msg.errormsg);
                    $("#memberadvwarning").modal('show');
                }
            })
            .always(function(){
                $("#membersearchbtn").button("reset");
                $("#advserachform").clearForm();
            });
    }
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
        //phonemask($('.phonemask'));

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
        $('.membercard').scannerdevice(
            {
                onAfterScan: function(){
                    advmembersearch();
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

    });
</script>