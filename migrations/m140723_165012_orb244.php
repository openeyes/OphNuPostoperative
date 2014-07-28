<?php

class m140723_165012_orb244 extends OEMigration
{
	public function up()
	{
		$this->update('element_type',
			array('display_order' => new CDbExpression('display_order + 1') ) ,
			"class_name like 'Element_OphNuPostoperative%'"
		);
		$this->createElementType('OphNuPostoperative', 'Patient Identification', array('display_order' => 1, 'default' => 1));
		$this->createOETable(
			'et_ophnupostoperative_patientidentification',
			array(
				'id' => 'pk',
				'event_id' => 'int(10) unsigned NOT NULL',
				'patient_id_verified_with_two_identifiers' => 'tinyint(1) unsigned NOT NULL',
				'allergies_verified' => 'tinyint(1) unsigned NOT NULL',
				'translator_present_id' => 'int(10) unsigned NOT NULL',
				'name_of_translator' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',
				'patient_has_no_allergies' => 'tinyint(1) unsigned NOT NULL',
				'CONSTRAINT `et_ophciexam_patient_identification_e_id_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophciexam_patient_identification_trans_pres_id_fk` FOREIGN KEY (`translator_present_id`) REFERENCES `ophnupostoperative_patient_translator_present` (`id`)',
			),
			true
		);

		$this->dbConnection->createCommand(
			"insert into et_ophnupostoperative_patientidentification
			(event_id, patient_id_verified_with_two_identifiers, allergies_verified, translator_present_id, name_of_translator, patient_has_no_allergies)
			select event_id, patient_id_verified_with_two_identifiers, allergies_verified, translator_present_id, name_of_translator, patient_has_no_allergies
			from et_ophnupostoperative_patient"
		)->execute();

		$this->dropForeignKey('ophnupostoperative_patient_translator_present_fk', 'et_ophnupostoperative_patient');

		$this->dropColumn('et_ophnupostoperative_patient', 'patient_id_verified_with_two_identifiers');
		$this->dropColumn('et_ophnupostoperative_patient', 'allergies_verified');
		$this->dropColumn('et_ophnupostoperative_patient', 'translator_present_id');
		$this->dropColumn('et_ophnupostoperative_patient', 'name_of_translator');
		$this->dropColumn('et_ophnupostoperative_patient', 'patient_has_no_allergies');

		$this->dropColumn('et_ophnupostoperative_patient_version', 'patient_id_verified_with_two_identifiers');
		$this->dropColumn('et_ophnupostoperative_patient_version', 'allergies_verified');
		$this->dropColumn('et_ophnupostoperative_patient_version', 'translator_present_id');
		$this->dropColumn('et_ophnupostoperative_patient_version', 'name_of_translator');
		$this->dropColumn('et_ophnupostoperative_patient_version', 'patient_has_no_allergies');


		$this->update(
			'element_type',
			array('name' => 'Handoff', 'class_name' => 'Element_OphNuPostoperative_Handoff'),
			"class_name='Element_OphNuPostoperative_Patient'"
		);

		$this->renameTable('et_ophnupostoperative_patient','et_ophnupostoperative_handoff');
		$this->renameTable('et_ophnupostoperative_patient_version','et_ophnupostoperative_handoff_version');

	}

	public function down()
	{
		$this->delete('element_type',"class_name='Element_OphNuPostoperative_PatientIdentification'");

		$this->update('element_type',array('display_order' => new CDbExpression('display_order - 1') ) ,
			"class_name like 'Element_OphNuPostoperative%'"
		);
		$this->update(
			'element_type',array('name' => 'Patient', 'class_name' => 'Element_OphNuPostoperative_Patient'),
			"class_name='Element_OphNuPostoperative_Handoff'"
		);

		$this->renameTable('et_ophnupostoperative_handoff','et_ophnupostoperative_patient');
		$this->renameTable('et_ophnupostoperative_handoff_version','et_ophnupostoperative_patient_version');

		//re-add columns

		$this->addColumn('et_ophnupostoperative_patient', 'patient_id_verified_with_two_identifiers', 'tinyint(1) unsigned NOT NULL');
		$this->addColumn('et_ophnupostoperative_patient', 'allergies_verified', 'tinyint(1) unsigned NOT NULL');
		$this->addColumn('et_ophnupostoperative_patient', 'translator_present_id', 'int(10) unsigned DEFAULT NULL');
		$this->addColumn('et_ophnupostoperative_patient', 'name_of_translator', "varchar(255) COLLATE utf8_bin DEFAULT ''");
		$this->addColumn('et_ophnupostoperative_patient', 'patient_has_no_allergies', 'tinyint(1) unsigned NOT NULL');

		$this->addColumn('et_ophnupostoperative_patient_version', 'patient_id_verified_with_two_identifiers', 'tinyint(1) unsigned NOT NULL');
		$this->addColumn('et_ophnupostoperative_patient_version', 'allergies_verified', 'tinyint(1) unsigned NOT NULL');
		$this->addColumn('et_ophnupostoperative_patient_version', 'translator_present_id', 'int(10) unsigned DEFAULT NULL');
		$this->addColumn('et_ophnupostoperative_patient_version', 'name_of_translator', "varchar(255) COLLATE utf8_bin DEFAULT ''");
		$this->addColumn('et_ophnupostoperative_patient_version', 'patient_has_no_allergies', 'tinyint(1) unsigned NOT NULL');

		//re-add data

		$this->dbConnection->createCommand(
			"update et_ophnupostoperative_patient p join et_ophnupostoperative_patientidentification i
			on p.event_id = i.event_id
			set
			p.patient_id_verified_with_two_identifiers = i.patient_id_verified_with_two_identifiers,
			p.allergies_verified = i.allergies_verified,
			p.translator_present_id = i.translator_present_id,
			p.name_of_translator = i.name_of_translator,
			p.patient_has_no_allergies = i.patient_has_no_allergies"
		)->execute();

		//re-add foreign keys

		$this->addForeignKey('ophnupostoperative_patient_translator_present_fk', 'et_ophnupostoperative_patient',
		'translator_present_id', 'ophnupostoperative_patient_translator_present', 'id');


		$this->dropTable('et_ophnupostoperative_patientidentification');
		$this->dropTable('et_ophnupostoperative_patientidentification_version');
	}
}
