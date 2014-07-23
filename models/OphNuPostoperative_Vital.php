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
 * This is the model class for table "ophnupostoperative_vital".
 *
 * The followings are the available columns in table:
 * @property integer $id
 * @property integer $item_id
 * @property string $record_time
 * @property string $value
 * @property integer $display_order
 */

class OphNuPostoperative_Vital extends BaseActiveRecordVersioned
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
		return 'ophnupostoperative_vital';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('hr_pulse, blood_pressure, rr, spo2, o2, pain_score, timestamp', 'safe'),
			array('hr_pulse, blood_pressure, rr, spo2, o2, pain_score, timestamp', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_id, offset, value, display_order', 'safe', 'on' => 'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hr_pulse' => 'HR / pulse',
			'blood_pressure' => 'Blood pressure',
			'rr' => 'RR',
			'spo2' => 'SpO2',
			'o2' => 'O2',
			'pain_score' => 'Pain score',
		);
	}

	public function getAttributeSuffix($attribute)
	{
		$suffixes = array(
			'hr_pulse' => 'mmHg',
			'blood_pressure' => 'bpm',
			'rr' => 'insp/min',
			'spo2' => '%',
		);

		return @$suffixes[$attribute];
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
		$criteria->compare('item_id', $this->item_id);
		$criteria->compare('record_time', $this->record_time);
		$criteria->compare('value', $this->value);
		$criteria->compare('display_order', $this->display_order);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

	public function beforeValidate()
	{

		if (isset($this->item) && strlen($this->value) >0) {
			$type=$this->item;
			if ($type->validation_regex) {
				if (!preg_match($type->validation_regex,$this->value)) {
					$this->addError('reading',"$type->validation_message");
				}
			} else {
				switch ($type->fieldType->name) {
					case 'Percentage':
						if (!ctype_digit($this->value) || $this->value <0 || $this->value >100) {
							$this->addError('reading','Must be 0-100');
						}
						break;
					case 'Integer':
						if (!ctype_digit($this->value)) {
							$this->addError('reading','Must be an integer');
						}
						break;
					case 'Temperature':
						if (!preg_match('/^[0-9]+(\.[0-9]+)?$/',$this->value) || $this->value < 15 || $this->value > 45) {
							$this->addError('reading','Temperature must be in the range 15-45°C');
						}
						break;
					case 'Decimal':
						if (!preg_match('/^\d*\.?\d*$/',$this->value)) {
							$this->addError('reading','Must be a decimal');
						}
						break;
				}
			}
		}

		return parent::beforeValidate();
	}
}
?>
