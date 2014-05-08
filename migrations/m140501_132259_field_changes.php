<?php

class m140501_132259_field_changes extends CDbMigration
{
	public function up()
	{
		$this->createTable('ophnupostoperative_patient_identifier', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(255) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_patient_identifier_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_patient_identifier_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_patient_identifier_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_identifier_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_patient_identifier',array('id'=>1,'name'=>'DOB','display_order'=>1));
		$this->insert('ophnupostoperative_patient_identifier',array('id'=>2,'name'=>'Patient name','display_order'=>2));
		$this->insert('ophnupostoperative_patient_identifier',array('id'=>3,'name'=>'Parent/caregiver','display_order'=>3));
		$this->insert('ophnupostoperative_patient_identifier',array('id'=>4,'name'=>'Chart number','display_order'=>4));

		$this->createTable('ophnupostoperative_patient_identifier_assignment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned not null',
				'identifier_id' => 'int(10) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_patient_identifier_assignment_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_patient_identifier_assignment_cui_fk` (`created_user_id`)',
				'KEY `ophnupostoperative_patient_identifier_assignment_ele_fk` (`element_id`)',
				'KEY `ophnupostoperative_patient_identifier_assignment_idi_fk` (`identifier_id`)',
				'CONSTRAINT `ophnupostoperative_patient_identifier_assignment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_identifier_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_identifier_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_patient` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_identifier_assignment_idi_fk` FOREIGN KEY (`identifier_id`) REFERENCES `ophnupostoperative_patient_identifier` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
	}

	public function down()
	{
		$this->dropTable('ophnupostoperative_patient_identifier_assignment');
		$this->dropTable('ophnupostoperative_patient_identifier');
	}
}
