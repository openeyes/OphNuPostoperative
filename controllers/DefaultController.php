<?php

class DefaultController extends BaseEventTypeController
{

	static protected $action_types = array(
		'dataTimes' => self::ACTION_TYPE_FORM,
		'addProgressNote' => self::ACTION_TYPE_FORM,
	);

	public function actionCreate()
	{
		parent::actionCreate();
	}

	public function actionUpdate($id)
	{
		parent::actionUpdate($id);
	}

	public function actionView($id)
	{
		parent::actionView($id);
	}

	public function actionPrint($id)
	{
		parent::actionPrint($id);
	}

	public function actionAddProgressNote()
	{
		$this->renderPartial('_progress_notes_row',array(
				'id'=>'',
				'full_time'=> date('Y-m-d H:i:s'),
				'note'=>$_POST['new_progress_note'],
				'edit'=>true,
		));
	}

	/**
	* use the split event type javascript and styling
	*
	* @param CAction $action
	* @return bool
	*/
	protected function beforeAction($action)
	{
		Yii::app()->assetManager->registerScriptFile('js/spliteventtype.js', null, null, AssetManager::OUTPUT_SCREEN);
		return parent::beforeAction($action);
	}

	protected function setElementDefaultOptions_Element_OphNuPostoperative_Handoff($element, $action)
	{
		if ($action == 'create') {
			$allergies = array();

			foreach ($this->patient->allergies as $allergy) {
				$_allergy = new OphNuPostoperative_Patient_Allergy;
				$_allergy->allergy_id = $allergy->id;

				$allergies[] = $_allergy;
			}

			$element->allergies = $allergies;

			$ts = time();

			while (date('i',$ts) != '00' && date('i',$ts) != '30') {
				$ts -= 60;
			}

			$element->patient_enters_recovery_room = date('H:i',$ts);
		}
	}

	protected function setComplexAttributes_Element_OphNuPostoperative_Handoff($element, $data, $index)
	{
		$allergies = array();

		if (!empty($data['allergies_allergies'])) {
			foreach ($data['allergies_allergies'] as $i => $allergy_id) {
				$allergy = new OphNuPostoperative_Patient_Allergy;
				$allergy->allergy_id = $allergy_id;

				$allergies[] = $allergy;
			}
		}

		$element->allergies = $allergies;
	}

	protected function saveComplexAttributes_Element_OphNuPostoperative_Handoff($element, $data, $index)
	{
		$element->updateAllergies(empty($data['allergies_allergies']) ? array() : $data['allergies_allergies']);
	}

	protected function setElementDefaultOptions_Element_OphNuPostoperative_MedicationAdministration($element, $action)
	{
		if ($action == 'create') {
			$medications = array();

			foreach ($this->patient->medications as $medication) {
				$_medication = new OphNuPostoperative_MedicationAdministration_Medication;

				foreach (array('drug_id','route_id','option_id','frequency_id','start_date') as $field) {
					$_medication->$field = $medication->$field;
				}

				$medications[] = $_medication;
			}

			$element->medications = $medications;
		}
	}

	protected function saveComplexAttributes_Element_OphNuPostoperative_PostOperativeProgressNotes($element, $data, $index)
	{
		if(empty($data['progress_notes_ids'])) {
		$element->updateProgressNotes();
		}
		else{
			$element->updateProgressNotes($data['progress_notes_ids'],$data['progress_notes_time'],$data['progress_notes_note']);
		}
	}

	protected function setComplexAttributes_Element_OphNuPostoperative_MedicationAdministration($element, $data, $index)
	{
		$medications = array();

		if (!empty($data['medication_history_drug_ids'])) {
			foreach ($data['medication_history_drug_ids'] as $i => $drug_id) {
				$medication = new OphNuPostoperative_MedicationAdministration_Medication;
				$medication->drug_id = $drug_id;
				$medication->route_id = $data['medication_history_route_ids'][$i];
				$medication->option_id = $data['medication_history_option_ids'][$i];
				$medication->frequency_id = $data['medication_history_frequency_ids'][$i];
				$medication->start_date = $data['medication_history_start_dates'][$i];

				$medications[] = $medication;
			}
		}

		$element->medications = $medications;
	}

	protected function saveComplexAttributes_Element_OphNuPostoperative_MedicationAdministration($element, $data, $index)
	{
		if (empty($data['medication_history_drug_ids'])) {
			$element->updateMedications();
		} else {
			$element->updateMedications($data['medication_history_medication_ids'],$data['medication_history_drug_ids'],$data['medication_history_route_ids'],$data['medication_history_option_ids'],$data['medication_history_frequency_ids'],$data['medication_history_start_dates']);
		}
	}

	protected function setElementDefaultOptions_Element_OphNuPostoperative_Vitals($element, $action)
	{
		if ($action == 'create') {
			$element->reading_items = $element->populateMissingGridItems(array(), 'OphNuPostoperative_Vital_Type');
			$element->drug_items = $element->populateMissingGridItems(array(), 'OphNuPostoperative_Vitals_Drug');
			$element->gas_items = $element->populateMissingGridItems(array(), 'OphNuPostoperative_Vitals_Gas');

			$ts = time();

			while (date('i',$ts) != '00' && date('i',$ts) != '30') {
				$ts -= 60;
			}

			$element->anaesthesia_start_time = date('H:i',$ts);
		}
	}

