<?php

class m140723_165012_orb244 extends OEMigration
{
	public function up()
	{
		//$this->createElementType('Element_OphNuPostoperative_PatientIdentification', 'Patient Identification', array('display_order' => 1));
		$this->update(
			'element_type',array('name' => 'Handoff', 'class_name' => 'Element_OphNuPostoperative_Handoff'),
			"class_name='Element_OphNuPostoperative_Patient'"
		);

		$this->renameTable('et_ophnupostoperative_patient','et_ophnupostoperative_handoff');
		$this->renameTable('et_ophnupostoperative_patient_version','et_ophnupostoperative_handoff_version');

	}

	public function down()
	{
		//$this->delete('element_type',"class_name='Element_OphNuPostoperative_PatientIdentification'");
		$this->update(
			'element_type',array('name' => 'Patient', 'class_name' => 'Element_OphNuPostoperative_Patient'),
			"class_name='Element_OphNuPostoperative_Handoff'"
		);
		$this->renameTable('et_ophnupostoperative_handoff','et_ophnupostoperative_patient');
		$this->renameTable('et_ophnupostoperative_handoff_version','et_ophnupostoperative_patient_version');
	}
}
