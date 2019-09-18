<div class="row">
    <div class="col-sm-12">
        <div class="modal-header">
            <span class="modal-title"><?=__('個案評估')?></span>
            <button type="button" class="close modalonly" data-dismiss="modal" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>
        <div class="modal-body">

            <table class="table table-bordered table-striped">
                <colgroup>
                    <col class="col-xs-3">
                    <col class="col-xs-5">
                </colgroup>
                <thead>
                <tr>
                    <th><?php echo __('table_content'); ?></th>
                    <th><?php echo __('table_details'); ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo __('類別'); ?></td>
                    <td><?php echo h($form['Servicerecord']['type']); ?></td>
                </tr>
                <tr>
                    <td><?php echo __('會面日期'); ?></td>
                    <td><?php echo h($form['Servicerecord']['date']); ?></td>
                </tr>
                <tr>
                    <td><?php echo __('會面地點'); ?></td>
                    <td><?php echo h($form['Servicerecord']['place']); ?></td>
                </tr>
                <tr>
                    <td><?php echo __('會面備注'); ?></td>
                    <td><?php echo h($form['Servicerecord']['remark']); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

    $(document).ready(function() {

        $(".select2_modal").select2({
            allowClear: true
        });

        validate_form();

        $('.vd_isnumber').

        $('._datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayBtn: "linked",
            startDate:'<?=$case['Casemanagement']['dateofapproval']?>',
            endDate: "+0d"
        });
    });
</script>