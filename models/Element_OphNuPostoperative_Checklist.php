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
 * This is the model class for table "et_ophnupostoperative_checklist".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $eye_dressing_in_place
 * @property integer $iv_removed
 * @property integer $ecg_dots_removed
 * @property integer $take_home_ophthalmic_medication_and/or_analgesics_supplies
 * @property integer $instructions
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 */

class Element_OphNuPostoperative_Checklist  extends  BaseEventTypeElement
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
		return 'et_ophnupostoperative_checklist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('event_id, eye_dressing_in_place, iv_removed, ecg_dots_removed, take_home_ophthalmic_medication_and/or_analgesics_supplies, instructions, ', 'safe'),
			array('eye_dressing_in_place, iv_removed, ecg_dots_removed, take_home_ophthalmic_medication_and/or_analgesics_supplies, instructions, ', 'required'),
			array('id, event_id, eye_dressing_in_place, iv_removed, ecg_dots_removed, take_home_ophthalmic_medication_and/or_analgesics_supplies, instructions, ', 'safe', 'on' => 'search'),
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
			'eye_dressing_in_place' => 'Eye dressing in place',
			'iv_removed' => 'IV Removed',
			'ecg_dots_removed' => 'ECG dots removed',
			'take_home_ophthalmic_medication_and/or_analgesics_supplies' => 'Take home ophthalmic medications and/or analgesics supplies',
			'instructions' => 'Post op education instructions given to patient',
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
		$criteria->compare('eye_dressing_in_place', $this->eye_dressing_in_place);
		$criteria->compare('iv_removed', $this->iv_removed);
		$criteria->compare('ecg_dots_removed', $this->ecg_dots_removed);
		$criteria->compare('take_home_ophthalmic_medication_and/or_analgesics_supplies', $this->take_home_ophthalmic_medication_and/or_analgesics_supplies);
		$criteria->compare('instructions', $this->instructions);

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