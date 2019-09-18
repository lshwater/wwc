<?
if($sent){
    ?>
    <div class="panel panel-info">
        <div class="panel-heading">
            <span class="panel-title"><?=__('成功')?></span>
        </div>
        <div class="panel-body">
            <?=__('系統已成功發送訊息')?>
            <p class="text-xs"><?=__('視窗將會動關閉。')?></p>
        </div>
    </div>
    <script>
        //        opener.location.reload();
        setTimeout(function() {
            window.close();
        }, 5000);
    </script>
<?
}else{
?>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel widget-messages">
                <div class="panel-heading">
                    <span class="panel-title"><i class="panel-title-icon fa fa-envelope-o"></i><?=__('發出訊息')?> </span>
                </div> <!-- / .panel-heading -->
                <div class="panel-body">
                    <?php echo $this->Form->create('Message', array('class'=>'form-horizontal validate_form preventDoubleSubmission', "onsubmit"=>"return postForm()")); ?>
                    <?php echo  $this->Form->hidden('from_id', array('value'=>$auth['id']));?>
                    <?php echo $this->Form->hidden('from_name', array('value'=>$auth['name']));?>
                        <div class="row form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> <?=__('發送')?></button>
                            </div>
                        </div>
                        <div class="row form-group">
                            <?php echo $this->Form->label('Recipients', __('收件人'), 'col-sm-2 control-label'); ?>
                            <div class="col-sm-10 select2-primary">
                                <?php echo $this->Form->input('Recipients', array('div'=>false, 'label'=>false, "options"=>$recipients,'class'=>'select2-multiple form-control select2-offscreen', 'required'=>"required", 'multiple'=>'multiple', 'default'=>$userids));?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <?php echo $this->Form->label('title', __('標題'), 'col-sm-2 control-label'); ?>
                            <div class="col-sm-10">
                                <?php echo $this->Form->input('title', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'required'=>"required", 'default'=>h($title), "id"=>"title"));?>
                                <div id="character-limit-input-label" class="limiter-label form-group-margin"><?=__('剩餘字數: ')?><span class="limiter-count"></span></div>

                            </div>
                        </div>

                        <?php echo $this->Form->hidden('msg', array("id"=>"msg"));?>
                        <?php echo $this->Form->end(); ?>
                        <div class="row form-group">
                            <?php echo $this->Form->label('summernote', __('內容'), 'col-sm-2 control-label hidden'); ?>
                            <div class="col-sm-offset-2 col-sm-10">
                                <div id="summernote"><?=$defaultmsg?></div>
                            </div>
                        </div>


                </div> <!-- / .panel-body -->
            </div>
        </div>
    </div>

    <script>
        var postForm = function() {
            var content = $('#msg').val($('#summernote').code());
        }

        $(document).ready(function () {
            $('#summernote').summernote({
                height: 250,
                tabsize: 2,
                toolbar: [
                    ['style', ['style']], // no style button
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['picture', 'link']], // no insert buttons
                    ['table', ['table']], // no table button
                    ['help', ['help']] //no help button
                ]
            });
        });

        $.validator.addClassRules("vd_title", {
            required: true,
            maxLen: 1024
        });

        $("#title").limiter(1024, { label: '#character-limit-input-label' });
    </script>
<?}?>