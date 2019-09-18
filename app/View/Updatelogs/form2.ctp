<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-users page-header-icon"></i>&nbsp;&nbsp;<?=__("Update Log")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
                <!-- "Create project" button, width=auto on desktops -->
                <div class="pull-right col-xs-12 col-sm-auto">
<!--                    --><?php //echo $this->Html->link('<span class="btn-label icon fa fa-print"></span>'.__('Export Smart Card'), array("action"=>"export", 'ajax'=>true), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled', 'data-toggle'=>"modal", 'data-target'=>'#modal')); ?>
<!--                    --><?php //echo $this->Html->link('<span class="btn-label icon fa fa-print"></span>'.__('Export Address Label'), array("action"=>"exportaddrlabel", 'ajax'=>true), array('escape'=>false, 'class'=>'btn btn-primary btn-labeled', 'data-toggle'=>"modal", 'data-target'=>'#modal')); ?>
                </div>

                <!-- Margin -->
                <div class="visible-xs clearfix form-group-margin"></div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <?php echo $this->Form->create('Buyitem', array('class'=>'panel form-horizontal validate_form')); ?>
    <? echo $this->Form->hidden('id');?>
    <div class="panel-heading">
        <span class="panel-title">個案服務諮詢表</span>
        <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only"><?=__('Close')?></span></button>
    </div>

    <div class="panel-body">
        <div class="form-group">
            <?php echo $this->Form->label('name', "服務編號: ", 'col-sm-2 control-label'); ?>
            <div class="col-sm-6">
                <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false,'class'=>'form-control select2', 'placeholder'=>''));
                ?>
            </div>
            <?php echo $this->Form->label('expiry', "接觸日期: ", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('expiry', array('div'=>false, 'label'=>false, 'class'=>'form-control datepicker', 'readonly'=>'readonly', 'placeholder'=>'日期', /*'required'=>'required'*/));
                ?>
            </div>
        </div> <!-- / .form-group -->

        <div class="panel-body">
            <div class="form-group">
                <?php echo $this->Form->label('name', "服務編號: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-6">
                    <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false,'class'=>'form-control select2', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('expiry', "接觸日期: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('expiry', array('div'=>false, 'label'=>false, 'class'=>'form-control datepicker', 'readonly'=>'readonly', 'placeholder'=>'日期', /*'required'=>'required'*/));
                    ?>
                </div>
            </div> <!-- / .form-group -->

        <div>
            <span class="panel-title">I. 個人資料 </span>
            <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only"><?=__('Close')?></span></button>
        </div>

        <div class="form-group">
            <?php echo $this->Form->label('name', "姓名: ", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'中文'));
                ?></div>
            <div class="col-sm-2">
            <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'英文'));
            ?></div>
                <?php echo $this->Form->label('name', "性別: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>  男</div><div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   女</div>
                </div>
            </div>
           </div><!-- / .form-group -->


        <div class="form-group">
            <?php echo $this->Form->label('name', "身份證號碼: ", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                ?>
            </div>
            <?php echo $this->Form->label('expiry', "出生日期: ", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('expiry', array('div'=>false, 'label'=>false, 'class'=>'form-control datepicker', 'readonly'=>'readonly', 'placeholder'=>'日期', /*'required'=>'required'*/));
                ?>
            </div>
            <?php echo $this->Form->label('name', "年齡: ", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                ?>
            </div>
        </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "地址: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-4">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('name', "電話: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-4">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
            </div><!-- / .form-group -->


            <div class="form-group">
                <?php echo $this->Form->label('name', "地址: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-4">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('name', "電話: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-4">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "地址: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-6">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('name', "電話: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', '居住狀況:', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   獨居</div>
                    </div>
                </div>
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10"> <div class="row">
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   與子女共住</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   與孫共住</div>
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   與外傭共住</div>
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   與外傭共住</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他</div>
                        </div>
                </div>
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                    ?></div>
                    </div>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   獨居</div>
                    </div>
                </div>
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10"> <div class="row">
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   與子女共住</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   與孫共住</div>
                    </div>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   獨居</div>
                    </div>
                </div>
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10"> <div class="row">
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   與子女共住</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   與孫共住</div>
                    </div>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   獨居</div>
                    </div>
                </div></div><!-- / .form-group -->

                <div class="form-group">
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他
                            <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?></div>
                    </div>
                </div></div><!-- / .form-group -->

                <div class="form-group">
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他
                            <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?></div>
                    </div>
                </div></div><!-- / .form-group -->

                <div class="form-group">
            <?php echo $this->Form->label('name', "婚姻狀況:", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   未婚</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   已婚</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   分居/離婚</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   鰥/寡</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   同居</div>
                </div>
        </div>
        </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', '居住狀況:', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   獨居</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   與子女共住</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   與孫共住</div>
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   與外傭共住</div>
                    </div>
                </div>
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他
                            <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?></div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他
                            <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?></div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他
                            <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?></div>
                    </div>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   獨居</div>
                    </div>
                </div>
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10"> <div class="row">
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   與子女共住</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   與孫共住</div>
                    </div>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   獨居</div>
                    </div>
                </div>
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10"> <div class="row">
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   與子女共住</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   與孫共住</div>
                    </div>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "婚姻狀況:", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   未婚</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   已婚</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   分居/離婚</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   鰥/寡</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   同居</div>
                    </div>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', '居住狀況:', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   a
                            <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?></div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   b
                            <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?></div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   c
                            <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?></div>
                    </div>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                    <?php echo $this->Form->label('name', '居住狀況:', 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   獨居</div>
                            <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   與配偶共住</div>
                            <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   與子女共住</div>
                            <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   與孫共住</div>
                        </div>
                    </div>
                    <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10"> <div class="row">
                            <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   與外傭共住</div>
                            <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他
                                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                                ?></div>
                            </div>
                    </div>
                    </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "姓名: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('name', "電話: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('name', "關係: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "姓名: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('name', "電話: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('name', "關係: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
            </div> <!-- / .form-group -->

<?//xxxzxzxzxzxzxzxzxzxxzxzxzxzxzxxz?>

            <div class="col-sm-12">
                <span class="panel-title">   II. aaaa</span>
                <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only"><?=__('Close')?></span></button>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10"> <div class="row">

                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他
                            </div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他
                            </div>
                    </div>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "非本人諮詢", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   未婚</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   已婚</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   分居/離婚</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   鰥/寡</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   同居</div>
                    </div>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "aaaa", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                        ?>
                    </div>
                </div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "", 'col-sm-2 control-label'); ?>
                <div class="col-sm-6">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('name', "電話: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "", 'col-sm-2 control-label'); ?>
                <div class="col-sm-6">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('name', "電話: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "", 'col-sm-2 control-label'); ?>
                <div class="col-sm-4">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('name', "電話: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-4">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "aaaa", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                        ?>
                    </div>
                </div>
            </div><!-- / .form-group -->









            <div class="form-group">
            <?php echo $this->Form->label('name', "非本人諮詢", 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>
            </div>
        </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "姓名: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('name', "電話: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
                <?php echo $this->Form->label('name', "關係: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "來源: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-2">
                    <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
            </div> <!-- / .form-group -->


            <div class="col-sm-12">
                <span class="panel-title">   II. 求助者/家人表達之問題及要求之協助</span>
                <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only"><?=__('Close')?></span></button>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('name', "", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <? echo $this->Form->textarea('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
            </div> <!-- / .form-group -->

            <div class="col-sm-12">
                <span class="panel-title">  III. 評估結果（可選多項）</span>
                <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only"><?=__('Close')?></span></button>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('name', "開案: ", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>
                </div>
            </div> <!-- / .form-group -->

                <div class="form-group">
                    <?php echo $this->Form->label('name', '建議跟進項目: ', 'col-sm-2 control-label'); ?>
                    <div class="col-sm-10">
                        <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false,'class'=>'form-control select2', 'placeholder'=>''));
                        ?>
                    </div>
                </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', "不開案", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>
                </div>
            </div> <!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', '原因: ', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   案主所持問題已於初次諮詢中解決</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   已有其他中心跟進（請註明）</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   求助者所呈現的問題不屬於本中心服務範疇／範圍內</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   不符合長期護理服務申請資格</div>
                    </div>
                </div>
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10"> <div class="row">
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他（請註明）<? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?></div>
                    </div></div>
            </div><!-- / .form-group -->

            <div class="form-group">
                <?php echo $this->Form->label('name', '介紹中心其他服務', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   中心會員服務MO</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   義工服務V</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   護老者服務C</div>
                    </div>
                </div>
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10"> <div class="row">
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   有需要護老者服務NC</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   認知障礙症支援服務DE</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   隱蔽長者服務HE</div>
                        <div class="col-sm-2">
                            <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'號碼'));
                            ?>
                        </div></div></div>
            </div><!-- / .form-group -->

                <div class="form-group">
                <?php echo $this->Form->label('name', '轉介', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   其他政府部門／福利機構（請註明）:</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   家居照顧服務（如家居清潔、送飯服務、陪診服務）</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   家居維修服務／電器申請</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   長者優惠</div>
                    </div>
                </div>
                <?php echo $this->Form->label('name', '', 'col-sm-2 control-label'); ?>
                <div class="col-sm-10"> <div class="row">
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   平安鐘</div>
                        <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他（請註明）<? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'其他'));
                            ?></div>
                        <div class="col-sm-4">

                        </div></div></div>
                </div><!-- / .form-group -->

            <div class="col-sm-12">
                <span class="panel-title">   督導評語: </span>
                <button type="button" class="close modalonly" data-dismiss="modal" style="display:none"><span aria-hidden="true">&times;</span><span class="sr-only"><?=__('Close')?></span></button>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label('name', "", 'col-sm-2 control-label'); ?>
                <div class="col-sm-10">
                    <? echo $this->Form->textarea('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                    ?>
                </div>
            </div> <!-- / .form-group -->









        </div>
    <div class="panel-footer text-right">
        <button type="submit" class="btn btn-primary btn-block" ><i class="glyphicon glyphicon-ok-sign"></i><? echo ' '.__('Submit');?></button>
    </div>
    <?php echo $this->Form->end(); ?>

        </div></div>


<script>

    $( document ).ready(function() {
        validate_form();


        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            language: "zh-TW",
            autoclose: true,
            todayHighlight: true,
            clearBtn: true
        });


    });


</script>