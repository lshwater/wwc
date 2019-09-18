

<div class="row">
    <?php echo $this->Form->create('Buyitem', array('class'=>'panel form-horizontal validate_form')); ?>
    <? echo $this->Form->hidden('id');?>
    <div class="panel-heading">
        <span class="panel-title">個案評估表</span>
    </div>

    <div class="panel-body">
        <div class="form-group">
            <?php echo $this->Form->label('name', "開檔/重開日期 ", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false,'class'=>'form-control select2', 'placeholder'=>'')); ?>
            </div>
            <?php echo $this->Form->label('name', "檔案編號", 'col-sm-2 col-sm-offset-2 control-label'); ?>
            <div class="col-sm-2">
                <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false,'class'=>'form-control select2', 'placeholder'=>'')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $this->Form->label('name', "結束日期 ", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false,'class'=>'form-control select2', 'placeholder'=>'')); ?>
            </div>
            <?php echo $this->Form->label('name', "評估日期", 'col-sm-2 col-sm-offset-2 control-label'); ?>
            <div class="col-sm-2">
                <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false,'class'=>'form-control select2', 'placeholder'=>'')); ?>
            </div>
        </div>
        <div class="form-group">
            <?php echo $this->Form->label('name', "個案類別 ", 'col-sm-2 col-sm-offset-6 control-label'); ?>
            <div class="col-sm-2">
                <?php echo $this->Form->input('name', array('div'=>false, 'label'=>false,'class'=>'form-control','options'=>array('輔導個案', '隱蔽/極需要照顧長者'), 'placeholder'=>'')); ?>
            </div>

        </div>
    </div>

    <div class="panel-heading">
        <span class="panel-title">A.	申請人資料</span>
    </div>
    <div class="panel-body">
        <h5><u>I. 個人資料 </u></h5>

        <div class="form-group">
            <?php echo $this->Form->label('name', "姓名 ", 'col-sm-2 control-label'); ?>
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
            <?php echo $this->Form->label('name', "身份證號碼 ", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                ?>
            </div>
            <?php echo $this->Form->label('expiry', "出生日期 ", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('expiry', array('div'=>false, 'label'=>false, 'class'=>'form-control datepicker', 'readonly'=>'readonly', 'placeholder'=>'日期', /*'required'=>'required'*/));
                ?>
            </div>
            <?php echo $this->Form->label('name', "年齡 ", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>''));
                ?>
            </div>
        </div> <!-- / .form-group -->

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
            <?php echo $this->Form->label('name', '教育程度', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   文盲</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   私塾</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   略懂文字</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   小學</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   中學</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   大專或以上</div>
                </div>
            </div>

        </div><!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('name', '職業', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   無</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   有</div>
                </div>
            </div>

        </div><!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('name', '曾否接受社會福利署安老服務統', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   有</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   沒有</div>
                </div>
            </div>

        </div><!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('name', '受損程度', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   沒有</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   輕度</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   中度</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   嚴重</div>
                </div>
            </div>

        </div><!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('name', '有否使用平安鐘服務', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   已安裝</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   未安裝</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   申請中</div>
                </div>
            </div>

        </div><!-- / .form-group -->
        <hr>
        <h5><u>II. 居住狀況 </u></h5>
        <div class="form-group">
            <?php echo $this->Form->label('name', '居住狀況:', 'col-sm-2 control-label'); ?>

            <div class="col-sm-10">
                <div class="row">

                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   獨居</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   與配偶共住</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   與子女共住</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('d', array('class'=>'form-control')); ?>   與親戚同住 </div>
                </div>
            </div>

            <div class="col-sm-10 col-sm-offset-2">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   與父母同住 </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   與朋友同住  </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   與其他人同住 </div>
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   與外傭共住</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('b', array('class'=>'form-control')); ?>   其他</div>

                </div>
            </div>
        </div><!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('name', '居住類別', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   公屋</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   私人樓宇</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   居屋</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   露宿</div>
                </div>
            </div>
            <div class="col-sm-10 col-sm-offset-2">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   木屋/村屋</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   院舍       </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   其他 </div>
                </div>
            </div>

        </div><!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('name', '居住形式', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   床位</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   房間       </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   獨立單位   </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   其他 </div>
                </div>
            </div>

        </div><!-- / .form-group -->
        <hr>
        <h5><u>III. 家庭狀況 </u></h5>
        <div class="form-group">
            <?php echo $this->Form->label('name', "子女/兄弟姊妹數量", 'col-sm-2 control-label'); ?>
            <div class="col-sm-1">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'子')); ?>
            </div>
            <div class="col-sm-1">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'女')); ?>
            </div>
            <div class="col-sm-1">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'兄')); ?>
            </div>
            <div class="col-sm-1">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'姊')); ?>
            </div>
            <div class="col-sm-1">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'弟')); ?>
            </div>
            <div class="col-sm-1">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'妹')); ?>
            </div>
        </div> <!-- / .form-group -->


        <div class="form-group">
            <?php echo $this->Form->label('name', '家庭狀況', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   密切</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   一般/普通       </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   疏離   </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   惡劣 </div>
                </div>
            </div>
        </div><!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('name', '同住人士資料', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <table>
                    <thead>
                    <tr>
                        <th>姓名</th>
                        <th>年齡</th>
                        <th>性別</th>
                        <th>關係</th>
                        <th>關係程度</th>
                        <th>職業</th>
                        <th>備註</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'options'=>array('男','女'),'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                    </tr>
                    <tr>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'options'=>array('男','女'),'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                    </tr>
                    <tr>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'options'=>array('男','女'),'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                    </tr>
                    <tr>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'options'=>array('男','女'),'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                        <td><? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div><!-- / .form-group -->
        <hr>

        <h5><u>IV. 緊急聯絡人資料 </u></h5>
        <div class="form-group">
            <?php echo $this->Form->label('name', "姓名", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?>
            </div>

            <?php echo $this->Form->label('name', "關係", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?>
            </div>

            <?php echo $this->Form->label('name', "電話", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?>
            </div>
        </div> <!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('name', "姓名", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?>
            </div>

            <?php echo $this->Form->label('name', "關係", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?>
            </div>

            <?php echo $this->Form->label('name', "電話", 'col-sm-2 control-label'); ?>
            <div class="col-sm-2">
                <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?>
            </div>
        </div> <!-- / .form-group -->

        <hr>
        <h5><u>V. 經濟狀況 </u></h5>
        <div class="col-sm-10 col-sm-offset-2">
            <div class="row">
                <div class="col-sm-2 "> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   充裕</div>
                <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   能應付(一般)       </div>
                <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   勉強能應付   </div>
                <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   有困難 </div>
                <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   極有困難 </div>
            </div>
        </div>

        <div class="form-group">
            <?php echo $this->Form->label('name', '收入來源 ', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <?php echo $this->Form->label('name', "薪金 ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'每月')); ?>
                    </div>
                    <?php echo $this->Form->label('name', "家人供養 ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'每月')); ?>
                    </div>
                </div>
                <div class="row">
                    <?php echo $this->Form->label('name', "個人儲蓄 ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?>
                    </div>
                    <?php echo $this->Form->label('name', "長俸/退休金  ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'每月')); ?>
                    </div>
                </div>
                <div class="row">
                    <?php echo $this->Form->label('name', "親友供養   ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'每月')); ?>
                    </div>
                    <?php echo $this->Form->label('name', "其他   ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'')); ?>
                    </div>
                </div>

                <div class="row">
                    <?php echo $this->Form->label('name', "綜合社會保障援助計劃   ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'每月')); ?>
                    </div>
                    <?php echo $this->Form->label('name', "普通 / 高額傷殘津貼   ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'每月')); ?>
                    </div>
                    <?php echo $this->Form->label('name', "高齡津貼   ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'每月')); ?>
                    </div>
                    <?php echo $this->Form->label('name', "長者生活津貼    ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'每月')); ?>
                    </div>
                </div>
            </div>
        </div><!-- / .form-group -->


        <div class="form-group">
            <?php echo $this->Form->label('name', '支出項目 ', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <?php echo $this->Form->label('name', "租金 / 樓宇按揭供款  ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'每月')); ?>
                    </div>
                    <?php echo $this->Form->label('name', "交通及膳食 ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'每月')); ?>
                    </div>
                    <?php echo $this->Form->label('name', "其他 ", 'col-sm-2 control-label'); ?>
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'每月')); ?>
                    </div>
                </div>

            </div>
        </div><!-- / .form-group -->
        <div class="form-group">
            <?php echo $this->Form->label('name', '日常其他總開支 (水、電、煤費用等等)：  ', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2">
                        <? echo $this->Form->input('name', array('div'=>false, 'label'=>false, 'class'=>'form-control', 'placeholder'=>'每月')); ?>
                    </div>

                </div>

            </div>
        </div><!-- / .form-group -->


        <hr>
        <h5><u>VI. 轉介來源 / 服務申請過程 </u></h5>

        <div class="form-group">
            <?php echo $this->Form->label('name', '轉介來源類別', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   自行申請      </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   家庭服務    </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   朋友     </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   家人/親戚     </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   醫務社工/親戚     </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   醫護人員            </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   復康服務       </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   社會保障部       </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   安老服務    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   其他福利機構              </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   其他        </div>
                </div>
            </div>

        </div><!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('name', '評估地點', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   申請人家中          </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   中心           </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   申請人親友家中          </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   家人/其他長者服務單位     </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   醫院          </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   其他        </div>
                </div>
            </div>
        </div><!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('name', '評估時，有否陪伴者', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   沒有</div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   有            </div>
                </div>
            </div>
        </div><!-- / .form-group -->

        <div class="form-group">
            <?php echo $this->Form->label('name', '申請服務 ', 'col-sm-2 control-label'); ?>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   輔導服務  </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   護老者服務              </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   隱蔽個案服務                </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   長期護理服務申請                </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   極有需要長者服務              </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   綜合家居照顧服務     </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   改善家居及社區照顧服務                  </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   院舍服務                    </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   日間護理中心                </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"> <? echo $this->Form->checkbox('a', array('class'=>'form-control')); ?>   綜合家庭服務         </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   暫託服務                      </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   其他轉介服務                      </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   義工服務                    </div>
                    <div class="col-sm-2"> <?echo $this->Form->checkbox('c', array('class'=>'form-control')); ?>   其他            </div>
                </div>
            </div>
        </div><!-- / .form-group -->




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