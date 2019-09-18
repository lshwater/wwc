<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
/**
 * Member Model
 *
 * @property Memberinputfield $Memberinputfield
 * @property Membertype $Membertype
 */
class VolunteerEventproposaltarget extends AppModel {

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
        'Eventproposaltarget' => array(
            'className' => 'Eventproposaltarget',
            'foreignKey' => 'eventproposaltarget_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}
