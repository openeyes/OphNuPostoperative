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
	public $time;
	public $auto_update_measurements = true;

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
			array('hr_pulse_m, blood_pressure_m, rr_m, spo2_m, o2, pain_score_m, timestamp, time', 'safe'),
			array('hr_pulse_m, blood_pressure_m, rr_m, spo2_m, o2, pain_score_m, timestamp', 'required'),
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
			'hr_pulse_m' => array(self::BELONGS_TO, 'MeasurementPulse', 'hr_pulse_m_id'),
			'blood_pressure_m' => array(self::BELONGS_TO, 'MeasurementBloodPressure', 'blood_pressure_m_id'),
			'rr_m' => array(self::BELONGS_TO, 'MeasurementRespiratoryRate', 'rr_m_id'),
			'spo2_m' => array(self::BELONGS_TO, 'MeasurementSPO2', 'spo2_m_id'),
			'pain_score_m' => array(self::BELONGS_TO, 'MeasurementPainScore', 'pain_score_m_id'),
			'element' => array(self::BELONGS_TO, 'Element_OphNuPostoperative_Vitals', 'element_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id', 'through' => 'element'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'hr_pulse_m' => 'HR / pulse',
			'blood_pressure_m' => 'Blood pressure',
			'rr_m' => 'RR',
			'spo2_m' => 'SpO2',
			'o2' => 'O2',
			'pain_score_m' => 'Pain score',
		);
	}

	public function getAttributeSuffix($attribute)
	{
		$suffixes = array(
			'hr_pulse_m' => 'bpm',
			'blood_pressure_m' => 'mmHg',
			'rr_m' => 'insp/min',
			'spo2_m' => '%',
			'o2' => 'L/min',
		);

		return @$suffixes[$attribute];
	}

	public function afterFind()
	{
		if ($this->timestamp) {
			$this->time = date('H:i',strtotime($this->timestamp));
		}

		return parent::afterFind();
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

	public function getDescription()
	{
		return "Pulse: ".$this->hr_pulse_m." mmHh, BP: ".$this->blood_pressure_m." bpm, RR: ".$this->rr_m." insp/min, SpO2: ".$this->spo2_m."%, O2: ".$this->o2." L/min, pain score: ".$this->pain_score_m;
	}
}
