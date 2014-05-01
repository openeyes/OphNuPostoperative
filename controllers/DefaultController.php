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
		} else if ($element->id && $gas_level = OphCiAnaesthesiarecord_Gas_Level::model()->find('element_id=? and item_id=? and offset=?',array($element->id,$gas->id,$offset))) {
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

		if ($element->id && $dose = OphNuPreoperative_Drug_Dose::model()->find('element_id=? and item_id=? and offset=?',array($element->id,$drug->id,$offset))) {
			return $dose->value;
		}
	}

	public function getReadingItem($element, $reading_type, $offset)
	{
		if (!empty($_POST)) {
			return @$_POST['reading_'.$reading_type->id.'_'.$offset];
		}

		if ($element->id && $reading = OphNuPreoperative_Vital::model()->find('element_id=? and item_id=? and offset=?',array($element->id,$reading_type->id,$offset))) {
			return $reading->value;
		}
	}
}
