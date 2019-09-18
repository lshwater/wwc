<ul class="breadcrumb modaloff">
    <li>
        <?=$this->Html->link("通知", array("controller"=>"Notifications","action"=>"index"))?>
    </li>
    <li class="active"><?=h($notification['Notification']['title'])?></li>
</ul>

<div class="panel">
    <div class="panel-heading">
        <span class="panel-title">
            <i class="fa fa-envelope-o page-header-icon"></i>&nbsp;&nbsp;<?=h($notification['Notification']['title'])?>
             <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </span>


    </div>
    <div class="panel-body">
        <?=$this->Text->autoParagraph($this->Text->autoLink($notification['Notification']['msg']))?>
        <div class="text-right text-dark-gray-gray">
<!--            --><?//=h($notification['Notification']['created'])?>
            <?=date(__('time_format'), strtotime($notification['Notification']['created']))?>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {

    });
</script>