<ul class="breadcrumb">
    <li>
        <?=$this->Html->link(" 站內公佈", array('action'=>"management"))?>
    </li>
    <li class="active">新增站內公佈</li>
</ul>

<div class="row">
    <div class="col-sm-12">
        <div class="panel widget-messages">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-pencil-square-o"></i> 新增站內公佈</span>
            </div> <!-- / .panel-heading -->
            <div class="panel-body">
                <?php echo $this->Form->create('Announcement', array('class'=>'form-horizontal validate_form preventDoubleSubmission', "onsubmit"=>"return postForm()")); ?>
                <?php echo $this->Form->hidden('from_id', array('value'=>$auth['id']));?>
                <form action="" class="new-mail-form form-horizontal">
                    <div class="row form-group">
                        <?php echo $this->Form->label('Group', __('收件人'), 'col-sm-2 control-label required'); ?>
                        <div class="col-sm-10 select2-primary">
                            <?php echo $this->Form->input('Group', array('div'=>false, 'label'=>false,'class'=>'select2-multiple form-control select2-offscreen', 'required'=>"required", 'multiple'=>'multiple'));?>
                        </div>
                    </div>

                    <div class="row form-group">
                        <?php echo $this->Form->label('title', __('標題'), 'col-sm-2 control-label required'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('title', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'required'=>"required", 'default'=>h($title), "id"=>"title"));?>
                            <div id="character-limit-input-label" class="limiter-label form-group-margin">Characters left: <span class="limiter-count"></span></div>

                        </div>
                    </div>

                    <div class="row form-group">
                        <?php echo $this->Form->label('needconfirm', __('須要確認'), 'col-sm-2 control-label'); ?>
                        <div class="col-sm-10">
                            <?php echo $this->Form->input('needconfirm', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'required'=>"required", 'default'=>h($title), "id"=>"title"));?>
                        </div>
                    </div>

                    <?php echo $this->Form->hidden('content', array("id"=>"content"));?>
                    <div class="row form-group">
                        <?php echo $this->Form->label('summernote', __('內容'), 'col-sm-2 control-label required'); ?>
                        <div class="col-sm-10">
                            <div id="summernote"><?=$defaultmsg?></div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">發送</button>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
            </div> <!-- / .panel-body -->
        </div>
    </div>
</div>

<script>
    var postForm = function() {
        var content = $('#content').val($('#summernote').code());
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