<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">
            <i class="fa fa-user page-header-icon"></i>&nbsp;&nbsp;參加者資料
             <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </span>

    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <colgroup>
                    <col class="col-xs-3">
                    <col class="col-xs-5">
                </colgroup>
                <thead>
                <tr>
                    <th><?php echo __('table_content'); ?></th>
                    <th><?php echo __('table_details'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?
                    if($activityapplicant['Activityapplicant']['ismember']){
                ?>
                    <tr>
                        <td>會員編號</td>
                        <td><?php echo h($activityapplicant['Member']['code']); ?>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>會員類別</td>
                        <td><?php echo h($activityapplicant['Member']['Membertype']['name']); ?>&nbsp;</td>
                    </tr>
                <?
                    }
                ?>

                <tr>
                    <td>姓名(中)</td>
                    <td><?php echo h($activityapplicant['Activityapplicant']['c_name']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>姓名(英)</td>
                    <td><?php echo h($activityapplicant['Activityapplicant']['e_name']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>電話</td>
                    <td><?php echo h($activityapplicant['Activityapplicant']['tel']); ?>&nbsp;</td>
                </tr>
                <tr>
                    <td>費用</td>
                    <td>
                        $<?php echo money_format("%i", $activityapplicant['Activityapplicant']['cost']); ?>
                        <?php echo $this->Html->link("<i class='fa fa-search'></i>", array("controller"=>"Activityapplications", "action"=>"receipt", $activityapplicant['Activityapplicant']['activityapplication_id']), array("escape"=>false, "class"=>"openasnew"))?>
                    </td>
                </tr>
                <tr>
                    <td>備註</td>
                    <td>
                        <a href="#" id="remarks" data-type="textarea" data-pk="<?=$activityapplicant['Activityapplicant']['id']?>" data-placeholder="備註..." data-title="備註" class="editable editable-pre-wrapped editable-click" ><?php echo h($activityapplicant['Activityapplicant']['remarks']); ?></a>
                    </td>
                </tr>
                </tbody>
            </table>
            <p class="text-sm"># 如果不是會員，就沒有編號。</p>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        $('.editable').editable({
            url: '<?=$this->Html->url(array('action'=>'ajax_updateremarks'))?>'
        });
    });
</script>