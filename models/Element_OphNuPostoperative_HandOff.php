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
 * This is the model class for table "et_ophnupostoperative_handoff".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $patient_id_verified_with_two_identifiers
 * @property string $patient_enters_recovery_room
 * @property integer $hand_off_from_id
 * @property integer $hand_off_to_id
 * @property integer $handing_off_from_id
 * @property integer $translator_present_id
 * @property string $name_of_translator
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property OphNuPostoperative_Patient_HandOffFrom $hand_off_from
 * @property OphNuPostoperative_Patient_HandOffTo $hand_off_to
 * @property OphNuPostoperative_Patient_HandingOffFrom $handing_off_from
 * @property OphNuPostoperative_Patient_TranslatorPresent $translator_present
 */

class Element_OphNuPostoperative_HandOff	extends  BaseEventTypeElement
{
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
		return 'et_ophnupostoperative_handoff';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('event_id, patient_enters_recovery_room, anaesthesia_handoff_from_id, anaesthesia_handoff_to_id, nursing_handoff_from_id', 'safe'),
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
			'anaesthesia_handoff_from' => array(self::BELONGS_TO, 'User', 'anaesthesia_handoff_from_id'),
			'anaesthesia_handoff_to' => array(self::BELONGS_TO, 'User', 'anaesthesia_handoff_to_id'),
			'nursing_handoff_from' => array(self::BELONGS_TO, 'User', 'nursing_handoff_from_id'),
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
			'patient_id_verified_with_two_identifiers' => 'Patient ID / wristband verified with two identifiers',
			'patient_enters_recovery_room' => 'Time patient enters recovery room',
			'anaesthesia_handoff_from_id' => 'Anesthesia hand off from OR completed by',
			'anaesthesia_handoff_to_id' => 'Hand off to',
			'nursing_handoff_from_id' => 'Nursing hand off from OR completed by',
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

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}
}
?>
