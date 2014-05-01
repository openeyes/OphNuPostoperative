<?php

class m140501_113916_allergies_and_medications extends CDbMigration
{
	public function up()
	{
		$this->createTable('ophnupostoperative_medicationadmin_medication', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned not null',
				'drug_id' => 'int(10) unsigned not null',
				'route_id' => 'int(10) unsigned not null',
				'option_id' => 'int(10) unsigned null',
				'frequency_id' => 'int(10) unsigned not null',
				'start_date' => 'date not null',
				'end_date' => 'date default null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_medicationadmin_medication_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_medicationadmin_medication_cui_fk` (`created_user_id`)',
				'KEY `ophnupostoperative_medicationadmin_medication_element_id_fk` (`element_id`)',
				'KEY `ophnupostoperative_medicationadmin_medication_drug_id_fk` (`drug_id`)',
				'KEY `ophnupostoperative_medicationadmin_medication_route_id_fk` (`route_id`)',
				'KEY `ophnupostoperative_medicationadmin_medication_option_id_fk` (`option_id`)',
				'KEY `ophnupostoperative_medicationadmin_medication_frequency_id_fk` (`frequency_id`)',
				'CONSTRAINT `ophnupostoperative_medicationadmin_medication_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_medicationadmin_medication_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_medicationadmin_medication_element_id_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_medicationadmin` (`id`)',
				'CONSTRAINT `ophnupostoperative_medicationadmin_medication_drug_id_fk` FOREIGN KEY (`drug_id`) REFERENCES `drug` (`id`)',
				'CONSTRAINT `ophnupostoperative_medicationadmin_medication_route_id_fk` FOREIGN KEY (`route_id`) REFERENCES `drug_route` (`id`)',
				'CONSTRAINT `ophnupostoperative_medicationadmin_medication_option_id_fk` FOREIGN KEY (`option_id`) REFERENCES `drug_route_option` (`id`)',
				'CONSTRAINT `ophnupostoperative_medicationadmin_medication_frequency_id_fk` FOREIGN KEY (`frequency_id`) REFERENCES `drug_frequency` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophnupostoperative_patient_allergy', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned not null',
				'allergy_id' => 'int(10) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_patient_allergy_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_patient_allergy_cui_fk` (`created_user_id`)',
				'KEY `ophnupostoperative_patient_allergy_element_id_fk` (`element_id`)',
				'KEY `ophnupostoperative_patient_allergy_allergy_id_fk` (`allergy_id`)',
				'CONSTRAINT `ophnupostoperative_patient_allergy_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_allergy_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_allergy_element_id_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_patient` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_allergy_allergy_id_fk` FOREIGN KEY (`allergy_id`) REFERENCES `allergy` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->addColumn('et_ophnupostoperative_patient','patient_has_no_allergies','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophnupostoperative_patient','patient_has_no_allergies');

		$this->dropTable('ophnupostoperative_patient_allergy');
		$this->dropTable('ophnupostoperative_medicationadmin_medication');
	}
}
