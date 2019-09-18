<?
if(!empty($cutoffdatemsg)){
    echo $this->element('cutoffdatewarning');
}
?>

<div class="page-header">
    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12 col-sm-4 text-left-sm flashMessage">
            <i class="fa fa-bullhorn page-header-icon"></i>&nbsp;&nbsp;<?=h($volunteertype['Volunteertype']['name']).__("點名")?>
        </h1>

        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <hr class="visible-xs no-grid-gutter-h">
                <!-- "Create project" button, width=auto on desktops -->
            </div>
        </div>
    </div>
</div>

<div class="panel colourable">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <span class="panel-title"><i class="fa fa-info-circle"></i> 活動資料</span>
    </div>

    <!-- Table -->
        <table class="table">
            <tr>
                <td>
                    活動名稱
                </td>
                <td>
                    <?=h($activitysession['Activity']['name'])?>
                </td>
                <td>
                    活動編號
                </td>
                <td>
                    <?=h($activitysession['Activity']['activity_code'])?>
                </td>
            </tr>
            <tr>
                <td>
                    是次日期
                </td>
                <td>
                    <?=h($activitysession['Activitysession']['date'])?>
                </td>
                <td>
                    是次節數
                </td>
                <td>
                    <?=h($activitysession['Activitysession']['session'])?>
                </td>
            </tr>
            <tr>
                <td>
                    是次開始時間
                </td>
                <td>
                    <?=date("h:i A", strtotime($activitysession['Activitysession']['starttime']))?>
                </td>
                <td>
                    結束時間
                </td>
                <td>
                    <?=date("h:i A", strtotime($activitysession['Activitysession']['endtime']))?>
                </td>
            </tr>
        </table>
</div>


<div class="panel colourable">
    <div class="panel-heading">
        <span class="panel-title"><i class="fa fa-users"></i> <?=h($volunteertype['Volunteertype']['name'])?>名單</span>
        <div class="panel-heading-controls">
            <?echo $this->Html->link("全選出席", "javascript:void(0);", array("class" => "btn btn-xs btn-info btn-outline", 'escape' => false, "onclick"=>"setall(2)"));?>
            <?echo $this->Html->link("全選缺席", "javascript:void(0);", array("class" => "btn btn-xs btn-outline", 'escape' => false, "onclick"=>"setall(1)"));?>
        </div> <!-- / .panel-heading-controls -->
    </div>
    <?php echo $this->Form->create('ActivitiesVolunteerAttendant', array('class'=>'form-horizontal validate_form preventDoubleSubmission')); ?>
        <table class="table table-striped" >
            <thead>
            <tr>
                <th>編號 #</th>
                <th class="hidden-xs" ><?php echo  __('姓名(中)'); ?></th>
                <th><?php echo __('姓名(英)'); ?></th>
                <th><?php echo __('電話'); ?></th>
                <th class="actions"></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($attendees as $attendee): ?>
                <tr>
                    <td>
                        <?php
                        if(!$attendee['ActivitiesVolunteer']['valid']){
                            echo '<a href="#" class="label">已退出</a> ';
                        }

                        if($attendee['ActivitiesVolunteer']['volunteer_id']){
                            echo h($attendee['Volunteer']['code']);
                        }else{
                            echo " - ";
                        } ?>
                    </td>
                    <td class="hidden-xs" ><?php echo h($attendee['ActivitiesVolunteer']['c_name']); ?>&nbsp;</td>
                    <td><?php echo h($attendee['ActivitiesVolunteer']['e_name']); ?>&nbsp;</td>
                    <td><?php echo h($attendee['ActivitiesVolunteer']['tel']); ?>&nbsp;</td>

                    <td class="actions">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <?
                                $needtotakeatt = true;
                                if(!empty($atts[$attendee['ActivitiesVolunteer']['id']])){
                                    $default = $atts[$attendee['ActivitiesVolunteer']['id']]['attendant_id'];
                                    echo $this->Form->hidden("{$attendee['ActivitiesVolunteer']['id']}.ActivitiesVolunteerAttendant.id", array("value"=>$atts[$attendee['ActivitiesVolunteer']['id']]['id']));
                                }else{
                                    if(!$attendee['ActivitiesVolunteer']['valid']){
                                        $needtotakeatt = false;
                                    }else{
                                        $default = -1;
                                        echo $this->Form->hidden("{$attendee['ActivitiesVolunteer']['id']}.ActivitiesVolunteerAttendant.activitysession_id", array("value"=>$activitysession['Activitysession']['id']));
                                        echo $this->Form->hidden("{$attendee['ActivitiesVolunteer']['id']}.ActivitiesVolunteerAttendant.activities_volunteer_id", array("value"=>$attendee['ActivitiesVolunteer']['id']));
                                    }
                                }
                                if($needtotakeatt){
                                    foreach($attendantchoices as $key=>$val){
                                        if($key == $default){
                                            $checkded = "checked";
                                        }else{
                                            $checkded = "";
                                        }
                                        ?>
                                        <label class="radio-inline">
                                            <?=$this->Form->input("{$attendee['ActivitiesVolunteer']['id']}.ActivitiesVolunteerAttendant.attendant_id", array("type"=>"text",'class'=>"radiobtn form-control radio".$key, 'id'=>'','value'=>$key,"label"=>false, "div"=>false, 'id'=>'', 'checked'=>$checkded, 'required' => 'required'));?>
                                            <?=$val?>
                                        </label>
                                <?
                                    }
                                }?>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>

        </table>
        <p class="text-sm"># 如果不是登記<?=h($volunteertype['Volunteertype']['name'])?>，就沒有編號。</p>
        <!-- /5. $DEFAULT_TABLES -->


        <div class="panel-footer text-right">
            <button type="submit" id="submitbutton" class="btn btn-primary" ><i class="glyphicon glyphicon-ok-sign"></i> 存儲</button>
        </div>
    <?php echo $this->Form->end(); ?>

</div>

<script>
    function setall(choice){
        $(".radio"+choice).prop('checked', 'checked');
    }

    $(document).ready(function() {

        var $r = $('.radiobtn');
        $r.each(function () {
            var $p  = $(this).parent(),
                $el = $(this).detach().addClass('px'),
                t   = $p.text().trim();
            $(this).attr('type', 'radio');
            $p.html('');
            $p.append($el);
            $p.append($('<span class="lbl">' + t + '</span>'));
        });
    });
</script>