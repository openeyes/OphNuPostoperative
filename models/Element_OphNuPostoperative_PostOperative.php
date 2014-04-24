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
 * @property Element_OphNuPostoperative_PostOperative_Falls_Assignment $fallss
 * @property OphNuPostoperative_PostOperative_RemovableDental $removable_dental
 * @property Element_OphNuPostoperative_PostOperative_Dental_Assignment $dentals
 * @property OphNuPostoperative_PostOperative_HearingAidReturned $hearing_aid_returned
 * @property Element_OphNuPostoperative_PostOperative_Hearing_Assignment $hearings
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
			array('event_id, fallsmobility, removable_dental_id, other_comments, hearing_aid_returned_id, patent_belongings_returned, h_comments, s_comments, o_comments, ', 'safe'),
			array('fallsmobility, removable_dental_id, hearing_aid_returned_id, patent_belongings_returned, ', 'required'),
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
			'fallss' => array(self::HAS_MANY, 'Element_OphNuPostoperative_PostOperative_Falls_Assignment', 'element_id'),
			'removable_dental' => array(self::BELONGS_TO, 'OphNuPostoperative_PostOperative_RemovableDental', 'removable_dental_id'),
			'dentals' => array(self::HAS_MANY, 'Element_OphNuPostoperative_PostOperative_Dental_Assignment', 'element_id'),
			'hearing_aid_returned' => array(self::BELONGS_TO, 'OphNuPostoperative_PostOperative_HearingAidReturned', 'hearing_aid_returned_id'),
			'hearings' => array(self::HAS_MANY, 'Element_OphNuPostoperative_PostOperative_Hearing_Assignment', 'element_id'),
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
			'removable_dental_id' => 'Removable Dental work Returned?',
			'dental' => 'Items returned',
			'other_comments' => 'Comments',
			'hearing_aid_returned_id' => 'Hearing aid returned?',
			'hearing' => 'Items Returned',
			'patent_belongings_returned' => 'Patent Belongings Returned?',
			'belongings' => 'Items Returned',
			'h_comments' => 'Comments',
			'skin' => 'Skin Assessment',
			's_comments' => 'Comments',
			'obs' => 'Post-Op Observations',
			'o_comments' => 'Comments',
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


	public function getophnupostoperative_postoperative_falls_defaults() {
		$ids = array();
		foreach (OphNuPostoperative_PostOperative_Falls::model()->findAll('`default` = ?',array(1)) as $item) {
			$ids[] = $item->id;
		}
		return $ids;
	}
	public function getophnupostoperative_postoperative_dental_defaults() {
		$ids = array();
		foreach (OphNuPostoperative_PostOperative_Dental::model()->findAll('`default` = ?',array(1)) as $item) {
			$ids[] = $item->id;
		}
		return $ids;
	}
	public function getophnupostoperative_postoperative_hearing_defaults() {
		$ids = array();
		foreach (OphNuPostoperative_PostOperative_Hearing::model()->findAll('`default` = ?',array(1)) as $item) {
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
		if (!empty($_POST['MultiSelect_dental'])) {

			$existing_ids = array();

			foreach (Element_OphNuPostoperative_PostOperative_Dental_Assignment::model()->findAll('element_id = :elementId', array(':elementId' => $this->id)) as $item) {
				$existing_ids[] = $item->ophnupostoperative_postoperative_dental_id;
			}

			foreach ($_POST['MultiSelect_dental'] as $id) {
				if (!in_array($id,$existing_ids)) {
					$item = new Element_OphNuPostoperative_PostOperative_Dental_Assignment;
					$item->element_id = $this->id;
					$item->ophnupostoperative_postoperative_dental_id = $id;

					if (!$item->save()) {
						throw new Exception('Unable to save MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}

			foreach ($existing_ids as $id) {
				if (!in_array($id,$_POST['MultiSelect_dental'])) {
					$item = Element_OphNuPostoperative_PostOperative_Dental_Assignment::model()->find('element_id = :elementId and ophnupostoperative_postoperative_dental_id = :lookupfieldId',array(':elementId' => $this->id, ':lookupfieldId' => $id));
					if (!$item->delete()) {
						throw new Exception('Unable to delete MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}
		}
		if (!empty($_POST['MultiSelect_hearing'])) {

			$existing_ids = array();

			foreach (Element_OphNuPostoperative_PostOperative_Hearing_Assignment::model()->findAll('element_id = :elementId', array(':elementId' => $this->id)) as $item) {
				$existing_ids[] = $item->ophnupostoperative_postoperative_hearing_id;
			}

			foreach ($_POST['MultiSelect_hearing'] as $id) {
				if (!in_array($id,$existing_ids)) {
					$item = new Element_OphNuPostoperative_PostOperative_Hearing_Assignment;
					$item->element_id = $this->id;
					$item->ophnupostoperative_postoperative_hearing_id = $id;

					if (!$item->save()) {
						throw new Exception('Unable to save MultiSelect item: '.print_r($item->getErrors(),true));
					}
				}
			}

			foreach ($existing_ids as $id) {
				if (!in_array($id,$_POST['MultiSelect_hearing'])) {
					$item = Element_OphNuPostoperative_PostOperative_Hearing_Assignment::model()->find('element_id = :elementId and ophnupostoperative_postoperative_hearing_id = :lookupfieldId',array(':elementId' => $this->id, ':lookupfieldId' => $id));
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