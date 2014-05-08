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
 * This is the model class for table "et_ophnupostoperative_vitals".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property string $comments
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property OphNuPostoperative_Drug_Dose $drugs
 * @property OphNuPostoperative_Reading $readings
 */

class Element_OphNuPostoperative_Vitals extends BaseEventTypeElement
{
	public $intervals = 8;
	public $reading_items = array();
	public $drug_items = array();
	public $gas_items = array();

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
		return 'et_ophnupostoperative_vitals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('anaesthesia_start_time, anaesthesia_end_time, surgery_start_time, surgery_end_time', 'safe'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'element_type' => array(self::HAS_ONE, 'ElementType', 'id','on' => "element_type.class_name='".get_class($this)."'"),
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
			'drugs' => array(self::HAS_MANY, 'OphNuPostoperative_Vitals_Drug_Dose', 'element_id', 'order' => 'offset'),
			'readings' => array(self::HAS_MANY, 'OphNuPostoperative_Vital', 'element_id', 'order' => 'offset'),
			'gas_levels' => array(self::HAS_MANY, 'OphNuPostoperative_Vitals_Gas_Level', 'element_id', 'order' => 'offset'),
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
			'comments' => 'Post operative orders',
			'anaesthesia_start_time' => 'Anaesthesia start time',
			'anaesthesia_end_time' => 'End time',
			'surgery_start_time' => 'Surgery start time',
			'surgery_end_time' => 'End time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);
		$criteria->compare('comments', $this->comments);

		return new CActiveDataProvider(get_class($this), array(
				'criteria' => $criteria,
		));
	}

	public function setDefaultOptions()
	{
		$ts = time();

		while (date('i',$ts) != '00' && date('i',$ts) != '30') {
			$ts -= 60;
		}

		$this->anaesthesia_start_time = date('H:i',$ts);
	}

	public function OneOf($attribute, $params)
	{
		$valid = false;

		foreach ($params as $param) {
			if ($this->$param) {
				$valid = true;
				break;
			}
		}

		if ($valid === false) {
			$this->addError($attribute, 'You must enter at least one drug or reading');
		}
	}

	public function getStartTimeTS()
	{
		if (!empty($_POST)) {
			preg_match('/^([0-9]+)\:([0-9]+)/',$_POST['Element_OphNuPostoperative_Vitals']['anaesthesia_start_time'],$m);
		} else {
			preg_match('/^([0-9]+)\:([0-9]+)/',$this->anaesthesia_start_time,$m);
		}

		return mktime($m[1],$m[2],0,1,1,2012);
	}

	public function getTimeIntervals()
	{
		$times = array();

		for ($i=0; $i<=$this->intervals; $i++) {
			$times[] = date('H:i',($this->startTimeTS + ($i * 15 * 60)));
		}

		return $times;
	}

	protected function afterFind()
	{
		$this->anaesthesia_start_time = substr($this->anaesthesia_start_time,0,5);
		$this->anaesthesia_end_time = substr($this->anaesthesia_end_time,0,5);
		$this->surgery_start_time = substr($this->surgery_start_time,0,5);
		$this->surgery_end_time = substr($this->surgery_end_time,0,5);

		foreach ($this->readings as $reading) {
			$this->reading_items[$reading->item_id][$reading->offset] = $reading->value;
		}

		foreach ($this->drugs as $drug) {
			$this->drug_items[$drug->item_id][$drug->offset] = $drug->value;
		}

		foreach ($this->gas_levels as $gas_level) {
			$this->gas_items[$gas_level->item_id][$gas_level->offset] = $gas_level->value;
		}

		$this->reading_items = $this->populateMissingGridItems($this->reading_items, 'OphNuPostoperative_Vital_Type');
		$this->drug_items = $this->populateMissingGridItems($this->drug_items, 'OphNuPostoperative_Vitals_Drug');
		$this->gas_items = $this->populateMissingGridItems($this->gas_items, 'OphNuPostoperative_Vitals_Gas');
	}

	public function populateMissingGridItems($data, $model)
	{
		foreach ($model::model()->findAll() as $item) {
			if (!isset($data[$item->id])) {
				$data[$item->id] = array();
			}

			for ($i=0; $i<$this->intervals; $i++) {
				if (!isset($data[$item->id][$i])) {
					$data[$item->id][$i] = '';
				}
			}
		}

		return $data;
	}

	public function afterValidate()
	{
		foreach ($this->drugs as $drug) {
			if ($this->vitalsOffsetHasData($drug->offset)) {
				if (!$drug->validate()) {
					foreach ($drug->getErrors() as $field => $error) {
						$this->addError($field,$drug->item->name.': '.$error[0]);
					}
				}
			}
		}

		foreach ($this->readings as $reading) {
			if ($this->vitalsOffsetHasData($reading->offset)) {
				if (!$reading->validate()) {
					foreach ($reading->getErrors() as $field => $error) {
						$this->addError($field,$reading->item->name.': '.$error[0]);
					}
				}
			}
		}

		foreach ($this->gas_levels as $gas_level) {
			if ($this->vitalsOffsetHasData($gas_level->offset)) {
				if (!$gas_level->validate()) {
					foreach ($gas_level->getErrors() as $field => $error) {
						$this->addError($field,$gas_level->item->name.': '.$error[0]);
					}
				}
			}
		}

		return parent::afterValidate();
	}

	public function vitalsOffsetHasData($offset)
	{
		foreach ($this->drugs as $drug) {
			if ($drug->offset == $offset && strlen($drug->value) >0) {
				return true;
			}
		}

		foreach ($this->readings as $reading) {
			if ($reading->offset == $offset && strlen($reading->value) >0) {
				return true;
			}
		}

		foreach ($this->gas_levels as $gas_level) {
			if ($gas_level->offset == $offset && strlen($gas_level->value) >0) {
				return true;
			}
		}

		return false;
	}

	public function beforeSave()
	{
		foreach (array('anaesthesia_start_time','anaesthesia_end_time','surgery_start_time','surgery_end_time') as $field) {
			if (!$this->$field) {
				$this->$field = null;
			}
		}

		return parent::beforeSave();
	}
}
?>
