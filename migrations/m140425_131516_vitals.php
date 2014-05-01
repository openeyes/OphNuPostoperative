<?php

class m140425_131516_vitals extends CDbMigration
{
	public function up()
	{
		$this->createTable('et_ophnupostoperative_vitals', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'start_time' => 'time NOT NULL',
				'comments' => 'text DEFAULT \'\'', // Comments
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_vitals_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_vitals_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_vitals_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_vitals_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_vitals_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_vitals_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophnupostoperative_vital_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_vital_type_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_vital_type_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_vital_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_vital_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophnupostoperative_vital', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'reading_type_id' => 'int(10) unsigned NOT NULL',
				'reading_time' => 'time NOT NULL',
				'value' => 'varchar(16) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_vital_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_vital_cui_fk` (`created_user_id`)',
				'KEY `ophnupostoperative_vital_rt_fk` (`reading_type_id`)',
				'KEY `ophnupostoperative_vital_el_fk` (`element_id`)',
				'CONSTRAINT `ophnupostoperative_vital_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_vital_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_vital_rt_fk` FOREIGN KEY (`reading_type_id`) REFERENCES `ophnupostoperative_vital_type` (`id`)',
				'CONSTRAINT `ophnupostoperative_vital_el_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_vitals` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophnupostoperative_drug', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_drug_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_drug_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_drug_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_drug_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophnupostoperative_drug_dose', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'drug_id' => 'int(10) unsigned NOT NULL',
				'dose_time' => 'time NOT NULL',
				'dose' => 'varchar(16) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_drug_dose_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_drug_dose_cui_fk` (`created_user_id`)',
				'KEY `ophnupostoperative_drug_dose_rt_fk` (`drug_id`)',
				'KEY `ophnupostoperative_drug_dose_el_fk` (`element_id`)',
				'CONSTRAINT `ophnupostoperative_drug_dose_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_drug_dose_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_drug_dose_rt_fk` FOREIGN KEY (`drug_id`) REFERENCES `ophnupostoperative_drug` (`id`)',
				'CONSTRAINT `ophnupostoperative_drug_dose_el_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_vitals` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->renameColumn('et_ophnupostoperative_vitals','start_time','anaesthesia_start_time');
		$this->addColumn('et_ophnupostoperative_vitals','anaesthesia_end_time','time NOT NULL');
		$this->addColumn('et_ophnupostoperative_vitals','surgery_start_time','time NOT NULL');
		$this->addColumn('et_ophnupostoperative_vitals','surgery_end_time','time NOT NULL');
	}

	public function down()
	{

	}
}