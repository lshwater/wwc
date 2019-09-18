<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-address-card page-header-icon"></i>&nbsp;&nbsp;<?=__("修改續會資料")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
            </div>
        </div>
    </div>
</div>
<ul class="breadcrumb">
    <li>
        <?echo $this->Html->link(__("返回"), "javascript:history.go(-1)");?>
    </li>
    <li class="active"><?=__("修改續會資料")?></li>
</ul>

<?php echo $this->Form->create('Membershiprecord', array('class'=>'panel validate_form preventDoubleSubmission', 'id'=>"form2submit")); ?>
<?php echo $this->Form->input('id'); ?>
<div class="row">
    <div class="col-sm-12">

        <div class="panel-heading">
            <span class="panel-title"><?php echo __('會藉資料'); ?></span>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->label('period', __('年期'), 'control-label required'); ?>
                        <?php echo $this->Form->input('period', array('div'=>false, 'label'=>false, 'class'=>'form-control membershipperiod', "default"=>$membertype['Membertype']['default_period'], "required"=>"required", "id"=>"periodinput", "min"=>1));?>

                    </div> <!-- / .form-group -->

                    <div style="display:none">
                        <?php echo $this->Form->input("period_d", array("default"=>365, "id"=>"period_d"));?>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo $this->Form->label('', __('會藉有效期'), 'control-label required'); ?>
                        <div class="input-daterange input-group datepicker-range">
                            <?php echo $this->Form->input('startdate', array('div'=>false, 'label'=>false, 'class'=>'form-control membershipperiod', 'required'=>'required', 'id'=>'startdate', 'placeholder'=>"開始日期", 'type'=>"text"));?>
                            <span class="input-group-addon"><?=__('至')?></span>
                            <?php echo $this->Form->input('enddate', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'required'=>'required', 'id'=>'enddate', 'placeholder'=>"最後日期", 'type'=>"text"));?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-footer text-right">
        <button type="button" onclick="$('#form2submit').submit();" class="btn btn-primary btn-block" ><i class="fa fa-check"></i><? echo ' '.__('Submit');?></button>
    </div>
</div>
<?php echo $this->Form->end(); ?>

<script>
    function cal_expect_expiry_date(){
        var org = $("#startdate").val();
        var period = $("#periodinput").val();
        period = parseInt(period);
        if(!period){
            period = 0;
        }
        if(org){
            var newdate = new Date(org);
            newdate.setFullYear(newdate.getFullYear() + period);

            var yyyy = newdate.getFullYear().toString();
            var mm = "2";
            var dd  = "31";
            $('#enddate').datepicker('setDate',  new Date(yyyy, mm, dd));
        }
        cal_membershipt_period_d();
    }

    function cal_membershipt_period_d(){
        var end = $("#enddate").val();
        var org = $("#startdate").val();

        if(end && org){

            moment().format();
            var startdate = moment(org);
            var enddate = moment(end);
            var diffDays = Math.ceil(enddate.diff(startdate, 'days'));

            $("#period_d").val(diffDays);
        }
    }

    function cal_membershipt_period(){
        var end = $("#enddate").val();
        var org = $("#startdate").val();

        if(end && org){

            moment().format();
            var startdate = moment(org);
            var enddate = moment(end);
            var diffDays = Math.ceil(enddate.diff(startdate, 'years', true));

            $("#periodinput").val(diffDays);
            cal_membershipt_period_d();
        }
    }

    $(document).ready(function() {
        var options2 = {
            autoclose: true,
            todayBtn: "linked",
            format: 'yyyy-mm-dd',
            orientation: $('body').hasClass('right-to-left') ? "auto right" : 'auto auto',
        };
        $('.datepicker-range').datepicker(options2);

        $('#startdate').datepicker()
            .on('hide', function(e){
                    cal_expect_expiry_date();
                }
            );

        $('#enddate').datepicker()
            .on('hide', function(e){
                    cal_membershipt_period();
                }
            );
        $("#periodinput").change(function(){
            cal_expect_expiry_date();
        });
    });
</script>
