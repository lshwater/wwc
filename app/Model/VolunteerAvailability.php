<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * Member Model
 *
 * @property Memberinputfield $Memberinputfield
 * @property Membertype $Membertype
 */
class VolunteerAvailability extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
    public $belongsTo = array(
        'Volunteer' => array(
            'className' => 'Volunteer',
            'foreignKey' => 'volunteer_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Availability' => array(
            'className' => 'Availability',
            'foreignKey' => 'availability_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
