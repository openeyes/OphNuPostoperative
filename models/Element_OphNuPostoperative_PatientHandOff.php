<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * This is the model class for table "et_ophnupostoperative_patienthandoff".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property string $patient_enters_recovery_room
 * @property integer $an_hand_off_from_id
 * @property integer $nurse_hand_off_from_id
 * @property integer $nurse_hand_off_to_id
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property OphNuPostoperative_PatientHandOff_AnHandOffFrom $an_hand_off_from
 * @property OphNuPostoperative_PatientHandOff_NurseHandOffFrom $nurse_hand_off_from
 * @property OphNuPostoperative_PatientHandOff_NurseHandOffTo $nurse_hand_off_to
 */

class Element_OphNuPostoperative_PatientHandOff  extends  BaseEventTypeElement
{
	public $service;

	/**
	 * Returns the static model of the specified AR class.
	 * @return the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'et_ophnupostoperative_patienthandoff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('event_id, patient_enters_recovery_room, an_hand_off_from_id, nurse_hand_off_from_id, nurse_hand_off_to_id, ', 'safe'),
			array('patient_enters_recovery_room, an_hand_off_from_id, nurse_hand_off_from_id, nurse_hand_off_to_id, ', 'required'),
			array('id, event_id, patient_enters_recovery_room, an_hand_off_from_id, nurse_hand_off_from_id, nurse_hand_off_to_id, ', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		return array(
			'element_type' => array(self::HAS_ONE, 'ElementType', 'id','on' => "element_type.class_name='".get_class($this)."'"),
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
			'an_hand_off_from' => array(self::BELONGS_TO, 'OphNuPostoperative_PatientHandOff_AnHandOffFrom', 'an_hand_off_from_id'),
			'nurse_hand_off_from' => array(self::BELONGS_TO, 'OphNuPostoperative_PatientHandOff_NurseHandOffFrom', 'nurse_hand_off_from_id'),
			'nurse_hand_off_to' => array(self::BELONGS_TO, 'OphNuPostoperative_PatientHandOff_NurseHandOffTo', 'nurse_hand_off_to_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
			'patient_enters_recovery_room' => 'Patient enters recovery room',
			'an_hand_off_from_id' => 'Anesthesia Hand off from',
			'nurse_hand_off_from_id' => 'Nurse Hand off from',
			'nurse_hand_off_to_id' => 'Nurse Hand off to',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);
		$criteria->compare('patient_enters_recovery_room', $this->patient_enters_recovery_room);
		$criteria->compare('an_hand_off_from_id', $this->an_hand_off_from_id);
		$criteria->compare('nurse_hand_off_from_id', $this->nurse_hand_off_from_id);
		$criteria->compare('nurse_hand_off_to_id', $this->nurse_hand_off_to_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}



	protected function afterSave()
	{

		return parent::afterSave();
	}
}
?>