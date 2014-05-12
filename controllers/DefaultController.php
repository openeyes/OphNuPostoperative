<?php

class DefaultController extends BaseEventTypeController
{
	static protected $action_types = array(
		'validateNote' => self::ACTION_TYPE_FORM,
		'dataTimes' => self::ACTION_TYPE_FORM,
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

	public function actionValidateNote($id)
	{
		$notes = new Element_OphNuPostoperative_PostOperativeProgressNote();

		$errors = array();

		if (!$notes->validate()) {
			foreach ($notes->getErrors() as $error) {
				$errors[] = $error[0];
			}
		}

		if (!empty($errors)) {
			echo json_encode(array(
					'status' => 'error',
					'errors' => $errors,
			));
		} else {
			echo json_encode(array(
					'status' => 'ok',
					'row' => $this->renderPartial('_notes_row',array('notes' => $notes,'time' => '13:37', 'edit' => true),true),
			));
		}
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

	protected function setElementDefaultOptions_Element_OphNuPostoperative_Patient($element, $action)
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

	protected function setComplexAttributes_Element_OphNuPostoperative_Patient($element, $data, $index)
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

		$identifiers = array();

		if (!empty($data['MultiSelect_identifiers'])) {
			foreach ($data['MultiSelect_identifiers'] as $identifier_id) {
				$assignment = new OphNuPostoperative_Patient_Identifier_Assignment;
				$assignment->identifier_id = $identifier_id;

				$identifiers[] = $assignment;
			}
		}

		$element->identifiers = $identifiers;
	}

	protected function saveComplexAttributes_Element_OphNuPostoperative_Patient($element, $data, $index)
	{
		$element->updateAllergies(empty($data['allergies_allergies']) ? array() : $data['allergies_allergies']);

		$element->updateMultiSelectData('OphNuPostoperative_Patient_Identifier_Assignment',empty($data['MultiSelect_identifiers']) ? array() : $data['MultiSelect_identifiers'],'identifier_id');
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

	protected function setComplexAttributes_Element_OphNuPostoperative_PostOperative($element, $data, $index)
	{
		$falls = array();

		if (!empty($data['MultiSelect_falls'])) {
			foreach ($data['MultiSelect_falls'] as $fall_id) {
				$fall = new Element_OphNuPostoperative_PostOperative_Falls_Assignment;
				$fall->ophnupostoperative_postoperative_falls_id = $fall_id;

				$falls[] = $fall;
			}
		}

		$element->fallss = $falls;

		$dentals = array();

		if (!empty($data['MultiSelect_dental'])) {
			foreach ($data['MultiSelect_dental'] as $dental_id) {
				$dental = new Element_OphNuPostoperative_PostOperative_Dental_Assignment;
				$dental->ophnupostoperative_postoperative_dental_id = $dental_id;

				$dentals[] = $dental;
			}
		}

		$element->dentals = $dentals;

		$hearings = array();

		if (!empty($data['MultiSelect_hearing'])) {
			foreach ($data['MultiSelect_hearing'] as $hearing_id) {
				$hearing = new Element_OphNuPostoperative_PostOperative_Hearing_Assignment;
				$hearing->ophnupostoperative_postoperative_hearing_id = $hearing_id;

				$hearings[] = $hearing;
			}
		}

		$element->hearings = $hearings;

		$belongings = array();

		if (!empty($data['MultiSelect_belongings'])) {
			foreach ($data['MultiSelect_belongings'] as $belonging_id) {
				$belonging = new Element_OphNuPostoperative_PostOperative_Belongings_Assignment;
				$belonging->ophnupostoperative_postoperative_belongings_id = $belonging_id;

				$belongings[] = $belonging;
			}
		}

		$element->belongingss = $belongings;

		$skins = array();

		if (!empty($data['MultiSelect_skin'])) {
			foreach ($data['MultiSelect_skin'] as $skin_id) {
				$skin = new Element_OphNuPostoperative_PostOperative_Skin_Assignment;
				$skin->ophnupostoperative_postoperative_skin_id = $skin_id;

				$skins[] = $skin;
			}
		}

		$element->skins = $skins;

		$obs = array();

		if (!empty($data['MultiSelect_obs'])) {
			foreach ($data['MultiSelect_obs'] as $obs_id) {
				$ob = new Element_OphNuPostoperative_PostOperative_Obs_Assignment;
				$ob->ophnupostoperative_postoperative_obs_id = $obs_id;

				$obs[] = $ob;
			}
		}

		$element->obss = $obs;
	}

	protected function saveComplexAttributes_Element_OphNuPostoperative_PostOperative($element, $data, $index)
	{
		$element->updateMultiSelectData('Element_OphNuPostoperative_PostOperative_Falls_Assignment',empty($data['MultiSelect_falls']) ? array() : $data['MultiSelect_falls'],'ophnupostoperative_postoperative_falls_id');
		$element->updateMultiSelectData('Element_OphNuPostoperative_PostOperative_Dental_Assignment',empty($data['MultiSelect_dental']) ? array() : $data['MultiSelect_dental'],'ophnupostoperative_postoperative_dental_id');
		$element->updateMultiSelectData('Element_OphNuPostoperative_PostOperative_Hearing_Assignment',empty($data['MultiSelect_hearing']) ? array() : $data['MultiSelect_hearing'],'ophnupostoperative_postoperative_hearing_id');
		$element->updateMultiSelectData('Element_OphNuPostoperative_PostOperative_Belongings_Assignment',empty($data['MultiSelect_belongings']) ? array() : $data['MultiSelect_belongings'],'ophnupostoperative_postoperative_belongings_id');
		$element->updateMultiSelectData('Element_OphNuPostoperative_PostOperative_Skin_Assignment',empty($data['MultiSelect_skin']) ? array() : $data['MultiSelect_skin'],'ophnupostoperative_postoperative_skin_id');
		$element->updateMultiSelectData('Element_OphNuPostoperative_PostOperative_Obs_Assignment',empty($data['MultiSelect_obs']) ? array() : $data['MultiSelect_obs'],'ophnupostoperative_postoperative_obs_id');
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
