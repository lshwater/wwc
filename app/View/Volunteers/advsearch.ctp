<?php $this->Html->script("barcode/jquery.scannerdetection.compatibility", array("inline"=>false)); ?>
<?php $this->Html->script('barcode/jquery.scannerdetection', array("inline"=>false)); ?>
<?php $this->Html->script('membercard', array("inline"=>false)); ?>

<?
$volunteertypename = h($volunteertype['Volunteertype']['name']);
?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-search page-header-icon"></i>&nbsp;&nbsp;<?php echo $volunteertypename.__('搜尋'); ?>
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
    <div class="panel-heading">
        <span class="panel-title"><i class="fa fa-search page-header-icon"></i>&nbsp;&nbsp;</span>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Volunteer', array('class'=>'form', "id"=>"advserachform", "action"=>"ajax_matching")); ?>
        <?php echo $this->Form->hidden('Volunteertype', array('value'=>$volunteertype['Volunteertype']['id']));?>

        <div class="form-group">
            <?php echo $this->Form->label("membercard", __('智能証'), 'col-sm-3 control-label'); ?>
            <div class="col-sm-9">
                <?php echo $this->Form->input("membercard", array('div'=>false, 'label'=>false, 'class'=>'form-control smartcard', "readonly"=>"readonly"));?>
            </div>
        </div> <!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('code', __('編號'), 'col-sm-3 control-label'); ?>
            <div class="col-sm-9">
                <?php echo $this->Form->input('code', array('div'=>false, 'label'=>false, 'class'=>'form-control', "id"=>"volunteercode"));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('c_name', __('姓名(中)'), 'col-sm-3 control-label'); ?>
            <div class="col-sm-9">
                <?php echo $this->Form->input('c_name', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('e_name', __('姓名(英)'), 'col-sm-3 control-label'); ?>
            <div class="col-sm-9">
                <?php echo $this->Form->input('e_name', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?>
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
                <button type="button" class="btn btn-success btn-block" onclick="advsearch();" data-loading-text="Loading..." id="searchbtn"><i class="fa fa-search"></i>搜尋</button>                                </div>
        </div>
        <?php echo $this->Form->end(); ?>
        <!--                            !!!!!form-->
        <!--result-->
        <div class="row" id="resultdiv" style="display:none">
            <hr />
            <div class="panel-heading">
                結果
            </div>
            <div class="panel-body">
                <table class="table" id="resulttable">
                    <thead>
                    <tr>
                        <th>姓名(中)</th>
                        <th>姓名(英)</th>
                        <th>電話</th>
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
    var resulttable = $('#resulttable').DataTable();

    function advsearch(){
        $("#resultdiv").hide();
        $("#searchbtn").button("loading");
        resulttable.clear().draw();

        $.ajax({
            type: "POST",
            url: "<?=$this->Html->url(array("controller"=>"volunteers", 'action'=>'ajax_matching'))?>",
            data: $("#advserachform").serialize(),
            dataType: "json"
        })
        .done(function( msg ) {

            if(msg.result){
                $.each(msg.result, function( index, value ) {
                    resulttable.row.add( [
                        escapeHtml(value.Volunteer['c_name']),
                        escapeHtml(value.Volunteer['e_name']),
                        escapeHtml(value.Volunteer['phone_main']),
                        '<a href="<?=$this->Html->url(array("controller"=>"volunteers", 'action'=>'view', "ajax"=>true))?>/'+escapeHtml(value.Volunteer['id'])+'" class="btn btn-primary" data-toggle="modal" data-target="#modal" ><i class="fa fa-info"></i></a>'
                    ] ).draw( false );

                });
                $("#resultdiv").show();
                $(document).scrollTop( $("#resultdiv").offset().top );
            }else{
                $("#memberadvwarning_msg").html(msg.errormsg);
                $("#memberadvwarning").modal('show');
            }
        })
        .always(function(){
            $("#searchbtn").button("reset");
        });
    }

    $( document ).ready(function() {
        //phonemask($(".phonemask"));
        formatmask($("#volunteercode"), '<?=configure::read('Volunteer.format')?>');
        $('.smartcard').scannerdevice();

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('#modal.modalonly').show();
            $('#modal.modaloff').hide();
        });

    });
</script>