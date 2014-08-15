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
 * @property integer $wristband_verified
 * @property integer $allergies_verified
 * @property integer $hand_off_from_id
 * @property integer $hand_off_to_id
 * @property integer $anesthesia_type_id
 * @property integer $nonoperative_eye_protected_id
 * @property integer $tape_or_shield_id
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property OphNuPostoperative_Handoff_Identifiers $two_identifierss
 * @property OphNuPostoperative_Handoff_HandOffFrom $hand_off_from
 * @property Address $hand_off_to
 * @property AnaestheticType $anesthesia_type
 * @property OphNuPostoperative_Handoff_NonoperativeEyeProtected $nonoperative_eye_protected
 * @property OphNuPostoperative_Handoff_TapeOrShield $tape_or_shield
 */

class Element_OphNuPostoperative_WHOSignOut extends  BaseEventTypeElement
{
	public $auto_update_relations = true;

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
		return 'et_ophnupostoperative_whosignout';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('signout_lead_by_id, surgical_count_completed, labelling_id, equipment_problems, equipment_problems_comments, instructions_provided_id, problems', 'safe'),
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
			'signout_lead_by' => array(self::BELONGS_TO, 'User', 'signout_lead_by_id'),
			'labelling' => array(self::BELONGS_TO, 'OphNuPostoperative_WHOSignOut_Labelling', 'labelling_id'),
			'instructions_provided' => array(self::BELONGS_TO, 'OphNuIntraoperative_WHOSignOut_InstructionsProvided', 'instructions_provided_id'),
			'problems_assignment' => array(self::HAS_MANY, 'OphNuPostoperative_WHOSignOut_EquipmentProblems_Assignment', 'element_id'),
			'problems' => array(self::HAS_MANY, 'OphNuPostoperative_WHOSignOut_EquipmentProblems', 'problem_id', 'through' => 'problems_assignment'),
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
			'signout_lead_by_id' => 'WHO sign out lead by',
			'surgical_count_completed' => 'Surgical counts completed?',
			'labelling_id' => 'Appropriate labelling of specimens confirmed by nurse and surgeon?',
			'equipment_problems' => 'Equipment problems identified?',
			'problems' => 'Equipment problems',
			'equipment_problems_comments' => 'Comments',
			'instructions_provided_id' => 'Surgeon and anaesthesiologist confirm that special instructions have been provided to recovery and/or ward',
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

	public function beforeValidate()
	{
		if ($this->equipment_problems) {
			if (empty($this->problems)) {
				$this->addError('problems','Please select at least one equipment problem');
			}

			if ($this->hasMultiSelectValue('problems','Other')) {
				if (!$this->equipment_problems_comments) {
					$this->addError('equipment_problems_comments','Please specify the equipment problems');
				}
			}
		}

		return parent::beforeValidate();
	}
}
?>
