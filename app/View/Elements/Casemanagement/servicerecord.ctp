<div class="widget-timeline-item">
    <div class="widget-timeline-info">
        <div class="widget-timeline-bullet"></div>
        <div class="widget-timeline-time bg-success"><?echo h($timeline['date']);?></div>
    </div>

    <div class="panel panel-success">
        <div class="panel-title"> <i class="fa fa-file-word-o"></i>
            <?=h($timeline['form_name'])?>
            <?=$this->Html->link('<span class="btn btn-sm btn-warning">更新</span>', array("controller"=>$timeline['form_controller'], "action"=>"edit", $timeline['case_id'], $timeline['form_id'], 'ajax'=>true), array("class"=>"", "escape"=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal'));?>&nbsp;&nbsp;
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th width="20%">接觸類別</th>
                    <td><?=$servicerecordtypes[$timeline['form_content']['servicerecordtype_id']]?></td>
                </tr>
                <tr>
                    <th width="20%">開始時間</th>
                    <td><?=$timeline['form_content']['date']." ".$timeline['form_content']['start_time']?></td>
                </tr>
                <tr>
                    <th width="20%">始束時間</th>
                    <td><?=$timeline['form_content']['date']." ".$timeline['form_content']['end_time']?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>