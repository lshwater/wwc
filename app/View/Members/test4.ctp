<div class="page-header">

    <div class="row">
        <!-- Page header, center on small screens -->
        <h1 class="col-xs-12"><i class="fa fa-signal page-header-icon"></i>&nbsp;&nbsp;統計</h1>

    </div>
</div>
<div class="row">

    <div class="col-sm-1">
        選項
    </div>
    <div class="col-sm-2">
        <select name="data[yaxis]" class="form-control form-group-margin filterauto select2 select2-hidden-accessible" id="yaxis" placeholder="Y-axis" tabindex="-1" aria-hidden="true">
            <option value="school_id">學校</option>
            <option value="student_id">學生</option>
            <option value="trainer_id">導師</option>
            <option value="manager_id">個案經理</option>
            <option value="userprofile_id">職種</option>
        </select><span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" style="width: 225.906px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-yaxis-container"><span class="select2-selection__rendered" id="select2-yaxis-container" title="導師">導師</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>    </div>

    <div class="col-sm-2">
        <select name="data[xaxis]" class="form-control form-group-margin filterauto select2 allowClear select2-hidden-accessible" id="xaxis" placeholder="X-axis" tabindex="-1" aria-hidden="true">
            <option value="type">小組/個別</option>
            <option value="userprofile_id">職種</option>
            <option value="location">地點</option>
            <option value="trainer_id">導師</option>
        </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 225.906px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-xaxis-container"><span class="select2-selection__rendered" id="select2-xaxis-container" title="職種"><span class="select2-selection__clear">×</span>職種</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>    </div>
    switcher
    <div class="col-sm-2">
        <input type="hidden" name="data[sub_xaxis]" value="" id="sub_xaxis_" autocomplete="off">
        <select name="data[sub_xaxis][]" multiple="" class="form-control form-group-margin filterauto select2 select2-hidden-accessible" id="sub_xaxis" placeholder="X-axis level2" tabindex="-1" aria-hidden="true">
            <option value="working_hour" selected="selected">工作時數</option>
            <option value="actual_hour">實際訓練時數</option>
            <option value="person" selected="selected">人數</option>
            <option value="attended_person">實際人數</option>
            <option value="assessment">評估</option>
            <option value="consultation">教師咨詢</option>
            <option value="ITP">ITP評估</option>
        </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 225.906px;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="工作時數"><span class="select2-selection__choice__remove" role="presentation">×</span>工作時數</li><li class="select2-selection__choice" title="實際訓練時數"><span class="select2-selection__choice__remove" role="presentation">×</span>實際訓練時數</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" role="textbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>    </div>


    <div class="col-sm-2">
        <input name="data[date]" class="form-control form-group-margin filterauto" id="filter-date" readonly="readonly" placeholder="日期" type="text" autocomplete="off">    </div>

</div>
<hr>
<div class="row">
    <div class="col-sm-1">
        篩選
    </div>
    <!--    <div class="col-sm-1">-->
    <!--        --><!--    </div>-->
    <div class="col-sm-2">
        <select name="data[school]" class="form-control form-group-margin filterauto select2-school allowClear select2-hidden-accessible" id="filter-school" placeholder="學校" tabindex="-1" aria-hidden="true">
        </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 225.906px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-filter-school-container"><span class="select2-selection__rendered" id="select2-filter-school-container"><span class="select2-selection__placeholder">篩選學校</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>    </div>
    <div class="col-sm-1">
        <select name="data[name]" class="form-control form-group-margin filterauto select2-student allowClear select2-hidden-accessible" id="filter-student" placeholder="學生名稱" tabindex="-1" aria-hidden="true">
        </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 101.953px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-filter-student-container"><span class="select2-selection__rendered" id="select2-filter-student-container"><span class="select2-selection__placeholder">篩選學生</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>    </div>

    <div class="col-sm-1">
        <select name="data[trainer]" class="form-control form-group-margin filterauto select2-trainer allowClear select2-hidden-accessible" id="filter-trainer" placeholder="導師名稱" tabindex="-1" aria-hidden="true">
        </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 101.953px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-filter-trainer-container"><span class="select2-selection__rendered" id="select2-filter-trainer-container"><span class="select2-selection__placeholder">篩選導師</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>    </div>

    <div class="col-sm-1">
        <select name="data[type]" class="form-control form-group-margin filterauto select2 allowClear select2-hidden-accessible" id="filter-type" placeholder="形式" tabindex="-1" aria-hidden="true">
            <option value="2">個別</option>
            <option value="1">小組</option>
            <option value="3">專題小組</option>
        </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 101.953px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-filter-type-container"><span class="select2-selection__rendered" id="select2-filter-type-container" title="個別"><span class="select2-selection__placeholder">形式</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>    </div>

    <div class="col-sm-1">
        <select name="data[profile]" class="form-control form-group-margin filterauto select2 allowClear select2-hidden-accessible" id="filter-profile" placeholder="職種" tabindex="-1" aria-hidden="true">
            <option value="1">SCCW</option>
            <option value="2">OT</option>
            <option value="3">PT</option>
            <option value="4">ST</option>
            <option value="5">EP</option>
            <option value="6">Supporting Staff</option>
        </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 101.953px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-filter-profile-container"><span class="select2-selection__rendered" id="select2-filter-profile-container" title="SCCW"><span class="select2-selection__placeholder">職種</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>    </div>


