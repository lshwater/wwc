<?php
App::uses('AppModel', 'Model');

class Casemanagement extends AppModel {

    public $referred_by_choices = array(
        "SWD"=>"SWD",
        "Other Org"=>"Other Org",
        "Self-referral"=>"Self-referral"
    );

    public $types = array(
        "隱蔽長者"=>"隱蔽長者",
        "獨居長者"=>"獨居長者",
        'LTC個案'=>'LTC個案'
    );

    public $casefrom = array(
        1=>"自洽",
        2=>"職員自行發掘",
        3=>'轉介 - 親屬',
        4=>'轉介 - 朋友/鄰舍/義工',
        5=>'轉介 - 機構同工',
        6=>'轉介 - 社署',
        7=>'轉介 - 其他福利機構',
    );

    //case status
    public $case_enquiry_assessment = array(
        1=>"開案",
//        0=>"待處理",
        -1=>"不開案",
        5=>'轉介',
    );

    public $case_status = array(
        1=>array(
            "name"=>"進行中個案",
            'class'=>'success'
        ),
        0=>array(
            "name"=>"待處理個案",
            'class'=>'warning'
        ),
        -1=>array(
            "name"=>"不開案",
            'class'=>'danger'
        ),
        5=>array(
            "name"=>"已轉介個案",
            'class'=>'info'
        ),
        9=>array(
            "name"=>"已結束個案",
            'class'=>'default'
        )
    );

    public $case_menu = array(
        1=>array(
            array(
                "name"=>"個案諮詢表",
                'action'=>array(
                    'controller'=>'Caseenquiryforms',
                    'action'=>'add'
                )
            ),
            array(
                "name"=>"個案評估表",
                'action'=>array(
                    'controller'=>'Caseassessments',
                    'action'=>'add'
                )
            ),
            array(
                "name"=>"個案接觸記錄",
                'action'=>array(
                    'controller'=>'Servicerecords',
                    'action'=>'add'
                )
            ),
            array(
                "name"=>"個案重檢表",
                'action'=>array(
                    'controller'=>'Casereassessments',
                    'action'=>'add'
                )
            ),
            array(
                "name"=>"轉介個案",
                'action'=>array(
                    'controller'=>'Casereferralforms',
                    'action'=>'add'
                )
            ),
            array(
                "name"=>"結束/轉移個案",
                'action'=>array(
                    'controller'=>'Casecloseforms',
                    'action'=>'add'
                )
            ),
        ),
        0=>array(
            array(
                "name"=>"個案諮詢表",
                'action'=>array(
                    'controller'=>'Caseenquiryforms',
                    'action'=>'add'
                )
            ),
            array(
                "name"=>"轉介個案",
                'action'=>array(
                    'controller'=>'Casereferralforms',
                    'action'=>'add'
                )
            ),
            array(
                "name"=>"個案評估表",
                'action'=>array(
                    'controller'=>'Caseassessments',
                    'action'=>'add'
                )
            ),
        ),
        -1=>array(
            array(
                "name"=>"個案諮詢表",
                'action'=>array(
                    'controller'=>'Caseenquiryforms',
                    'action'=>'add'
                )
            ),
        ),
        5=>array(
//            array(
//                "name"=>"個案轉介跟進",
//                'action'=>array(
//                    'controller'=>'Referralfollowup',
//                    'action'=>'add'
//                )
//            ),
            array(
                "name"=>"結束/轉移個案",
                'action'=>array(
                    'controller'=>'Casecloseforms',
                    'action'=>'add'
                )
            ),
        ),
        9=>array(

        )
    );



    public $validate = array(
        'code' => array(
            'notempty' => array(
                'rule' => array('notempty'),
            ),
            'code_unique' => array(
                'rule' => 'isUnique',
                'message' => 'That code is already in use',
            )
        ),
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'application_success' => array(
            'rule'    => array('boolean'),
            'allowEmpty'=>true,
            'message' => 'Incorrect value for checkbox'
        ),
        'dateofapproval' => array(
            'comparison2' => array(
                'rule'=>array('field_comparison', '>=', 'applicationdate'), 'message' => '必須在個案申請日期後','allowEmpty'=>true
            ),
        )
    );

    public $belongsTo = array(
        'User'=> array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Year'=> array(
            'className' => 'Year',
            'foreignKey' => 'year_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
//        'Identitytype' => array(
//            'className' => 'Identitytype',
//            'foreignKey' => 'client_identitytype_id',
//            'conditions' => '',
//            'fields' => '',
//            'order' => ''
//        ),
        "Notopencasereason"=> array(
            'className' => 'Notopencasereason',
            'foreignKey' => 'notopencasereason_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Member'=> array(
            'className' => 'Member',
            'foreignKey' => 'member_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Membership'=> array(
            'className' => 'Membership',
            'foreignKey' => 'membership_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Casenature'=> array(
            'className' => 'Casenature',
            'foreignKey' => 'casenature_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Casetype'=> array(
            'className' => 'Casetype',
            'foreignKey' => 'casetype_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),

    );

    public $hasMany = array(
        'Casemanagementform' => array(
            'className' => 'Casemanagementform',
            'foreignKey' => 'casemanagement_id',
            'dependent' => true,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

    public $actsAs = array('Search.Searchable', 'Linkable.Linkable');

    public $filterArgs = array(
        'filter' => array('type' => 'query', 'method' => 'orConditions'),
    );


    public function orConditions($data = array()) {
        $display = trim($data['filter']);
        if($display == 1){
            $cond = array(
                'closed '=>0
            );
        }else if($display == 2){
            $cond = array(
                'closed '=>1
            );
        }else{

        }

        return $cond;
    }
}
