<ul class="breadcrumb">
    <li>
        <?=$this->Html->link("返回", $redirecturl)?>
    </li>
    <li class="active">查看公佈</li>
</ul>
<?if($announcement['Announcement']['needconfirm'] && empty($announcement['AnnouncementUser']) && $userneedconfirm){?>
<div class="panel panel-warning">
    <div class="panel-heading">
        <span class="panel-title"> 公佈需要確認</span>
        <div class="panel-heading-controls">
            <?php echo $this->Form->postLink('<i class="fa fa-check"></i> 我已閱讀', array("action"=>"readconfirm", $announcement['Announcement']['id'], 'redirect'=>urlencode($this->Html->url(null, true))), array('escape'=>false, "class"=>"btn btn-warning class")); ?>

        </div>
    </div>
</div>
<?}?>

<div class="panel">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <span class="panel-title">
           <?=h($announcement['Announcement']['title'])?>
        </span>
        <?
        if($announcement['Announcement']['needconfirm'] && $isadmin){
        ?>
        <span class="panel-heading-controls">
            <?=$this->Html->link(' <i class="fa fa-bar-chart text-default"></i>', array("javascript:void(0);"), array("escape"=>false, "data-toggle"=>"modal", "data-target"=>"#analyst"))?>
        </span>
        <?
        }
        ?>
        <div class="row">
            <div class="col-xs-12 text-default">
                <em>
                    由 <em><?=h($announcement['Fromuser']['name'])?></em> 發佈
                    <?echo $this->Time->timeAgoInWords($announcement['Announcement']['created'],  array(
                        'format' => __('time_format'),
//                        'format' => 'F jS, Y',
                        'accuracy' => array('hour' => 'hour'),
                        'end' => '2 hour'
                    ));?>
                </em>
            </div>
        </div>
    </div>
    <!-- Table -->
    <table class="table table-responsive">

        <tr>
            <td>
                <div class="panel-padding">
                    <?=$announcement['Announcement']['content']?>
                </div>

            </td>
        </tr>
    </table>
</div>

<div id="analyst" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-bar-chart text-default"></i> 閱讀統計</h4>
            </div>
            <div class="modal-body">
                <table cellpadding="0" cellspacing="0" border="0" class="table">
                    <tr>
                        <th>職員</th>
                        <th>確認時間</th>
                    </tr>
                    <?
                        if(!empty($alluser)){
                            foreach($alluser as $k=>$usr){
                                if($analyst[$k]){
                                    $checklb = '<i class="fa fa-check text-success"></i> ';
                                    $ctime = $analyst[$k];
                                }else{
                                    $checklb = $ctime = "";
                                }
                    ?>
                                <tr>
                                    <td><?=$checklb.h($usr)?></td>
                                    <td><?=h($ctime)?></td>
                                </tr>
                    <?
                            }
                        }
                    ?>
                </table>
            </div> <!-- / .modal-body -->
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('img').addClass('img-responsive');

    });
</script>
