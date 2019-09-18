<?

//Configure::write('debug', 2);
//debug($relationship);
?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-users page-header-icon"></i>&nbsp;&nbsp;<?=__("更新會員資料")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
            </div>
        </div>
    </div>
</div>
<ul class="breadcrumb">
    <li>
        <?echo $this->Html->link(__("返回"), "javascript:history.go(-1)");?>
    </li>
    <li class="active"><?=__("更新會員資料")?></li>
</ul>

<?php echo $this->Form->create('Member', array('class'=>'panel validate_form preventDoubleSubmission', 'id'=>"form2submit")); ?>
<?php echo $this->Form->input('id'); ?>
<div class="row">
    <div class="col-sm-12">

        <div class="panel-heading">
            <span class="panel-title"><?php echo __('會員資料'); ?></span>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('c_name', __('newmember_title_5'), 'control-label'); ?>
                        <?php echo $this->Form->input('c_name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('c_name')));?>
                    </div> <!-- / .form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('e_name', __('姓名(英)'), 'control-label required'); ?>
                        <?php echo $this->Form->input('e_name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'required'=>"required", 'placeholder'=>__('e_name_first')));?>
                    </div> <!-- / .form-group -->
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('gender', __('性別'), 'control-label required'); ?>
                        <?php echo $this->Form->input('gender', array('div'=>false, 'label'=>false, 'class'=>'form-control select2', "required"=>"required", 'empty'=>true, 'options'=>$genders, 'placeholder'=>__('性別')));?>
                    </div> <!-- / .form-group -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('identitytype_id', __('身份証明文件'), 'control-label required'); ?>
                        <?php
                        if(!empty($member)){?>
                            <p class="form-control-static">  <?=$member['Identitytype']['name']?></p>
                        <?}else{
                            echo $this->Form->input('identitytype_id', array('div'=>false, 'label'=>false,'class'=>'form-control select2 isselect2' ,"required"=>"required", "id"=>"identitytypeID"));
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('identity', __('身份証明文件號碼'), 'control-label required'); ?>
                        <div class="input-group">
                            <?php
                            if(!empty($member)){?>
                                <p class="form-control-static">  <?=$member['Member']['identity']?></p>
                            <?}else{
                                echo $this->Form->input('identity', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control vd_identity', 'id'=>"identity", "required"=>"required", 'placeholder'=>__('身份証明文件號碼')));
                                ?>
                                <span class="input-group-btn" id="HKIDcheckbtndiv">
                                  <a href="javascript:void(0)" data-hkid="identity" class="btn btn-block btn-primary checkhkidbtn">認証</a>
                            </span>
                            <?}?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <?php echo $this->Form->label('dob', __('newmember_title_7'), 'control-label required'); ?>
                        <?php echo $this->Form->input('dob', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control bs_datepicker', "required"=>"required", 'placeholder'=>__('YYYY-MM-DD')));?>

                    </div> <!-- / .form-group -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->label('contact_tel_home', __('電話(住宅)'), 'control-label'); ?>
                        <?php echo $this->Form->input('contact_tel_home', array('div'=>false, 'label'=>false,'class'=>'form-control'));?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->label('contact_tel_mobile', __('電話(手提)'), 'control-label'); ?>
                        <?php echo $this->Form->input('contact_tel_mobile', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control'));?>

                    </div> <!-- / .form-group -->
                </div>
            </div>

        </div>

        <?if($layout){?>
            <div class="panel-heading">
                <span class="panel-title"><?php echo __('會員(更多資料)'); ?></span>
            </div>

            <?php echo $this->element('Customtype/form_builder_group'); ?>
        <?}?>


        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary btn-block" ><i class="fa fa-check"></i><? echo ' '.__('Submit');?></button>
        </div>

    </div>
</div>
<?php echo $this->Form->end(); ?>

<!-- Success -->
<div id="hkidok" class="modal modal-alert modal-success fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-check-circle"></i>
            </div>
            <div class="modal-title">香港身份証認証</div>
            <div class="modal-body">正確</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->
<!-- / Success -->

<!-- Danger -->
<div id="hkidfail" class="modal modal-alert modal-danger fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-times-circle"></i>
            </div>
            <div class="modal-title">香港身份証認証</div>
            <div class="modal-body">不正確</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
            </div>
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div> <!-- / .modal -->
<!-- / Danger -->

<script>

    $(document).ready(function() {

        var list_relationship = JSON.parse('<?php echo json_encode($list_relationship);?>');
        var index = list_relationship.length;

        $("form").submit(function() {
            $(this).children('#in-between').remove();
        });

        validate_form();

        $(".select2-multiple").select2({
        });

        $.validator.addClassRules("vd_usernameremote", {
            remote: {
                url:"<?=$this->Html->url(array('action'=>'ajax_checkunique'));?>",
                type:"post",
                data:{
                    field: 'username',
                    value: function() {
                        return $("#username").val();
                    },
                    recordid: '<?=$this->data['Member']['id']?>'
                }
            }
        });

        $.validator.addClassRules("vd_code", {
            remote: {
                url:"<?=$this->Html->url(array('action'=>'ajax_checkunique'));?>",
                type:"post",
                data:{
                    field: 'code',
                    value: function() {
                        return $("#code").val();
                    },
                    recordid: '<?=$this->data['Member']['id']?>'
                }
            }
        });

        $('.delete_row').bind( "click", function() {
            list_relationship[$.inArray((this.id).slice(7),list_relationship)] = null;
            $(this).closest('tr').remove();
        });


        $('#add_relatedmember').on('click', function () {
            $.ajax({
                type: "POST",
                url: '<?=$this->Html->url(array('controller'=>'Members', 'action'=>'checkinfo_extend'));?>',
                data: {code: $('#in-between').val() },
                dataType: 'json',
                success: function(response){
                    if (response.status == "success") {
                        if ($.inArray(response['member']['Member']['code'], list_relationship)>=0){
                            alert("<?=__("已加入會員")?>");
                            return;
                        }
                        index++;
                        //water ==== 2016-06-14
                        var row1 = '<tr>'+'<td class="col-sm-1"><span class="btn btn-sm btn-danger delete_row" id="delete_'+response['member']['Member']['code']+'"><i class="fa fa-close"></i></span></td>';
                        //water ==== 2016-06-14
                        var row2 = '<td>'+ escapeHtml(response['member']['Member']['code']) + '</td>';
                        var row3 = '<td>'+ escapeHtml(response['member']['Member']['c_name']) +' '+escapeHtml(response['member']['Member']['e_name'])+'</td>';
                        var test1 = '<?php
                        $select = $this->Form->input('Parentmember.existingmemberindex.relationship_id', array('div'=>false, 'options'=>$relations, 'label'=>false, 'class'=>'form-control select2-multiple', 'escape'=>false, 'required'=>'required'));
                        echo preg_replace( "/\r|\n/", "", $select );
                        ?>';
                        var row4 = '<td>'+ test1.replace("existingmemberindex", index) + '</td>';
                        var row5 = '<input type="hidden" name="data[Parentmember]['+index+'][member_parent]" value="<?=$this->request->data['Member']['id']?>" />' + '</tr>';
                        var row6 = '<input type="hidden" name="data[Parentmember]['+index+'][member_child]" value="'+response['member']['Member']['id']+'" />' + '</tr>';
                        list_relationship.push(response['member']['Member']['code']);

                        var row = row1+row2+row3+row4+row5+row6;
                        $('#related_member').append(row);

                        $('.select2-multiple').select2();
                        $('.delete_row').bind( "click", function() {
                            list_relationship[$.inArray((this.id).slice(7),list_relationship)] = null;
                            $(this).closest('tr').remove();
                        });
                    }
                    else {
                        alert(response.status);
                    }
                },
                fail: function(response){
                    alert(response);
                }
            })

        });

        $(".checkhkidbtn").click(function(){
            var targetid = $(this).attr('data-hkid');
            $(".checkhkidbtn").button('loading');
            $.ajax({
                type: "POST",
                url: "<?=$this->Html->url(array("controller"=>"members", 'action'=>'ajax_checkidentity'))?>",
                data: {
                    hkid: $("#"+targetid).val()
                },
                dataType: "json"
            })
                .done(function( msg ) {
                    if(msg){
                        $("#hkidok").modal('show');
                    }else{
                        $("#hkidfail").modal('show');
                    }
                })
                .always(function(){
                    $(".checkhkidbtn").button("reset");
                });
        });
        formatmask($("#in-between"), '<?=configure::read('Member.code_mask')?>');

    });

</script>