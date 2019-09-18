<div class="row">
    <div class="col-sm-12">
        <div class="panel-heading">
            <span class="panel-title"><?php echo __('學生同步'); ?></span>
        </div>

        <div>
           <div class="panel-body">
               <?=$this->Html->link('<i class="glyphicon glyphicon-ok-sign"></i> '.__('現在同步'), array("action"=>"dosync"),array('class'=>'btn btn-primary btn-block', 'type'=>'submit', 'escape'=>false))?>
           </div>
        </div>


    </div>
</div>