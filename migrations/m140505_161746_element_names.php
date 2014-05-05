<?php

class m140505_161746_element_names extends CDbMigration
{
	public function up()
	{
		$this->update('element_type',array('name' => 'Medication administration'),"class_name = 'Element_OphNuPostoperative_MedicationAdministration'");
		$this->update('element_type',array('name' => 'Post operative progress notes'),"class_name = 'Element_OphNuPostoperative_PostOperativeProgressNotes'");
		$this->update('element_type',array('name' => 'Post operative'),"class_name = 'Element_OphNuPostoperative_PostOperative'");
	}

	public function down()
	{
		$this->update('element_type',array('name' => 'Medication Administration'),"class_name = 'Element_OphNuPostoperative_MedicationAdministration'");
		$this->update('element_type',array('name' => 'Post Operative Progress Notes'),"class_name = 'Element_OphNuPostoperative_PostOperativeProgressNotes'");
		$this->update('element_type',array('name' => 'Post Operative'),"class_name = 'Element_OphNuPostoperative_PostOperative'");
	}
}