	protected function setComplexAttributes_Element_OphNuPostoperative_Vitals($element, $data, $index)
	{
		$reading_items = array();
		$drug_items = array();
		$gas_items = array();

		$readings = array();
		$drug_doses = array();
		$gas_levels = array();

		foreach ($data as $key => $value) {
			if (preg_match('/^reading_([0-9]+)_([0-9]+)$/',$key,$m)) {
				$reading_items[$m[1]][$m[2]] = $value;

				$reading = new OphNuPostoperative_Vital;
				$reading->item_id = $m[1];
				$reading->offset = $m[2];
				$reading->value = $value;

				$readings[] = $reading;
			}
			if (preg_match('/^drug_([0-9]+)_([0-9]+)$/',$key,$m)) {
				$drug_items[$m[1]][$m[2]] = $value;

				$drug_dose = new OphNuPostoperative_Vitals_Drug_Dose;
				$drug_dose->item_id = $m[1];
				$drug_dose->offset = $m[2];
				$drug_dose->value = $value;

				$drug_doses[] = $drug_dose;
			}
			if (preg_match('/^gas_level_([0-9]+)_([0-9]+)$/',$key,$m)) {
				$gas_items[$m[1]][$m[2]] = $value;

				$gas_level = new OphNuPostoperative_Vitals_Gas_Level;
				$gas_level->item_id = $m[1];
				$gas_level->offset = $m[2];
				$gas_level->value = $value;

				$gas_levels[] = $gas_level;
			}
		}

		$element->reading_items = $element->populateMissingGridItems($reading_items, 'OphNuPostoperative_Vital_Type');
		$element->drug_items = $element->populateMissingGridItems($drug_items, 'OphNuPostoperative_Vitals_Drug');
		$element->gas_items = $element->populateMissingGridItems($gas_items, 'OphNuPostoperative_Vitals_Gas');

		$element->drugs = $drug_doses;
		$element->readings = $readings;
		$element->gas_levels = $gas_levels;
	}

	protected function saveComplexAttributes_Element_OphNuPostoperative_Vitals($element, $data, $index)
	{
		$reading_items = array();
		$drug_items = array();
		$gas_items = array();

		foreach ($data as $key => $value) {
			if (preg_match('/^reading_([0-9]+)_([0-9]+)$/',$key,$m)) {
				$reading_items[$m[1]][$m[2]] = $value;
			} 
			if (preg_match('/^drug_([0-9]+)_([0-9]+)$/',$key,$m)) {
				$drug_items[$m[1]][$m[2]] = $value;
			}
			if (preg_match('/^gas_level_([0-9]+)_([0-9]+)$/',$key,$m)) {
				$gas_items[$m[1]][$m[2]] = $value;
			}
		}

		$element->reading_items = $element->populateMissingGridItems($reading_items, 'OphNuPostoperative_Vital_Type');
		$element->drug_items = $element->populateMissingGridItems($drug_items, 'OphNuPostoperative_Vitals_Drug');
		$element->gas_items = $element->populateMissingGridItems($gas_items, 'OphNuPostoperative_Vitals_Gas');

		foreach ($reading_items as $item_id => $_reading_items) {
			foreach ($_reading_items as $offset => $value) {
				if ($element->vitalsOffsetHasData($offset)) {
					if (!$item = OphNuPostoperative_Vital::model()->find('element_id=? and item_id=? and offset=?',array($element->id, $item_id, $offset))) {
						$item = new OphNuPostoperative_Vital;
						$item->element_id = $element->id;
						$item->item_id = $item_id;
						$item->offset = $offset;
					}

					$item->value = $value;

					if (!$item->save()) {
						throw new Exception("Unable to save vital item: ".print_r($item->getErrors(),true));
					}
				}
			}
		}

		foreach ($drug_items as $item_id => $_drug_items) {
			foreach ($_drug_items as $offset => $value) {
				if ($element->vitalsOffsetHasData($offset)) {
					if (!$item = OphNuPostoperative_Vitals_Drug_Dose::model()->find('element_id=? and item_id=? and offset=?',array($element->id, $item_id, $offset))) {
						$item = new OphNuPostoperative_Vitals_Drug_Dose;
						$item->element_id = $element->id;
						$item->item_id = $item_id;
						$item->offset = $offset;
					}

					$item->value = $value;

					if (!$item->save()) {
						throw new Exception("Unable to save dose item: ".print_r($item->getErrors(),true));
					}
				}
			}
		}

		foreach ($gas_items as $item_id => $_gas_items) {
			foreach ($_gas_items as $offset => $value) {
				if ($element->vitalsOffsetHasData($offset)) {
					if (!$item = OphNuPostoperative_Vitals_Gas_Level::model()->find('element_id=? and item_id=? and offset=?',array($element->id, $item_id, $offset))) {
						$item = new OphNuPostoperative_Vitals_Gas_Level;
						$item->element_id = $element->id;
						$item->item_id = $item_id;
						$item->offset = $offset;
					}

					$item->value = $value;

					if (!$item->save()) {
						throw new Exception("Unable to save gas item: ".print_r($item->getErrors(),true));
					}
				}
			}
		}
	}

	public function actionDataTimes()
	{
		$start_time = @$_POST['start_time'];

		if (!preg_match('/^([0-9]{1,2}):([0-9]{2})$/',$start_time,$m) || $m[1] > 23 || $m[2] > 59) {
			echo json_encode(array(
				'status' => 'error',
				'message' => 'Invalid time format',
			));
		} else {
			$element = new Element_OphNuPostoperative_Vitals;
			$element->anaesthesia_start_time = $start_time;

			echo json_encode(array(
				'status' => 'success',
				'start_time' => $start_time,
				'html' => $this->renderPartial('_grid_data_times',array('element' => $element),true),
			));
		}
	}
}
