<?php echo $this->Html->css('pages.min', array('inline'=>false)); ?>


<div class="signin-container">

    <!-- Left side -->
    <div class="signin-info">
        <span class="logo">
            CMRS
        </span> <!-- / .logo -->
    </div>
    <!-- / Left side -->
    <!-- Right side -->
    <div class="signin-form">
        <!-- Form -->
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('User', array('class'=>'form-signin allowentersubmit validate_form preventDoubleSubmission', 'autocomplete'=>'off')); ?>
        <div class="signin-text">
            <span>Sign In to your account</span>
        </div> <!-- / .signin-text -->

        <div class="form-group w-icon">
            <?php echo $this->Form->input('username', array('label'=>false, 'type'=>'text', 'div'=>false, 'id'=>'username_id' , 'class'=>'form-control input-lg', 'placeholder'=>__('Username'))); ?>
            <span class="fa fa-user signin-form-icon"></span>
        </div> <!-- / Username -->

        <div class="form-group w-icon">
            <?php echo $this->Form->input('password', array('label'=>false, 'type'=>'password', 'div'=>false, 'id'=>'password_id' , 'class'=>'form-control input-lg', 'placeholder'=>__('Password'))); ?>
            <span class="fa fa-lock signin-form-icon"></span>
        </div> <!-- / Password -->

        <div class="form-actions">
            <?
            echo $this->Form->submit(__('login'), array(
                'div' => false,
                'class' => 'signin-btn bg-primary',
            ));
            ?>
        </div> <!-- / .form-actions -->
        <?php echo $this->Form->end(); ?>
    </div> <!-- / Form -->
</div> <!-- / Container -->


<script type="text/javascript">
    // Resize BG
    init.push(function () {
        $("body").addClass("page-signin");
        var $ph  = $('#page-signin-bg'),
            $img = $ph.find('> img');

        $(window).on('resize', function () {
            $img.attr('style', '');
            if ($img.height() < $ph.height()) {
                $img.css({
                    height: '100%',
                    width: 'auto'
                });
            }
        });
    });

    // Show/Hide password reset form on click
    init.push(function () {
        $('#forgot-password-link').click(function () {
            $('#password-reset-form').fadeIn(400);
            return false;
        });
        $('#password-reset-form .close').click(function () {
            $('#password-reset-form').fadeOut(400);
            return false;
        });
    });

    // Setup Sign In form validation
    init.push(function () {
        $("#signin-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });

        // Validate username
        $("#username_id").rules("add", {
            required: true,
            minlength: 3
        });

        // Validate password
        $("#password_id").rules("add", {
            required: true,
            minlength: 6
        });
    });

    // Setup Password Reset form validation
    init.push(function () {
        $("#password-reset-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });

        // Validate email
        $("#p_email_id").rules("add", {
            required: true,
            email: true
        });
    });

</script>