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
 * This is the model class for table "et_ophnupostoperative_postoperative".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property integer $fallsmobility
 * @property integer $removable_dental_id
 * @property string $other_comments
 * @property integer $hearing_aid_returned_id
 * @property integer $patent_belongings_returned
 * @property string $h_comments
 * @property string $s_comments
 * @property string $o_comments
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property OphNuPostoperative_PostOperative_Falls_Assignment $fallss
 * @property OphNuPostoperative_PostOperative_RemovableDental $removable_dental
 * @property OphNuPostoperative_PostOperative_Dental_Assignment $dentals
 * @property OphNuPostoperative_PostOperative_HearingAidReturned $hearing_aid_returned
 * @property OphNuPostoperative_PostOperative_Hearing_Assignment $hearings
 * @property OphNuPostoperative_PostOperative_Belongings_Assignment $belongingss
 * @property OphNuPostoperative_PostOperative_Skin_Assignment $skins
 * @property OphNuPostoperative_PostOperative_Obs_Assignment $obss
 */

class Element_OphNuPostoperative_PostOperative  extends  BaseEventTypeElement
{
	protected $auto_update_relations = true;

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
		return 'et_ophnupostoperative_postoperative';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('event_id, fallsmobility, removable_dental_id, other_comments, hearing_aid_returned_id, patent_belongings_returned, h_comments, s_comments, o_comments, falls, dentals, hearings, belongings, skins, obs', 'safe'),
			array('id, event_id, fallsmobility, removable_dental_id, other_comments, hearing_aid_returned_id, patent_belongings_returned, h_comments, s_comments, o_comments, ', 'safe', 'on' => 'search'),
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
			'falls' => array(self::HAS_MANY, 'OphNuPostoperative_PostOperative_Falls', 'fall_id', 'through' => 'falls_assignment'),
			'falls_assignment' => array(self::HAS_MANY, 'OphNuPostoperative_PostOperative_Falls_Assignment', 'element_id'),
			'removable_dental' => array(self::BELONGS_TO, 'OphNuPostoperative_PostOperative_RemovableDental', 'removable_dental_id'),
			'dentals' => array(self::HAS_MANY, 'OphNuPostoperative_PostOperative_Dental', 'dental_id', 'through' => 'dentals_assignment'),
			'dentals_assignment' => array(self::HAS_MANY, 'OphNuPostoperative_PostOperative_Dental_Assignment', 'element_id'),
			'hearing_aid_returned' => array(self::BELONGS_TO, 'OphNuPostoperative_PostOperative_HearingAidReturned', 'hearing_aid_returned_id'),
			'hearings' => array(self::HAS_MANY, 'OphNuPostoperative_PostOperative_Hearing', 'hearing_id', 'through' => 'hearings_assignment'),
			'hearings_assignment' => array(self::HAS_MANY, 'OphNuPostoperative_PostOperative_Hearing_Assignment', 'element_id'),
			'belongings' => array(self::HAS_MANY, 'OphNuPostoperative_PostOperative_Belongings', 'belonging_id', 'through' => 'belongings_assignment'),
			'belongings_assignment' => array(self::HAS_MANY, 'OphNuPostoperative_PostOperative_Belongings_Assignment', 'element_id'),
			'skins' => array(self::HAS_MANY, 'OphNuPostoperative_PostOperative_Skin', 'skin_id', 'through' => 'skins_assignment'),
			'skins_assignment' => array(self::HAS_MANY, 'OphNuPostoperative_PostOperative_Skin_Assignment', 'element_id'),
			'obs' => array(self::HAS_MANY, 'OphNuPostoperative_PostOperative_Obs', 'ob_id', 'through' => 'obs_assignment'),
			'obs_assignment' => array(self::HAS_MANY, 'OphNuPostoperative_PostOperative_Obs_Assignment', 'element_id'),
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
			'fallsmobility' => 'Falls/mobility',
			'falls' => 'Falls/mobility items',
			'removable_dental_id' => 'Removable dental work returned?',
			'dental' => 'Dental items returned',
			'other_comments' => 'Other dental items',
			'hearing_aid_returned_id' => 'Hearing aid returned?',
			'hearing' => 'Items returned',
			'patent_belongings_returned' => 'Patient belongings',
			'belongings' => 'Items returned',
			'h_comments' => 'Other belongings',
			'skin' => 'Skin assessment',
			's_comments' => 'Other skin notes',
			'obs' => 'Post-op observations',
			'o_comments' => 'Other post-op observations',
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
		$criteria->compare('fallsmobility', $this->fallsmobility);
		$criteria->compare('falls', $this->falls);
		$criteria->compare('removable_dental_id', $this->removable_dental_id);
		$criteria->compare('dental', $this->dental);
		$criteria->compare('other_comments', $this->other_comments);
		$criteria->compare('hearing_aid_returned_id', $this->hearing_aid_returned_id);
		$criteria->compare('hearing', $this->hearing);
		$criteria->compare('patent_belongings_returned', $this->patent_belongings_returned);
		$criteria->compare('belongings', $this->belongings);
		$criteria->compare('h_comments', $this->h_comments);
		$criteria->compare('skin', $this->skin);
		$criteria->compare('s_comments', $this->s_comments);
		$criteria->compare('obs', $this->obs);
		$criteria->compare('o_comments', $this->o_comments);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}

	public function beforeValidate()
	{
		if ($this->fallsmobility) {
			if (empty($this->falls)) {
				$this->addError('falls','Please enter at least one falls/mobility item');
			}
		}

		if ($this->removable_dental && $this->removable_dental->name == 'Yes') {
			if (empty($this->dentals)) {
				$this->addError('dentals','Please enter at least one dental item');
			}

			if ($this->hasMultiSelectValue('dentals','Other (please specify)')) {
				if (!$this->other_comments) {
					$this->addError('other_comments',$this->getAttributeLabel('other_comments').' cannot be blank.');
				}
			}
		}

		if ($this->hearing_aid_returned && $this->hearing_aid_returned->name == 'Yes') {
			if (empty($this->hearings)) {
				$this->addError('hearings','Please enter at least one hearing aid item');
			}
		}

		if ($this->patent_belongings_returned) {
			if (empty($this->belongings)) {
				$this->addError('belongings','Please enter at least one patient belonging');
			}

			if ($this->hasMultiSelectValue('belongings','Other (please specify)')) {
				if (!$this->h_comments) {
					$this->addError('h_comments',$this->getAttributeLabel('h_comments').' cannot be blank.');
				}
			}
		}

		if ($this->hasMultiSelectValue('skins','Other (please specify)')) {
			if (!$this->s_comments) {
				$this->addError('s_comments',$this->getAttributeLabel('s_comments').' cannot be blank.');
			}
		}

		if ($this->hasMultiSelectValue('obs','Other (please specify)')) {
			if (!$this->o_comments) {
				$this->addError('o_comments',$this->getAttributeLabel('o_comments').' cannot be blank.');
			}
		}

		return parent::beforeValidate();
	}
}
?>