</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <div class="table-default">
            <table cellspacing="0" class="table table-striped" id="resulttable" width="100%">
                <!--            <table cellspacing="0" class="table table-striped nowrap"  id="resulttable" >-->
                <!--                <colgroup>-->
                <!--                    <col class="col-xs-1">-->
                <!--                    <col class="col-xs-1">-->
                <!--                    <col class="col-xs-1">-->
                <!--                    <col class="col-xs-1">-->
                <!--                    <col class="col-xs-1">-->
                <!--                    <col class="col-xs-1">-->
                <!--                    <col class="col-xs-1">-->
                <!--                    <col class="col-xs-1">-->
                <!--                    <col class="col-xs-1">-->
                <!--                    <col class="col-xs-1">-->
                <!--                    <col class="col-xs-1">-->
                <!--                </colgroup>-->
                <thead><tr><th style="width:15%;"></th><th colspan="2">SCCW</th><th colspan="2">PT</th></tr><tr><th style="width:15%;">導師</th><th>工作時數</th><th>實際訓練時數</th><th>工作時數</th><th>實際訓練時數</th><th>查看</th></tr></thead>
                <tbody><tr><td>Super Admin</td><td>0 小時</td><td>0 小時</td><td>10 小時</td><td>0.75 小時</td><td><a href="/trainingrecords/list_course_new?start=2019-03-01&amp;end=2019-04-30&amp;trainer_id=2&amp;type=" class="openasnew"><button class="btn btn-sm btn-info" style="width:30px;"><i class="fa fa-eye"></i></button></a></td></tr><tr></tr><tr><td>周侍會</td><td>6 小時</td><td>0 小時</td><td>0 小時</td><td>0 小時</td><td><a href="/trainingrecords/list_course_new?start=2019-03-01&amp;end=2019-04-30&amp;trainer_id=38&amp;type=" class="openasnew"><button class="btn btn-sm btn-info" style="width:30px;"><i class="fa fa-eye"></i></button></a></td></tr><tr></tr><tr><td>余淑敏</td><td>2 小時</td><td>0 小時</td><td>0 小時</td><td>0 小時</td><td><a href="/trainingrecords/list_course_new?start=2019-03-01&amp;end=2019-04-30&amp;trainer_id=39&amp;type=" class="openasnew"><button class="btn btn-sm btn-info" style="width:30px;"><i class="fa fa-eye"></i></button></a></td></tr><tr></tr></tbody>
                <!--                <tfoot>-->
                <!--                    <tr>-->
                <!--                        <th>--><!-- : </th>-->
                <!--                        <th></th>-->
                <!--                        <th></th>-->
                <!--                        <th></th>-->
                <!--                        <th></th>-->
                <!--                        <th></th>-->
                <!--                        <th></th>-->
                <!--                        <th></th>-->
                <!--                        <th></th>-->
                <!--                        <th></th>-->
                <!--                        <th></th>-->
                <!--                    </tr>-->
                <!--                </tfoot>-->
            </table>
        </div>
    </div>

</div>