<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-user page-header-icon"></i>&nbsp;&nbsp;<?=__("我的帳戶")?>
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
        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <tbody>
                <tr>
                    <td width="30%"><?php echo __('帳號編號'); ?></td>
                    <td><?php echo h($user['User']['code']); ?>&nbsp;</td></tr>
                <tr><td><?php echo __('服務單位'); ?></td>
                    <td>
                        <?if(!empty($user['Unit'])){
                            $comma = "";
                           foreach($user['Unit'] as $unit){
                               echo $comma.$unit['name'];
                               $comma= ", ";
                           }
                        }?>
                    </td></tr>
                <tr><td><?php echo __('權限'); ?></td>
                    <td>
                        <?if(!empty($user['Group'])){
                            $comma = "";
                            foreach($user['Group'] as $g){
                                echo $comma.$g['title'];
                                $comma= ", ";
                            }
                        }?>
                    </td></tr>
                <tr><td><?php echo __('帳號'); ?></td>
                    <td><?php echo h($user['User']['username']); ?>&nbsp;</td></tr>
                <tr><td><?php echo __('密碼最後更新日期'); ?></td>
                    <td><?php echo h($user['UsersPassword'][0]['created']); ?>&nbsp;</td></tr>
                </tbody>
            </table>
        </div>

<!--        <div class="panel-heading">-->
<!--            <p>--><?php // echo __('Horn 應用程式設定'); ?><!--</0>-->
<!--        </div>-->
<!--        --><?php //echo $this->Form->create('User', array('class'=>'form-horizontal validate_form', "action"=>"updatehorn", "id"=>"hornform")); ?>
<!--        <div class="panel-body">-->
<!--            <table class="table">-->
<!--                <tbody>-->
<!--                    <tr>-->
<!--                        <td width="30%">帳號</td>-->
<!--                        <td>-->
<!--                            --><?php //echo $this->Form->input('horn_clientid', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?><!--&nbsp;-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td width="30%">推送最新通知</td>-->
<!--                        <td>-->
<!--                            --><?php //echo $this->Form->input('horn_pushnotifications', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?><!--&nbsp;-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td width="30%">推送最新訊息</td>-->
<!--                        <td>-->
<!--                            --><?php //echo $this->Form->input('horn_pushmessages', array('div'=>false, 'label'=>false, 'class'=>'form-control'));?><!--&nbsp;-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                <tbody>-->
<!--            </table>-->
<!--            <a href="javascript:void(0)" class="btn btn-primary btn-block" id="updatehorn"><i class="glyphicon glyphicon-ok-sign"></i>--><?// echo ' '.__('更改 Horn 設定');?><!--</a>-->
<!--        </div>-->
<!--        --><?php //echo $this->Form->end(); ?>
    </div>
</div>

<script>
    $(document).ready(function() {

        $('#updatehorn').click(function(){
            $(this).button("loading");
            $.ajax({
                type: "POST",
                url: "<?=$this->Html->url(array("controller"=>"Users", 'action'=>'updatehorn'))?>",
                data: $("#hornform").serialize(),
                dataType: "json"
            })
            .done(function( msg ) {
                if(msg.result){
                    $.growl.notice({ title: "成功", message: "匯入成功" });
                }else{
                    $.growl.error({ title: "失敗", message: msg.msg });
                }
            })
            .always(function(){
//                    console.log("HI");
                $("#updatehorn").button("reset");
            });
        });
    });
</script>


