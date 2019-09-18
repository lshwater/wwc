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
<!--<ul class="breadcrumb">-->
<!--    <li>-->
<!--        --><?//=$this->Html->link(__("會員"), array("action"=>"index"))?>
<!--    </li>-->
<!--    <li class="active">--><?//=__("更新會員資料")?><!--</li>-->
<!--</ul>-->


<div class="row">
    <div class="col-sm-12">
        <?php echo $this->Form->create('Member', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>

        <div class="panel-heading">
            <span class="panel-title"><?php echo __('會員資料'); ?></span>
        </div>

        <div class="panel-body">
            <?php echo $this->Form->input('id'); ?>

            <div class="form-group">
                <?php echo $this->Form->label('membertype_id', __('會員類別*'), 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php
                    echo $this->Form->input('membertype_id', array(
                            'label'=>false,
                            'div'=>false,
                            'options'=>$membertypes,
                            'class'=>'form-control select2-multiple',
                            'required'=>true
                        )
                    );?>

                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('c_name', __('c_name'), 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('c_name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>__('c_name'), 'disabled'=>'disabled'));?>

                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('e_name_first', __('e_name_first')."*", 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('e_name_first', array('div'=>false, 'label'=>false, 'class'=>'form-control', "required"=>"required", 'placeholder'=>__('e_name_first'), 'disabled'=>'disabled'));?>

                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('e_name_last', __('e_name_last')."*", 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('e_name_last', array('div'=>false, 'label'=>false, 'class'=>'form-control', "required"=>"required", 'placeholder'=>__('e_name_last'), 'disabled'=>'disabled'));?>

                </div>
            </div> <!-- / .form-group -->
            <div class="form-group">
                <?php echo $this->Form->label('dob', __('newmember_title_7')."*", 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->input('dob', array('div'=>false, 'label'=>false, 'type'=>"text",'class'=>'form-control bs_datepicker', "required"=>"required", 'placeholder'=>__('newmember_title_7')));?>

                </div>
            </div> <!-- / .form-group -->

            <?

            if(!empty($memberinputfields)){
                foreach($memberinputfields as $key=>$fields){
                    if(!empty($fields['Selectionlist']['Selectionitem'])){
                        $list = Set::combine($fields['Selectionlist']['Selectionitem'], '{n}.id', '{n}.name');
                    }else{
                        $list = NULL;
                    }
                    ?>
                    <div class="form-group">
                        <?
                        if(!empty($this->data['MemberCustomField'][$key])){
                            echo $this->Form->hidden("MemberCustomField.{$key}.id", array('value'=>$this->data['MemberCustomField'][$key]['id']));
                        }
                        else{
                            echo $this->Form->hidden("MemberCustomField.{$key}.memberinputfield_id", array('value'=>$fields['Memberinputfield']['id']));
                        }


                        if($fields['Inputtype']['htmltype'] == "checkbox"){
                            ?>
                            <div class="col-sm-offset-2 col-sm-9">
                                <?php
                                    echo $this->Form->unlockField("MemberCustomField.{$key}.value");
                                    echo $this->Form->hidden("MemberCustomField.{$key}.value", array('value'=>0));
                                ?>
                                <div class="checkbox">
                                    <label>
                                        <?php echo $this->Form->input("MemberCustomField.{$key}.value", array('div'=>false, 'class'=>'px', 'type'=>'checkbox', 'label'=>false, 'hiddenField'=>false));?>
                                        <span class="lbl"><?=__($fields['Memberinputfield']['title'])?></span>
                                    </label>
                                </div>
                            </div>
                        <?

                        }else{

                            if(!$fields['Memberinputfield']['required']){
                                $required = "";
                            }
                            else{
                                $required = "required";
                            }


                            $class = "";

                            if(!empty($fields['Memberinputfield']['class'])){
                                $class .= " ".$fields['Memberinputfield']['class'];
                            }

                            echo $this->Form->label("MemberCustomField.{$key}.value", __($fields['Memberinputfield']['title']), 'col-sm-3 control-label');
                            ?>
                            <div class="col-sm-9">
                                <?
                                echo $this->Form->input("MemberCustomField.{$key}.value", array(
                                        'label'=>false,
                                        'div'=>false,
                                        'type'=>$fields['Inputtype']['htmltype'],
                                        'options'=>$list,
                                        'class'=>'form-control'.$class,
                                        'placeholder'=>__($fields['Memberinputfield']['placeholder']),
                                        'required'=>$required
                                    )
                                );
                                ?>
                            </div>
                        <?
                        }
                        ?>
                    </div>
                <?
                }
            }

            ?>

        </div>

        <div class="panel-heading">
            <span class="panel-title"><?=__('義工服務資料')?></span>
        </div>
        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('eventproposaltarget', __('希望服務對象'), 'col-sm-3 control-label'); ?>
                <div class="col-sm-9">
                    <?php echo $this->Form->select('Eventproposaltarget', $eventproposaltargets, array('div'=>false, 'label'=>false, 'class'=>'', 'required'=> 'required', 'multiple' => 'checkbox'));?>
                </div>
            </div> <!-- / .form-group -->

        </div>



        <div class="panel-heading">
<!--            <div class="col-xs-8">-->
                <?=__('會員關係')?>
<!--            <div>-->
            <div class="pull-right">
                <?php echo __('加入現有會員');?>
                <input type="text" id="in-between" />
                <? echo $this->Html->link('<button type="button" class="btn btn-sm btn-info" style="width: 30px;"><i class="fa fa-plus"></i></button>',
                    'javascript:void(0)',
                    array(
                        'id'=>'add_relatedmember',
                        'escape'=>false,
                    )
                );
                ?>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="related_member">
                <colgroup>
                    <col class="col-xs-1">
                    <col class="col-xs-2">
                    <col class="col-xs-4">
                    <col class="col-xs-2">
                </colgroup>
                <thead>
                <tr>
                    <th>#</th>
                    <th><?php echo __('相關會員編號'); ?></th>
                    <th><?php echo __('相關會員姓名'); ?></th>
                    <th><?php echo __('關係'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?
                $list_relationship = array($this->request->data['Member']['code']);

                foreach($relationship as $index=>$relation){
                    array_push($list_relationship, $relation['Relatedmember']['code']);

                    if (!empty($relation['Childmember'])){
                    ?>
                        <tr>
                            <td><span class="btn btn-sm btn-danger delete_row" id="delete_<?=$relation['Relatedmember']['code']?>"><i class="fa fa-close"></i></span></td>
                            <td><?php echo h($relation['Relatedmember']['code']) ?></td>
                            <td><?php echo h($relation['Relatedmember']['c_name'])." ".h($relation['Relatedmember']['e_name']) ?></td>
                            <?php echo $this->Form->hidden("Parentmember.{$index}.id", array('value'=>$relation['id']));?>
                            <?php echo $this->Form->hidden("Parentmember.{$index}.member_parent", array('value'=>$relation['member_parent']));?>
                            <?php echo $this->Form->hidden("Parentmember.{$index}.member_child", array('value'=>$relation['member_child']));?>
                            <td><?php echo $this->Form->input("Parentmember.{$index}.relationship_id", array('div'=>false, 'options'=>$relations, 'label'=>false, 'class'=>'form-control select2-multiple', 'escape'=>false, 'required'=>'required'));?></td>
                        </tr>
                    <?
                    }else{

                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo h($relation['Relatedmember']['code']) ?></td>
                        <td><?php echo h($relation['Relatedmember']['c_name'])." ".h($relation['Relatedmember']['e_name']) ?></td>
                        <td><?php echo __($relation['Memberrelation']['name']); ?>&nbsp;</td>
                    </tr>
                    <?
                    }
                }
                ?>
                </tbody>
            </table>
        </div>


        <div class="panel-footer text-right">
            <button type="submit" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>

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
//            console.log(list_relationship);
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
                        var row1 = '<tr>'+'<td class="col-sm-1"><span class="btn btn-sm btn-danger" id="delete_'+response['member']['Member']['code']+'"><i class="fa fa-close"></i></span></td>';
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


    });

</script>