<?php

class m140729_113212_orb244 extends OEMigration
{
	public function up()
	{
		$this->update('element_type',
			array('name' => 'Patient Identification' ) ,
			"class_name = 'Element_OphNuPostoperative_Patient'"
		);

		$this->renameColumn('et_ophnupostoperative_patient', 'patient_id_verified_with_two_identifiers', 'patient_id_verified');
		$this->renameColumn('et_ophnupostoperative_patient_version', 'patient_id_verified_with_two_identifiers', 'patient_id_verified');

		$this->dropTable('ophnupostoperative_patient_identifier_assignment');
		$this->dropTable('ophnupostoperative_patient_identifier_assignment_version');

		$this->dropTable('ophnupostoperative_patient_identifier');
		$this->dropTable('ophnupostoperative_patient_identifier_version');
	}

	public function down()
	{
		$this->update('element_type',
			array('name' => 'Patient' ) ,
			"class_name = 'Element_OphNuPostoperative_Patient'"
		);
		$this->renameColumn('et_ophnupostoperative_patient', 'patient_id_verified', 'patient_id_verified_with_two_identifiers');
		$this->renameColumn('et_ophnupostoperative_patient_version', 'patient_id_verified', 'patient_id_verified_with_two_identifiers');

		$this->createOETable(
			'ophnupostoperative_patient_identifier',
			array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(255) COLLATE utf8_bin',
				'display_order' => "int(10) unsigned NOT NULL DEFAULT '1'",
				' PRIMARY KEY (`id`)'
			)
		);
		$this->versionExistingTable('ophnupostoperative_patient_identifier');

		$this->insert('ophnupostoperative_patient_identifier',array('name'=>'DOB', 'display_order' => 1));
		$this->insert('ophnupostoperative_patient_identifier',array('name'=>'Patient name', 'display_order' => 2));
		$this->insert('ophnupostoperative_patient_identifier',array('name'=>'Parent/Caregiver', 'display_order' => 3));
		$this->insert('ophnupostoperative_patient_identifier',array('name'=>'Chart number', 'display_order' => 4));

		$this->createOETable(
			'ophnupostoperative_patient_identifier_assignment',
			array(
				'id' => 'pk',
				'element_id' => 'int(10) unsigned NOT NULL',
				'identifier_id' => 'int(10) unsigned NOT NULL',
				'KEY `ophnupostoperative_patient_identifier_assignment_ele_fk` (`element_id`)',
				'KEY `ophnupostoperative_patient_identifier_assignment_idi_fk` (`identifier_id`)',
				'CONSTRAINT `ophnupostoperative_patient_identifier_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_patient` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_identifier_assignment_idi_fk` FOREIGN KEY (`identifier_id`) REFERENCES `ophnupostoperative_patient_identifier` (`id`)'
			),
			true
		);

		$this->update('et_ophnupostoperative_patient',
			array('patient_id_verified_with_two_identifiers' => 0 )
		);

	}
}