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
 * @property integer $removable_dental
 * @property integer $full_uppers
 * @property integer $full_lowers
 * @property integer $other
 * @property integer $full_uppers_returned
 * @property integer $ful_lowers_returned
 * @property integer $other_returned
 * @property string $other_comments
 * @property integer $hearing_aid_present
 * @property integer $h_right
 * @property integer $h_returned_right
 * @property integer $h_left
 * @property integer $h_returned_left
 * @property string $h_comments
 * @property string $s_comments
 * @property integer $o_comments
 * @property integer $eye_dressing_in_place
 * @property integer $iv_removed
 * @property integer $ecg_dots_removed
 * @property integer $take_home_ophthalmic
 * @property integer $instructions_given
 *
 * The followings are the available model relations:
 *
 * @property ElementType $element_type
 * @property EventType $eventType
 * @property Event $event
 * @property User $user
 * @property User $usermodified
 * @property Element_OphNuPostoperative_PostOperative_Falls_Assignment $fallss
 * @property Element_OphNuPostoperative_PostOperative_Belongings_Assignment $belongingss
 * @property Element_OphNuPostoperative_PostOperative_Skin_Assignment $skins
 * @property Element_OphNuPostoperative_PostOperative_Obs_Assignment $obss
 */

class Element_OphNuPostoperative_PostOperative  extends  BaseEventTypeElement
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
		return 'et_ophnupostoperative_postoperative';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('event_id, fallsmobility, removable_dental, full_uppers, full_lowers, other, full_uppers_returned, ful_lowers_returned, other_returned, other_comments, hearing_aid_present, h_right, h_returned_right, h_left, h_returned_left, h_comments, s_comments, o_comments, eye_dressing_in_place, iv_removed, ecg_dots_removed, take_home_ophthalmic, instructions_given, ', 'safe'),
			array('fallsmobility, removable_dental, full_uppers, full_lowers, other, full_uppers_returned, ful_lowers_returned, other_returned, other_comments, hearing_aid_present, h_right, h_returned_right, h_left, h_returned_left, h_comments, s_comments, o_comments, eye_dressing_in_place, iv_removed, ecg_dots_removed, take_home_ophthalmic, instructions_given, ', 'required'),
			array('id, event_id, fallsmobility, removable_dental, full_uppers, full_lowers, other, full_uppers_returned, ful_lowers_returned, other_returned, other_comments, hearing_aid_present, h_right, h_returned_right, h_left, h_returned_left, h_comments, s_comments, o_comments, eye_dressing_in_place, iv_removed, ecg_dots_removed, take_home_ophthalmic, instructions_given, ', 'safe', 'on' => 'search'),
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
			'fallss' => array(self::HAS_MANY, 'Element_OphNuPostoperative_PostOperative_Falls_Assignment', 'element_id'),
			'belongingss' => array(self::HAS_MANY, 'Element_OphNuPostoperative_PostOperative_Belongings_Assignment', 'element_id'),
			'skins' => array(self::HAS_MANY, 'Element_OphNuPostoperative_PostOperative_Skin_Assignment', 'element_id'),
			'obss' => array(self::HAS_MANY, 'Element_OphNuPostoperative_PostOperative_Obs_Assignment', 'element_id'),
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
			'fallsmobility' => 'Falls/Mobility',
			'falls' => 'Falls/mobility',
			'removable_dental' => 'Removable Dental work Present?',
			'full_uppers' => 'Full Uppers',
			'full_lowers' => 'Full lowers',
			'other' => 'Other',
			'full_uppers_returned' => 'Returned?',
			'ful_lowers_returned' => 'Returned?',
			'other_returned' => 'Returned?',
			'other_comments' => 'Comments',
			'hearing_aid_present' => 'Hearing aid present?',
			'h_right' => 'Right',
			'h_returned_right' => 'Returned?',
			'h_left' => 'Left',
			'h_returned_left' => 'Returned?',
			'belongings' => 'Patient Belongings',
			'h_comments' => 'Comments',
			'skin' => 'Skin Assessment',
			's_comments' => 'Comments',
			'obs' => 'Post-Op Observations',
			'o_comments' => 'Comments',
			'eye_dressing_in_place' => 'Eye dressing in place',
			'iv_removed' => 'IV Removed',
			'ecg_dots_removed' => 'ECG dots removed',
			'take_home_ophthalmic' => 'Take home ophthalmic medications and/or analgesics supplies',
			'instructions_given' => 'Post-op education and instructions given to patient',
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
		$criteria->compare('removable_dental', $this->removable_dental);
		$criteria->compare('full_uppers', $this->full_uppers);
		$criteria->compare('full_lowers', $this->full_lowers);
		$criteria->compare('other', $this->other);
		$criteria->compare('full_uppers_returned', $this->full_uppers_returned);
		$criteria->compare('ful_lowers_returned', $this->ful_lowers_returned);
		$criteria->compare('other_returned', $this->other_returned);
		$criteria->compare('other_comments', $this->other_comments);
		$criteria->compare('hearing_aid_present', $this->hearing_aid_present);
		$criteria->compare('h_right', $this->h_right);
		$criteria->compare('h_returned_right', $this->h_returned_right);
		$criteria->compare('h_left', $this->h_left);
		$criteria->compare('h_returned_left', $this->h_returned_left);
		$criteria->compare('belongings', $this->belongings);
		$criteria->compare('h_comments', $this->h_comments);
		$criteria->compare('skin', $this->skin);
		$criteria->compare('s_comments', $this->s_comments);
		$criteria->compare('obs', $this->obs);
		$criteria->compare('o_comments', $this->o_comments);
		$criteria->compare('eye_dressing_in_place', $this->eye_dressing_in_place);
		$criteria->compare('iv_removed', $this->iv_removed);
		$criteria->compare('ecg_dots_removed', $this->ecg_dots_removed);
		$criteria->compare('take_home_ophthalmic', $this->take_home_ophthalmic);
		$criteria->compare('instructions_given', $this->instructions_given);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}


	public function getophnupostoperative_postoperative_falls_defaults() {
		$ids = array();
		foreach (OphNuPostoperative_PostOperative_Falls::model()->findAll('`default` = ?',array(1)) as $item) {
			$ids[] = $item->id;
		}
		return $ids;
	}
	public function getophnupostoperative_postoperative_belongings_defaults() {
		$ids = array();
		foreach (OphNuPostoperative_PostOperative_Belongings::model()->findAll('`default` = ?',array(1)) as $item) {
			$ids[] = $item->id;
		}
		return $ids;
	}
	public function getophnupostoperative_postoperative_skin_defaults() {
		$ids = array();
		foreach (OphNuPostoperative_PostOperative_Skin::model()->findAll('`default` = ?',array(1)) as $item) {
			$ids[] = $item->id;
		}
		return $ids;
	}
	public function getophnupostoperative_postoperative_obs_defaults() {
		$ids = array();
		foreach (OphNuPostoperative_PostOperative_Obs::model()->findAll('`default` = ?',array(1)) as $item) {
			$ids[] = $item->id;
		}
		return $ids;
	}

	protected function afterSave()
	{
		if (!empty($_POST['MultiSelect_falls'])) {

			$existing_ids = array();

			foreach (Element_OphNuPostoperative_PostOperative_Falls_Assignment::model()->findAll('element_id = :elementId', array(':elementId' => $this->id)) as $item) {
				$existing_ids[] = $item->ophnupostoperative_postoperative_falls_id;
			}

			foreach ($_POST['MultiSelect_falls'] as $id) {
				if (!in_array($id,$existing_ids)) {
					$item = new Element_OphNuPostoperative_PostOperative_Falls_Assignment;
					$item->element_id = $this->id;
					$item->ophnupostoperative_postoperative_falls_id = $id;

					if (!$item->save()) {
						throw new Exception('Unable to save MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}

			foreach ($existing_ids as $id) {
				if (!in_array($id,$_POST['MultiSelect_falls'])) {
					$item = Element_OphNuPostoperative_PostOperative_Falls_Assignment::model()->find('element_id = :elementId and ophnupostoperative_postoperative_falls_id = :lookupfieldId',array(':elementId' => $this->id, ':lookupfieldId' => $id));
					if (!$item->delete()) {
						throw new Exception('Unable to delete MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}
		}
		if (!empty($_POST['MultiSelect_belongings'])) {

			$existing_ids = array();

			foreach (Element_OphNuPostoperative_PostOperative_Belongings_Assignment::model()->findAll('element_id = :elementId', array(':elementId' => $this->id)) as $item) {
				$existing_ids[] = $item->ophnupostoperative_postoperative_belongings_id;
			}

			foreach ($_POST['MultiSelect_belongings'] as $id) {
				if (!in_array($id,$existing_ids)) {
					$item = new Element_OphNuPostoperative_PostOperative_Belongings_Assignment;
					$item->element_id = $this->id;
					$item->ophnupostoperative_postoperative_belongings_id = $id;

					if (!$item->save()) {
						throw new Exception('Unable to save MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}

			foreach ($existing_ids as $id) {
				if (!in_array($id,$_POST['MultiSelect_belongings'])) {
					$item = Element_OphNuPostoperative_PostOperative_Belongings_Assignment::model()->find('element_id = :elementId and ophnupostoperative_postoperative_belongings_id = :lookupfieldId',array(':elementId' => $this->id, ':lookupfieldId' => $id));
					if (!$item->delete()) {
						throw new Exception('Unable to delete MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}
		}
		if (!empty($_POST['MultiSelect_skin'])) {

			$existing_ids = array();

			foreach (Element_OphNuPostoperative_PostOperative_Skin_Assignment::model()->findAll('element_id = :elementId', array(':elementId' => $this->id)) as $item) {
				$existing_ids[] = $item->ophnupostoperative_postoperative_skin_id;
			}

			foreach ($_POST['MultiSelect_skin'] as $id) {
				if (!in_array($id,$existing_ids)) {
					$item = new Element_OphNuPostoperative_PostOperative_Skin_Assignment;
					$item->element_id = $this->id;
					$item->ophnupostoperative_postoperative_skin_id = $id;

					if (!$item->save()) {
						throw new Exception('Unable to save MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}

			foreach ($existing_ids as $id) {
				if (!in_array($id,$_POST['MultiSelect_skin'])) {
					$item = Element_OphNuPostoperative_PostOperative_Skin_Assignment::model()->find('element_id = :elementId and ophnupostoperative_postoperative_skin_id = :lookupfieldId',array(':elementId' => $this->id, ':lookupfieldId' => $id));
					if (!$item->delete()) {
						throw new Exception('Unable to delete MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}
		}
		if (!empty($_POST['MultiSelect_obs'])) {

			$existing_ids = array();

			foreach (Element_OphNuPostoperative_PostOperative_Obs_Assignment::model()->findAll('element_id = :elementId', array(':elementId' => $this->id)) as $item) {
				$existing_ids[] = $item->ophnupostoperative_postoperative_obs_id;
			}

			foreach ($_POST['MultiSelect_obs'] as $id) {
				if (!in_array($id,$existing_ids)) {
					$item = new Element_OphNuPostoperative_PostOperative_Obs_Assignment;
					$item->element_id = $this->id;
					$item->ophnupostoperative_postoperative_obs_id = $id;

					if (!$item->save()) {
						throw new Exception('Unable to save MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}

			foreach ($existing_ids as $id) {
				if (!in_array($id,$_POST['MultiSelect_obs'])) {
					$item = Element_OphNuPostoperative_PostOperative_Obs_Assignment::model()->find('element_id = :elementId and ophnupostoperative_postoperative_obs_id = :lookupfieldId',array(':elementId' => $this->id, ':lookupfieldId' => $id));
					if (!$item->delete()) {
						throw new Exception('Unable to delete MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}
		}

		return parent::afterSave();
	}
}
?>