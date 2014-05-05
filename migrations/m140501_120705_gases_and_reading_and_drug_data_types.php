<?php

class m140501_120705_gases_and_reading_and_drug_data_types extends OEMigration
{
	public function up()
	{
		$this->dropTable('ophnupostoperative_vital');
		$this->dropTable('ophnupostoperative_vital_type');
		$this->dropTable('ophnupostoperative_drug_dose');
		$this->dropTable('ophnupostoperative_drug');

		$this->execute("CREATE TABLE `ophnupostoperative_vitals_drug` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`display_order` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`unit` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
	`deleted` tinyint(1) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_vitals_drug_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_vitals_drug_cui_fk` (`created_user_id`),
	CONSTRAINT `ophnupostoperative_vitals_drug_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_vitals_drug_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->execute("CREATE TABLE `ophnupostoperative_vitals_drug_dose` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`element_id` int(10) unsigned NOT NULL,
	`item_id` int(10) unsigned NOT NULL,
	`value` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`offset` tinyint(1) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_vitals_drug_dose_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_vitals_drug_dose_cui_fk` (`created_user_id`),
	KEY `ophnupostoperative_vitals_drug_dose_el_fk` (`element_id`),
	KEY `ophnupostoperative_vitals_drug_dose_ii_fk` (`item_id`),
	CONSTRAINT `ophnupostoperative_vitals_drug_dose_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_vitals_drug_dose_el_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_vitals` (`id`),
	CONSTRAINT `ophnupostoperative_vitals_drug_dose_ii_fk` FOREIGN KEY (`item_id`) REFERENCES `ophnupostoperative_vitals_drug` (`id`),
	CONSTRAINT `ophnupostoperative_vitals_drug_dose_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->execute("CREATE TABLE `ophnupostoperative_vitals_gas_field_type` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
	`display_order` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`deleted` tinyint(1) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_vitals_gas_ft_ft_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_vitals_gas_ft_ft_cui_fk` (`created_user_id`),
	CONSTRAINT `ophnupostoperative_vitals_gas_ft_ft_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_vitals_gas_ft_ft_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->execute("CREATE TABLE `ophnupostoperative_vitals_gas` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`display_order` int(10) unsigned NOT NULL,
	`field_type_id` int(10) unsigned NOT NULL,
	`unit` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
	`min` tinyint(1) unsigned DEFAULT NULL,
	`max` tinyint(1) unsigned DEFAULT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`deleted` tinyint(1) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_vitals_gas_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_vitals_gas_cui_fk` (`created_user_id`),
	KEY `ophnupostoperative_vitals_gas_lft_fk` (`field_type_id`),
	CONSTRAINT `ophnupostoperative_vitals_gas_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_vitals_gas_lft_fk` FOREIGN KEY (`field_type_id`) REFERENCES `ophnupostoperative_vitals_gas_field_type` (`id`),
	CONSTRAINT `ophnupostoperative_vitals_gas_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->execute("CREATE TABLE `ophnupostoperative_vitals_gas_level` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`element_id` int(10) unsigned NOT NULL,
	`item_id` int(10) unsigned NOT NULL,
	`value` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`offset` tinyint(1) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_vitals_gas_level_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_vitals_gas_level_cui_fk` (`created_user_id`),
	KEY `ophnupostoperative_vitals_gas_level_el_fk` (`element_id`),
	KEY `ophnupostoperative_vitals_gas_level_gai_fk` (`item_id`),
	CONSTRAINT `ophnupostoperative_vitals_gas_level_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_vitals_gas_level_el_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_vitals` (`id`),
	CONSTRAINT `ophnupostoperative_vitals_gas_level_gai_fk` FOREIGN KEY (`item_id`) REFERENCES `ophnupostoperative_vitals_gas` (`id`),
	CONSTRAINT `ophnupostoperative_vitals_gas_level_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->execute("CREATE TABLE `ophnupostoperative_vital_type_field_type` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`display_order` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`deleted` tinyint(1) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_vital_tft_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_vital_tft_cui_fk` (`created_user_id`),
	CONSTRAINT `ophnupostoperative_vital_tft_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_vital_tft_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->execute("CREATE TABLE `ophnupostoperative_vital_type` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`display_order` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`unit` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
	`validation_regex` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`validation_message` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`field_type_id` int(10) unsigned NOT NULL,
	`deleted` tinyint(1) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_vital_type_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_vital_type_cui_fk` (`created_user_id`),
	KEY `ophnupostoperative_vital_type_fti_fk` (`field_type_id`),
	CONSTRAINT `ophnupostoperative_vital_type_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_vital_type_fti_fk` FOREIGN KEY (`field_type_id`) REFERENCES `ophnupostoperative_vital_type_field_type` (`id`),
	CONSTRAINT `ophnupostoperative_vital_type_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->execute("CREATE TABLE `ophnupostoperative_vital_type_field_type_option` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`vital_type_id` int(10) unsigned NOT NULL,
	`name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	`display_order` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`deleted` tinyint(1) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_vital_tfto_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_vital_tfto_cui_fk` (`created_user_id`),
	KEY `ophnupostoperative_vital_tfto_fti_fk` (`vital_type_id`),
	CONSTRAINT `ophnupostoperative_vital_tfto_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_vital_tfto_fti_fk` FOREIGN KEY (`vital_type_id`) REFERENCES `ophnupostoperative_vital_type` (`id`),
	CONSTRAINT `ophnupostoperative_vital_tfto_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->execute("CREATE TABLE `ophnupostoperative_vital` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`element_id` int(10) unsigned NOT NULL,
	`item_id` int(10) unsigned NOT NULL,
	`value` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`offset` tinyint(1) unsigned NOT NULL,
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_vital_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_vital_cui_fk` (`created_user_id`),
	KEY `ophnupostoperative_vital_el_fk` (`element_id`),
	KEY `ophnupostoperative_vital_ii_fk` (`item_id`),
	CONSTRAINT `ophnupostoperative_vital_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_vital_el_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_vitals` (`id`),
	CONSTRAINT `ophnupostoperative_vital_ii_fk` FOREIGN KEY (`item_id`) REFERENCES `ophnupostoperative_vital_type` (`id`),
	CONSTRAINT `ophnupostoperative_vital_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->initialiseData(dirname(__FILE__));
	}

	public function down()
	{
		$this->dropTable('ophnupostoperative_vital');
		$this->dropTable('ophnupostoperative_vital_type_field_type_option');
		$this->dropTable('ophnupostoperative_vital_type');
		$this->dropTable('ophnupostoperative_vital_type_field_type');
		$this->dropTable('ophnupostoperative_vitals_gas_level');
		$this->dropTable('ophnupostoperative_vitals_gas');
		$this->dropTable('ophnupostoperative_vitals_gas_field_type');
		$this->dropTable('ophnupostoperative_vitals_drug_dose');
		$this->dropTable('ophnupostoperative_vitals_drug');

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
	}
}
