<div class="page-header">
    <h1 class="doc-header"><?php  echo __('view').__('user').__('detail'); ?></h1>
</div>

<ul class="breadcrumb">
    <li>
        <?=$this->Html->link(__("職員清單"), array("action"=>"index"))?>
    </li>
    <li class="active"><?php  echo __('view').__('user').__('detail'); ?></li>
</ul>

<div class="row">
    <div class="col-xs-12">
        <?php
        if($user['User']['id'] != $auth['id'] && $user['User']['readonly'] != 1 && $auth['allow_action']['user']['modify']){
            echo $this->Html->link(__('<span class="glyphicon glyphicon-pencil"></span> ').__('edit').__('user'), array('action' => 'edit', $user['User']['id']),array('class'=>"btn btn-warning", 'escape' => false));
        } ?>
        <?php if($user['User']['id'] != $auth['id'] && $user['User']['readonly'] != 1){
            echo $this->Html->link(__('<span class="glyphicon glyphicon-repeat"></span> ').__('重設').__('password'), array('action' => 'resetpassword', $user['User']['id']),array('class'=>"btn btn-default", 'escape' => false));
        } ?>
        <?php
        if($user['User']['id'] != $auth['id'] && $user['User']['readonly'] != 1 && $auth['allow_action']['user']['inactive']){
            if($user['User']['active']){
                echo $this->Form->postLink(__('<span class="fa fa-stop"></span> ').__('suspend').__('account'), array('action' => 'inactive', $user['User']['id']),array('class'=>"btn btn-danger", 'escape' => false), __('confirm').__('suspend').__('this').__('account').'？');

            }
            else{
                echo $this->Form->postLink(__('<span class="fa fa-plus"></span> ').__('activate').__('account'), array('action' => 'active', $user['User']['id']),array('class'=>"btn btn-success", 'escape' => false), __('confirm').__('activate').__('this').__('account').'？');
            }
        }
        ?>
    </div>
    &nbsp;
</div>

<div class="row">
    <div class="col-xs-12">
        <table class="table table-striped table-bordered">
            <tbody>

            <tr>
                <td width="30%"><?php echo __('user').__('code'); ?></td>
                <td><?php echo h($user['User']['code']); ?>&nbsp;</td></tr>
            <tr><td><?php echo __('unit'); ?></td>
                <td><?php
                    echo $user['Unit']['name'];
                    ?></td></tr>
            <tr><td>系統權限</td>
                <td><?php echo h($user['Group'][0]['title']); ?>&nbsp;</td></tr>
            <tr><td>職級</td>
                <td><?php echo h($user['User']['ranking']); ?>&nbsp;</td></tr>
            <tr><td>管理單位</td>
                <td>
                    <?php
                    $camma = "";
                    foreach($user['Viewunit'] as $_u){
                        echo $camma.h($_u['name']);
                        $camma = ", ";
                    }

                    ?>&nbsp;
                </td></tr>
            <tr><td><?php echo __('username'); ?></td>
                <td><?php echo h($user['User']['username']); ?>&nbsp;</td></tr>
            <tr><td><?php echo __('user').__('name'); ?></td>
                <td><?php echo h($user['User']['name']); ?>&nbsp;</td></tr>
            <tr><td>簽名</td>
                <td><?php echo h($user['User']['signature']); ?>&nbsp;</td></tr>
            <!--              <tr><td>--><?php //echo __('phone'); ?><!--</td>-->
            <!--              <td>--><?php //echo h($user['User']['phone']); ?><!--&nbsp;</td></tr>-->
            <tr><td><?php echo __('email'); ?></td>
                <td><?php echo h($user['User']['email']); ?>&nbsp;</td></tr>
            <tr><td><?php echo __('remark'); ?></td>
                <td><?php echo h($user['User']['remark']); ?>&nbsp;</td></tr>
            <tr><td><?php echo __('password').__('last_update_time'); ?></td>
                <td><?php echo h($user['UsersPassword'][0]['created']); ?>&nbsp;</td></tr>
            <tr><td><?php echo __('生效中'); ?></td>
                <td><?php  if($user['User']['active']){
                        echo "✔";
                    } ?>&nbsp;
                </td></tr>
            </tbody>
        </table>
    </div>
</div>


