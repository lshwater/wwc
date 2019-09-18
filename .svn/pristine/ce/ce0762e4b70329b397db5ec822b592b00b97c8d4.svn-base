<div class="signin-header">
    <a href="#" class="logo">
        <div class="demo-logo bg-primary">
            <? echo $this->Html->image('logo.png', array('alt' => 'Admin Page','style'=>'margin-top: -4px; width:30px;','class'=>'img-rounded')); ?>
        </div>&nbsp;
        <strong><?=__('Smart')?></strong><?=__('System')?>
    </a> <!-- / .logo -->
</div> <!-- / .header -->

<h1 class="form-header"><?=__('你必須是授權人士，否則請立刻離開。')?></h1>

<div class="row">
    <div class="col-md-12">
        <a id="btn" class="btn btn-primary btn-block btn-lg loginbtn" href="javascript:void(0)" onclick="signinbackend();">
            <?=__('登入系統 (後台)')?>
        </a>
    </div>

</div>
<br />
<!--<div class="row">-->
<!--    <div class="col-md-12">-->
<!--        <a id="btn" class="btn btn-primary btn-block btn-lg loginbtn" href="javascript:void(0)" onclick="">-->
<!--            --><?//=__('查會員')?>
<!--        </a>-->
<!--    </div>-->

</div>

<script type="text/javascript">
    function signinbackend(){
        window.open('<?=$this->Html->url(array("controller"=>"users", "action"=>"login"))?>','mms','toolbar=no, width=1366, height=768');
        $(".loginbtn").hide();
    }


    $(document).ready(function () {
        $("body").addClass("page-signin-alt");
    });
</script>
