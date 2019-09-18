<script>
    bootbox.dialog({
        message: "<?=h($cutoffdatemsg)?>",
        title: "注意",
        className: "bootbox-sm",
        closeButton: false,
        buttons: {
            danger: {
                label: "確認",
                className: "btn-warning",
                callback: function() {

                }
            }
        }
    });


    // Wait while page is scrolling
    setTimeout(function () {

        var options = {
            type: 'warning',
            namespace: 'pa_page_alerts_default'
        };
        PixelAdmin.plugins.alerts.add('<?=h($cutoffdatemsg)?>', options);
    }, 800);
</script>