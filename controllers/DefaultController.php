<?php

class DefaultController extends BaseEventTypeController
{

	static protected $action_types = array('validateNote' => self::ACTION_TYPE_FORM);

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


	protected function setElementDefaultOptions_Element_OphNuPostoperative_Vitals($element, $action)
	{
		if ($action == 'create') {

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


	public function getGasItem($element, $gas, $offset)
	{
		if (!empty($_POST)) {
			$value = @$_POST['gas_level_'.$gas->id.'_'.$offset];

			return array(
					'colour' => $gas->getColourForValue($value),
					'level' => $value,
			);
		} else if ($element->id && $gas_level = OphNuPostoperative_Vitals_Gas_Level::model()->find('element_id=? and item_id=? and offset=?',array($element->id,$gas->id,$offset))) {
			$value = $gas_level->value;

			return array(
					'colour' => $gas->getColourForValue($value),
					'level' => $value,
			);
		}
	}

	public function getDrugItem($element, $drug, $offset)
	{
		if (!empty($_POST)) {
			return @$_POST['drug_'.$drug->id.'_'.$offset];
		}

		if ($element->id && $dose = OphNuPostoperative_Vitals_Drug_Dose::model()->find('element_id=? and item_id=? and offset=?',array($element->id,$drug->id,$offset))) {
			return $dose->value;
		}
	}

	public function getReadingItem($element, $reading_type, $offset)
	{
		if (!empty($_POST)) {
			return @$_POST['reading_'.$reading_type->id.'_'.$offset];
		}

		if ($element->id && $reading = OphNuPostoperative_Vital::model()->find('element_id=? and item_id=? and offset=?',array($element->id,$reading_type->id,$offset))) {
			return $reading->value;
		}
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
}
