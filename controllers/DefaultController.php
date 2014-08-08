<?php

class DefaultController extends BaseEventTypeController
{
	static protected $action_types = array(
		'dataTimes' => self::ACTION_TYPE_FORM,
		'validateProgressNote' => self::ACTION_TYPE_FORM,
		'validateVital' => self::ACTION_TYPE_FORM,
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

	protected function setElementDefaultOptions_Element_OphNuPostoperative_HandOff($element, $action)
	{
		if ($action == 'create') {
			$ts = time();

			while (date('i',$ts) != '00' && date('i',$ts) != '30') {
				$ts -= 60;
			}

			$element->patient_enters_recovery_room = date('H:i',$ts);
		}
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

	public function actionValidateVital()
	{
		$vital = new OphNuPostoperative_Vital;
		$vital->attributes = $_POST;

		$vital->validate();

		$errors = array();

		foreach ($vital->errors as $field => $error) {
			$errors[$field] = $error[0];
		}

		if (empty($errors)) {
			$vital->blood_pressure_m = array(
				'bp_systolic' => $vital->blood_pressure_m_systolic,
				'bp_diastolic' => $vital->blood_pressure_m_diastolic,
			);

			$vital->timestamp = date('Y-m-d',strtotime($vital->timestamp)).' '.$vital->time.':00';
			$errors['row'] = $this->renderPartial('_vital_row',array('item' => $vital, 'i' => $_POST['i'], 'edit' => true),true);
		}

		echo json_encode($errors);
	}

	protected function setComplexAttributes_Element_OphNuPostoperative_Vitals($element, $data, $index)
	{
		$vitals = array();

		if (!empty($data['OphNuPostoperative_Vital']['hr_pulse_m'])) {
			foreach ($data['OphNuPostoperative_Vital']['hr_pulse_m'] as $i => $hr_pulse) {
				if (!$data['OphNuPostoperative_Vital']['id'][$i] || !($vital = OphNuPostoperative_Vital::model()->findByPk($data['OphNuPostoperative_Vital']['id'][$i]))) {
					$vital = new OphNuPostoperative_Vital;
					$vital->element_id = $element->id;
				}

				$vital->hr_pulse_m = $hr_pulse;

				foreach (array('blood_pressure_m_systolic','blood_pressure_m_diastolic','rr_m','sao2_m','o2','pain_score_m','timestamp') as $field) {
					$vital->$field = $data['OphNuPostoperative_Vital'][$field][$i];
				}

				$vital->blood_pressure_m = array(
					'bp_systolic' => $vital->blood_pressure_m_systolic,
					'bp_diastolic' => $vital->blood_pressure_m_diastolic,
				);

				$vital->time = date('H:i',strtotime($vital->timestamp));

				$vitals[] = $vital;
			}
		}

		$element->vitals = $vitals;
	}

	protected function saveComplexAttributes_Element_OphNuPostoperative_Vitals($element, $data, $index)
	{
		$ids = array();

		foreach ($element->vitals as $vital) {
			$vital->element_id = $element->id;

			if (!$vital->save()) {
				throw new Exception("Unable to save vital item: ".print_r($vital->errors,true));
			}

			$ids[] = $vital->id;
		}

		$criteria = new CDbCriteria;
		$criteria->addCondition('element_id = :element_id');
		$criteria->params[':element_id'] = $element->id;

		if (!empty($ids)) {
			$criteria->addNotInCondition('id',$ids);
		}

		OphNuPostoperative_Vital::model()->deleteAll($criteria);
	}

	public function actionValidateProgressNote()
	{
		$note = new OphNuPostoperative_PostOperative_ProgressNotes;
		$note->comment_date = date('Y-m-d',strtotime($_POST['comment_date'])).' '.$_POST['time'].':00';
		$note->comment = $_POST['comment'];

		$errors = array();

		if (!$note->validate()) {
			foreach ($note->errors as $error) {
				$errors[] = $error[0];
			}
		}

		if (empty($errors)) {
			$errors['row'] = $this->renderPartial('_progress_notes_row',array('edit' => true, 'note' => $note, 'i' => (integer)$_POST['i']),true);
		}

		echo json_encode($errors);
	}

	protected function setComplexAttributes_Element_OphNuPostoperative_PostOperativeProgressNotes($element, $data, $index)
	{
		$notes = array();

		if (!empty($data['OphNuPostoperative_PostOperative_ProgressNotes']['comment_date'])) {
			foreach ($data['OphNuPostoperative_PostOperative_ProgressNotes']['comment_date'] as $i => $comment_date) {
				$note = new OphNuPostoperative_PostOperative_ProgressNotes;
				$note->comment_date = $comment_date;
				$note->comment = $data['OphNuPostoperative_PostOperative_ProgressNotes']['comment'][$i];

				$notes[] = $note;
			}
		}

		$element->progressnotes = $notes;
	}

	protected function saveComplexAttributes_Element_OphNuPostoperative_PostOperativeProgressNotes($element, $data, $index)
	{
		$ids = array();

		foreach ($element->progressnotes as $note) {
			$note->element_id = $element->id;

			if (!$note->save()) {
				throw new Exception("Unable to save progress note: ".print_r($note->errors,true));
			}

			$ids[] = $note->id;
		}

		$criteria = new CDbCriteria;
		$criteria->addCondition('element_id = :element_id');
		$criteria->params[':element_id'] = $element->id;

		if (!empty($ids)) {
			$criteria->addNotInCondition('id',$ids);
		}

		OphNuPostoperative_PostOperative_ProgressNotes::model()->deleteAll($criteria);
	}
}
