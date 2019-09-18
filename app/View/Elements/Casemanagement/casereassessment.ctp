<div class="widget-timeline-item">
    <div class="widget-timeline-info">
        <div class="widget-timeline-bullet"></div>
        <div class="widget-timeline-time bg-success"><?echo h($timeline['date']);?></div>
    </div>

    <div class="panel panel-success">
        <div class="panel-title"> <i class="fa fa-file-word-o"></i>
            <?=h($timeline['form_name'])?>
<!--            --><?//=$this->Html->link('<span class="btn btn-sm btn-warning">更新</span>', array("controller"=>$timeline['form_controller'], "action"=>"edit", $timeline['case_id'], $timeline['form_id'], 'ajax'=>true), array("class"=>"", "escape"=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal'));?><!--&nbsp;&nbsp;-->
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th width="20%">個案類別</th>
                    <td><?=$casetypes[$timeline['form_content']['casetype_id']]?></td>
                </tr>
                <tr>
                    <th width="20%">個案性質</th>
                    <td><?=$casenatures[$timeline['form_content']['casenature_id']]?></td>
                </tr>
                <?if($timeline['form_content']['nextreviewdate']){?>
                <tr>
                    <th width="20%">下次重檢日期</th>
                    <td><?=$timeline['form_content']['nextreviewdate']?></td>
                </tr>
                <?}?>
                <tr>
                    <th width="20%">目標</th>
                    <td><?=$this->Text->autoParagraph($timeline['form_content']['target'])?></td>
                </tr>

                <?if($timeline['form_content']['followup']){?>
                    <tr>
                        <th width="20%">督導評語</th>
                        <td><?=$this->Text->autoParagraph($timeline['form_content']['followup'])?></td>
                    </tr>
                <?}?>
                </tbody>
            </table>
        </div>
    </div>
</div>