<?php

class m140520_075257_version_tables extends OEMigration
{
	public $tables = array(
		'et_ophnupostoperative_medicationadmin',
		'et_ophnupostoperative_patient',
		'et_ophnupostoperative_postoperative',
		'et_ophnupostoperative_postoperative_belongassign',
		'et_ophnupostoperative_postoperative_dental_assignment',
		'et_ophnupostoperative_postoperative_falls_assignment',
		'et_ophnupostoperative_postoperative_hearing_assignment',
		'et_ophnupostoperative_postoperative_obs_assignment',
		'et_ophnupostoperative_postoperative_skin_assignment',
		'et_ophnupostoperative_progressnote',
		'et_ophnupostoperative_vitals',
		'ophnupostoperative_medicationadmin_medication',
		'ophnupostoperative_patient_allergy',
		'ophnupostoperative_patient_identifier',
		'ophnupostoperative_patient_identifier_assignment',
		'ophnupostoperative_patient_translator_present',
		'ophnupostoperative_postoperative_belongings',
		'ophnupostoperative_postoperative_dental',
		'ophnupostoperative_postoperative_falls',
		'ophnupostoperative_postoperative_hearing',
		'ophnupostoperative_postoperative_hearing_aid_returned',
		'ophnupostoperative_postoperative_obs',
		'ophnupostoperative_postoperative_removable_dental',
		'ophnupostoperative_postoperative_skin',
		'ophnupostoperative_vital',
		'ophnupostoperative_vital_type',
		'ophnupostoperative_vital_type_field_type',
		'ophnupostoperative_vital_type_field_type_option',
		'ophnupostoperative_vitals_drug',
		'ophnupostoperative_vitals_drug_dose',
		'ophnupostoperative_vitals_gas',
		'ophnupostoperative_vitals_gas_field_type',
		'ophnupostoperative_vitals_gas_level',
	);

	public function up()
	{
		foreach ($this->tables as $table) {
			$this->versionExistingTable($table);
		}
	}

	public function down()
	{
		foreach ($this->tables as $table) {
			$this->dropTable($table.'_version');
		}
	}
}
