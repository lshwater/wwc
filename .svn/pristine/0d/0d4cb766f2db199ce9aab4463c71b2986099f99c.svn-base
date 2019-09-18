<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	public $viewall = false;
	
	public function begin() {
		$db =& ConnectionManager::getDataSource($this->useDbConfig);
		$db->begin($this);
	}
	public function commit() {
		$db =& ConnectionManager::getDataSource($this->useDbConfig);
		$db->commit($this);
	}
	public function rollback() {
		$db =& ConnectionManager::getDataSource($this->useDbConfig);
		$db->rollback($this);
	}



	public function field_comparison($check1, $operator, $field2) {
		foreach($check1 as $key=>$value1) {
			$value2 = $this->data[$this->alias][$field2];
			if (!Validation::comparison($value1, $operator, $value2))
				return false;
		}
		return true;
	}
	
	function isUniqueMulti($data, $fields) {
		if (!is_array($fields)) {
			$fields = array($fields);
		}
	
		foreach ($fields as $key) {
			$tmp[$key] = $this->data[$this->name][$key];
		}
	
		return $this->isUnique($tmp, FALSE);
	}
	
	function identicalFieldValues( $field=array(), $compare_field=null )
	{
		foreach( $field as $key => $value ){
			$v1 = $value;
			$v2 = $this->data[$this->name][ $compare_field ];
			if($v1 !== $v2) {
				return FALSE;
			} else {
				continue;
			}
		}
		return TRUE;
	}


    public function datahash($tar){
        $salt = Configure::read('Security.salt');
        return hash('md5',$salt.$tar);
    }

    public function encryptdata($tar){
        return Security::rijndael($tar, Configure::read('Security.salt'), 'encrypt');
    }

    public function decryptdata($tar){
        if(strlen($tar) > 20){
            return Security::rijndael($tar, Configure::read('Security.salt'), 'decrypt');
        }
        return $tar;
    }

}
