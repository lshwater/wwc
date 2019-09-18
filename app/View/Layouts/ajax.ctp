<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>

<?php echo $this->fetch('content'); ?>

<script>
    $(document).ready(function () {


//        $(document).on("click",".openasnew", function(e){
//            e.preventDefault(); // this will prevent the browser to redirect to the href
//            // if js is disabled nothing should change and the link will work normally
//            var url = $(this).attr('href');
//            var windowName = $(this).attr('id');
//            window.open(url,windowName,'toolbar=no, width=1280, height=800');
//        });

        $("input").attr("autocomplete", "off");

        $(document).on("keypress", 'form input', function (e) {

            if (!$(this).closest('form').hasClass('allowentersubmit')) {
                //alert($(this).attr("type"));
                var code = e.keyCode || e.which;
                if (code == 13) {
                    e.preventDefault();
                    return false;
                }
            }
        });

    });
</script>
