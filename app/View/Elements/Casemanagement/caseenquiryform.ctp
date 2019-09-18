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
                    <th width="20%">求助者/家人表達之問題及要求之協助</th>
                    <td><?=$this->Text->autoParagraph($timeline['form_content']['enquiry'])?></td>
                </tr>
                <?if($timeline['form_content']['followup']){?>
                    <tr>
                        <th width="20%">建議跟進項目</th>
                        <td><?=$this->Text->autoParagraph($timeline['form_content']['followup'])?></td>
                    </tr>
                <?}?>
                </tbody>
            </table>
        </div>
    </div>
</div>