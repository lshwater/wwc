<?
echo $this->Html->css('ladda-themeless.min', array('inline' => false));
echo $this->Html->script('spin.min', array("inline"=>false));
echo $this->Html->script('ladda.min', array("inline"=>false));
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel widget-messages">
            <div class="panel-heading">
                <span class="panel-title"><i class="panel-title-icon fa fa-bullhorn"></i>通知</span>
                <div class="panel-heading-controls">
                    <ul class="pagination pagination-xs">
                        <?php echo $this->Paginator->prev('« ', array('tag'=>"li"), null, array('style' => 'display:none'));?>
                        <?php echo $this->Paginator->numbers(array('separator' => '', 'tag'=>"li", 'currentTag'=>"a", "currentClass"=>"active"));?>
                        <?php echo $this->Paginator->next(' »', array('tag'=>"li"), null, array('style' => 'display:none'));?>
                    </ul> <!-- / .pagination -->
                </div>
            </div> <!-- / .panel-heading -->
            <div class="panel-body">
                <?
                foreach($notifications as $notice){
                    if($notice['Recipient']['read'])
                    {
                        $unread = "";
                    }else{
                        $unread = "unread";
                    }

                ?>
                    <div class="message <?=$unread?>">
                        <div class="action-checkbox text-default">
                            <button class="btn btn-outline btn-danger btn-xs ladda-button delmsgbtn" data-style="zoom-in" data-spinner-color="#000" data-size="xs" data-id="<?=h($notice['Recipient']['id'])?>"><i class="fa fa-times"></i></button>
                        </div>
                        <a href="#" title="" class="from">&nbsp;<?=$notice['Notification']['from_name']?></a>
                        <?php echo $this->Html->link(h($notice['Notification']['title']), array('action' => 'view', $notice['Notification']['id'], 'ajax'=>true, 'redirect'=>urlencode($this->Html->url(null, true))), array('escape' => false, "class"=>"title msglink", 'data-toggle'=>"modal", 'data-target'=>'#modal', 'data-backdrop'=>"static")); ?>
                        <div class="date" style="width:200px">
                            <?=date(__('time_format'), strtotime($notice['Notification']['created']))?>
                        </div>
                    </div> <!-- / .message -->
                <?
                }
                ?>
            </div> <!-- / .panel-body -->
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(document).ready(function () {
        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

        $(".delmsgbtn").on("click", function(e){
            e.preventDefault();
            var obj = $(this);
            var _id = obj.attr("data-id");
            var l = Ladda.create(this);
            l.start();

            $.ajax({
                type: "POST",
                url: "<?=$this->Html->url(array("controller"=>"notifications", 'action'=>'delete'))?>/"+_id,
                dataType: 'json'
            })
            .done(function (data) {
                    if(data){
                        obj.closest(".message").remove();
                    }
                    else{
                        l.stop();
                        alert("刪除失敗");
                    }
            });
        });

        $(".msglink").on("click", function(){
            $(this).closest(".message").removeClass("unread");
        });
    });
</script>