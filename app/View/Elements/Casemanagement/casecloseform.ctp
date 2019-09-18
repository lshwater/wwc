<div class="widget-timeline-item">
    <div class="widget-timeline-info">
        <div class="widget-timeline-bullet"></div>
        <div class="widget-timeline-time bg-danger"><?echo h($timeline['date']);?></div>
    </div>

    <div class="panel panel-danger">
        <div class="panel-title"> <i class="fa fa-file-word-o"></i>
            <?=h($timeline['form_name'])?>
<!--            --><?//=$this->Html->link('<span class="btn btn-sm btn-warning">更新</span>', array("controller"=>$timeline['form_controller'], "action"=>"edit", $timeline['case_id'], $timeline['form_id'], 'ajax'=>true), array("class"=>"", "escape"=>false, 'data-toggle'=>"modal", 'data-target'=>'#modal'));?><!--&nbsp;&nbsp;-->
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th width="20%">結案總結</th>
                    <td><?=$caseclosereasons[$timeline['form_content']['caseclosereason_id']]?></td>
                </tr>
                <?if($timeline['form_content']['case_referral_agency']){?>
                    <tr>
                        <th width="20%">已轉介</th>
                        <td><?=$timeline['form_content']['case_referral_agency']?></td>
                    </tr>
                <?}?>
                <?if($timeline['form_content']['other_specify']){?>
                    <tr>
                        <th width="20%">其他</th>
                        <td><?=$timeline['form_content']['other_specify']?></td>
                    </tr>
                <?}?>

                <?if($timeline['form_content']['caseowner_remark']){?>
                    <tr>
                        <th width="20%">案主意願</th>
                        <td><?=$timeline['form_content']['caseowner_remark']?></td>
                    </tr>
                <?}?>

                <?if($timeline['form_content']['followup']){?>
                    <tr>
                        <th width="20%">服務建議</th>
                        <td><?=$this->Text->autoParagraph($timeline['form_content']['followup'])?></td>
                    </tr>
                <?}?>
                <?if($timeline['form_content']['remark']){?>
                    <tr>
                        <th width="20%">督導評語</th>
                        <td><?=$this->Text->autoParagraph($timeline['form_content']['remark'])?></td>
                    </tr>
                <?}?>
                </tbody>
            </table>
        </div>
    </div>
</div>