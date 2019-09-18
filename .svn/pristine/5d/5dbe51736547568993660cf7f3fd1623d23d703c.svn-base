
<?echo $this->Html->css('bootstrap-datetimepicker.min');?>
<?echo $this->Html->script('bootstrap-datetimepicker.min');?>

<ul class="breadcrumb">
    <li>
        <?=$this->Html->link('Preview', array("action"=>"preview", $type['Customtype']['id']));?>
    </li>
    <li class="active"><?=$type['Customtype']['type_oname']?> Layout</li>
</ul>




<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <?php echo $this->element('Customlayout/layout_builder'); ?>
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

	$(document).ready(function() {
        // Multiselect
        $(".select2-multiple").select2({
        });
        validate_form();

        $('#modal').on('hidden.bs.modal', function () {
            $('#modal').removeData('bs.modal')
        });

        $('#modal').on('loaded.bs.modal', function () {
            $('.modalonly').show();
            $('.modaloff').hide();
        });

<!--        --><?//
//
//        if(!empty($timestamp)){
//            foreach($timestamp as $counter=>$item){
//                $format = "YYYY-MM-DD";
//                if($item['type'] == 'datetime'){
//                    $format = "YYYY-MM-DD HH:mm";
//                }
//                ?>
//                console.log('<?//=$item['id']?>//');
//                $('#<?//=$item['id']?>//').datetimepicker({
//                    format:"<?//=$format?>//"
//                });
//                <?//
//            }
//        }
//        ?>

	});

</script>
