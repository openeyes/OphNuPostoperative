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
	}

	protected function saveComplexAttributes_Element_OphNuPostoperative_Patient($element, $data, $index)
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

	public function actionValidateRecordItem()
	{
		$vital = new OphNuPostoperative_Vital;
		$vital->attributes = $_POST;
	}
}
