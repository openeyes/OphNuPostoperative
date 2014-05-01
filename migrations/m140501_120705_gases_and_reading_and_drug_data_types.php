<?php

class m140501_120705_gases_and_reading_and_drug_data_types extends OEMigration
{
	public function up()
	{
		$this->createTable('ophnupostoperative_gas_field_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(32) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_gas_ft_ft_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_gas_ft_ft_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_gas_ft_ft_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_gas_ft_ft_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophnupostoperative_gas', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'field_type_id' => 'int(10) unsigned NOT NULL',
				'unit' => 'varchar(16) NOT NULL',
				'min' => 'tinyint(1) unsigned NULL',
				'max' => 'tinyint(1) unsigned NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_gas_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_gas_cui_fk` (`created_user_id`)',
				'KEY `ophnupostoperative_gas_lft_fk` (`field_type_id`)',
				'CONSTRAINT `ophnupostoperative_gas_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_gas_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_gas_lft_fk` FOREIGN KEY (`field_type_id`) REFERENCES `ophnupostoperative_gas_field_type` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophnupostoperative_gas_level', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'item_id' => 'int(10) unsigned NOT NULL',
				'record_time' => 'time NOT NULL',
				'value' => 'varchar(64) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_gas_level_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_gas_level_cui_fk` (`created_user_id`)',
				'KEY `ophnupostoperative_gas_level_el_fk` (`element_id`)',
				'KEY `ophnupostoperative_gas_level_gai_fk` (`item_id`)',
				'CONSTRAINT `ophnupostoperative_gas_level_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_gas_level_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_gas_level_el_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_vitals` (`id`)',
				'CONSTRAINT `ophnupostoperative_gas_level_gai_fk` FOREIGN KEY (`item_id`) REFERENCES `ophnupostoperative_gas` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophnupostoperative_vital_type_field_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_vital_tft_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_vital_tft_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_vital_tft_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_vital_tft_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->createTable('ophnupostoperative_vital_type_field_type_option', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'reading_type_id' => 'int(10) unsigned NOT NULL',
				'name' => 'varchar(64) NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_vital_tfto_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_vital_tfto_cui_fk` (`created_user_id`)',
				'KEY `ophnupostoperative_vital_tfto_fti_fk` (`reading_type_id`)',
				'CONSTRAINT `ophnupostoperative_vital_tfto_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_vital_tfto_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_vital_tfto_fti_fk` FOREIGN KEY (`reading_type_id`) REFERENCES `ophnupostoperative_vital_type` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->addColumn('ophnupostoperative_drug','unit','varchar(16) NOT NULL');
		$this->addColumn('ophnupostoperative_vital_type','unit','varchar(32) NOT NULL');
		$this->addColumn('ophnupostoperative_vital_type','validation_regex','varchar(64) NOT NULL');
		$this->addColumn('ophnupostoperative_vital_type','validation_message','varchar(64) NOT NULL');
		$this->addColumn('ophnupostoperative_vital_type','field_type_id','int(10) unsigned NOT NULL');

		$this->delete('ophnupostoperative_drug');
		$this->delete('ophnupostoperative_vital_type_field_type');
		$this->delete('ophnupostoperative_vital_type_field_type_option');
		$this->delete('ophnupostoperative_vital_type');

		$this->dropForeignKey('ophnupostoperative_drug_dose_rt_fk','ophnupostoperative_drug_dose');
		$this->dropIndex('ophnupostoperative_drug_dose_rt_fk','ophnupostoperative_drug_dose');
		$this->renameColumn('ophnupostoperative_drug_dose','drug_id','item_id');
		$this->createIndex('ophnupostoperative_drug_dose_ii_fk','ophnupostoperative_drug_dose','item_id');
		$this->addForeignKey('ophnupostoperative_drug_dose_ii_fk','ophnupostoperative_drug_dose','item_id','ophnupostoperative_drug','id');

		$this->renameColumn('ophnupostoperative_drug_dose','dose_time','record_time');
		$this->renameColumn('ophnupostoperative_drug_dose','dose','value');

		$this->dropForeignKey('ophnupostoperative_vital_rt_fk','ophnupostoperative_vital');
		$this->dropIndex('ophnupostoperative_vital_rt_fk','ophnupostoperative_vital');
		$this->renameColumn('ophnupostoperative_vital','reading_type_id','item_id');
		$this->createIndex('ophnupostoperative_vital_ii_fk','ophnupostoperative_vital','item_id');
		$this->addForeignKey('ophnupostoperative_vital_ii_fk','ophnupostoperative_vital','item_id','ophnupostoperative_vital_type','id');

		$this->renameColumn('ophnupostoperative_vital','reading_time','record_time');

		$this->addForeignKey('ophnupostoperative_vital_type_fti_fk','ophnupostoperative_vital_type','field_type_id','ophnupostoperative_vital_type_field_type','id');

		$this->initialiseData(dirname(__FILE__));
	}

	public function down()
	{
		$this->dropForeignKey('ophnupostoperative_drug_dose_ii_fk','ophnupostoperative_drug_dose');
		$this->dropIndex('ophnupostoperative_drug_dose_ii_fk','ophnupostoperative_drug_dose');
		$this->renameColumn('ophnupostoperative_drug_dose','item_id','drug_id');
		$this->createIndex('ophnupostoperative_drug_dose_rt_fk','ophnupostoperative_drug_dose','drug_id');
		$this->addForeignKey('ophnupostoperative_drug_dose_rt_fk','ophnupostoperative_drug_dose','drug_id','ophnupostoperative_drug','id');

		$this->renameColumn('ophnupostoperative_drug_dose','record_time','dose_time');
		$this->renameColumn('ophnupostoperative_drug_dose','value','dose');

		$this->renameColumn('ophnupostoperative_vital','record_time','reading_time');

		$this->dropForeignKey('ophnupostoperative_vital_ii_fk','ophnupostoperative_vital');
		$this->dropIndex('ophnupostoperative_vital_ii_fk','ophnupostoperative_vital');
		$this->renameColumn('ophnupostoperative_vital','item_id','reading_type_id');
		$this->createIndex('ophnupostoperative_vital_rt_fk','ophnupostoperative_vital','reading_type_id');
		$this->addForeignKey('ophnupostoperative_vital_rt_fk','ophnupostoperative_vital','reading_type_id','ophnupostoperative_vital_type','id');

		$this->dropForeignKey('ophnupostoperative_vital_type_fti_fk','ophnupostoperative_vital_type');
		$this->dropIndex('ophnupostoperative_vital_type_fti_fk','ophnupostoperative_vital_type');
		$this->dropColumn('ophnupostoperative_vital_type','field_type_id');
		$this->dropColumn('ophnupostoperative_vital_type','validation_message');
		$this->dropColumn('ophnupostoperative_vital_type','validation_regex');
		$this->dropColumn('ophnupostoperative_vital_type','unit');

		$this->dropColumn('ophnupostoperative_drug','unit');

		$this->dropTable('ophnupostoperative_vital_type_field_type_option');
		$this->dropTable('ophnupostoperative_vital_type_field_type');
		$this->dropTable('ophnupostoperative_gas_level');
		$this->dropTable('ophnupostoperative_gas');
		$this->dropTable('ophnupostoperative_gas_field_type');
	}
}