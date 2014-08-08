<?php

class m140723_140625_new_vitals_function extends OEMigration
{
	public function up()
	{
		$this->dropForeignKey('ophnupostoperative_vital_ii_fk','ophnupostoperative_vital');
		$this->dropIndex('ophnupostoperative_vital_ii_fk','ophnupostoperative_vital');
		$this->dropColumn('ophnupostoperative_vital','item_id');
		$this->dropColumn('ophnupostoperative_vital_version','item_id');
		$this->dropColumn('ophnupostoperative_vital','value');
		$this->dropColumn('ophnupostoperative_vital_version','value');
		$this->dropColumn('ophnupostoperative_vital','offset');
		$this->dropColumn('ophnupostoperative_vital_version','offset');

		$this->dropTable('ophnupostoperative_vital_type_field_type_option_version');
		$this->dropTable('ophnupostoperative_vital_type_field_type_option');
		$this->dropTable('ophnupostoperative_vital_type_field_type_version');
		$this->dropTable('ophnupostoperative_vital_type');
		$this->dropTable('ophnupostoperative_vital_type_field_type');
		$this->dropTable('ophnupostoperative_vital_type_version');

		$this->createTable('ophnupostoperative_vital_avpu', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(64) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_vital_avpu_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_vital_avpu_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_vital_avpu_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_vital_avpu_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->initialiseData(dirname(__FILE__));

		$this->versionExistingTable('ophnupostoperative_vital_avpu');

		$this->dropTable('ophnupostoperative_vitals_gas_level_version');
		$this->dropTable('ophnupostoperative_vitals_gas_level');
		$this->dropTable('ophnupostoperative_vitals_gas_field_type_version');
		$this->dropTable('ophnupostoperative_vitals_gas');
		$this->dropTable('ophnupostoperative_vitals_gas_field_type');
		$this->dropTable('ophnupostoperative_vitals_gas_version');

		$this->addColumn('ophnupostoperative_vital','hr_pulse','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital','blood_pressure','varchar(255) not null');
		$this->addColumn('ophnupostoperative_vital','rr','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital','sao2','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital','o2','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital','pain_score','int(10) unsigned not null');
		$this->addColumn('ophnupostoperative_vital','timestamp','datetime not null');

		$this->addColumn('ophnupostoperative_vital_version','hr_pulse','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital_version','blood_pressure','varchar(255) not null');
		$this->addColumn('ophnupostoperative_vital_version','rr','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital_version','sao2','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital_version','o2','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital_version','pain_score','int(10) unsigned not null');
		$this->addColumn('ophnupostoperative_vital_version','timestamp','datetime not null');

		$this->dropColumn('et_ophnupostoperative_vitals','anaesthesia_start_time');
		$this->dropColumn('et_ophnupostoperative_vitals','comments');
		$this->dropColumn('et_ophnupostoperative_vitals_version','anaesthesia_start_time');
		$this->dropColumn('et_ophnupostoperative_vitals_version','comments');

		$this->addColumn('et_ophnupostoperative_vitals','glucose_level','varchar(64) not null');
		$this->addColumn('et_ophnupostoperative_vitals','glucose_level_na','tinyint(1) unsigned not null');
		$this->addColumn('et_ophnupostoperative_vitals','nausea_vomiting','varchar(255) not null');
		$this->addColumn('et_ophnupostoperative_vitals','blood_loss','varchar(64) not null');
		$this->addColumn('et_ophnupostoperative_vitals','avpu_score_id','int(10) unsigned null');
		$this->createIndex('et_ophnupostoperative_vitals_avpu_score_id_fk','et_ophnupostoperative_vitals','avpu_score_id');
		$this->addForeignKey('et_ophnupostoperative_vitals_avpu_score_id_fk','et_ophnupostoperative_vitals','avpu_score_id','ophnupostoperative_vital_avpu','id');
		$this->addColumn('et_ophnupostoperative_vitals','mews_score','tinyint(1) unsigned not null');

		$this->addColumn('et_ophnupostoperative_vitals_version','glucose_level','varchar(64) not null');
		$this->addColumn('et_ophnupostoperative_vitals_version','glucose_level_na','tinyint(1) unsigned not null');
		$this->addColumn('et_ophnupostoperative_vitals_version','nausea_vomiting','varchar(255) not null');
		$this->addColumn('et_ophnupostoperative_vitals_version','blood_loss','varchar(64) not null');
		$this->addColumn('et_ophnupostoperative_vitals_version','avpu_score_id','int(10) unsigned null');
		$this->createIndex('et_ophnupostoperative_vitals_avpu_score_id_fk','et_ophnupostoperative_vitals_version','avpu_score_id');
		$this->addColumn('et_ophnupostoperative_vitals_version','mews_score','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophnupostoperative_vitals_version','mews_score');
		$this->dropColumn('et_ophnupostoperative_vitals_version','avpu_score_id');
		$this->dropColumn('et_ophnupostoperative_vitals_version','blood_loss');
		$this->dropColumn('et_ophnupostoperative_vitals_version','nausea_vomiting');
		$this->dropColumn('et_ophnupostoperative_vitals_version','glucose_level_na');
		$this->dropColumn('et_ophnupostoperative_vitals_version','glucose_level');

		$this->dropColumn('et_ophnupostoperative_vitals','mews_score');
		$this->dropForeignKey('et_ophnupostoperative_vitals_avpu_score_id_fk','et_ophnupostoperative_vitals');
		$this->dropIndex('et_ophnupostoperative_vitals_avpu_score_id_fk','et_ophnupostoperative_vitals');
		$this->dropColumn('et_ophnupostoperative_vitals','avpu_score_id');
		$this->dropColumn('et_ophnupostoperative_vitals','blood_loss');
		$this->dropColumn('et_ophnupostoperative_vitals','nausea_vomiting');
		$this->dropColumn('et_ophnupostoperative_vitals','glucose_level_na');
		$this->dropColumn('et_ophnupostoperative_vitals','glucose_level');

		$this->addColumn('et_ophnupostoperative_vitals','comments','text');
		$this->addColumn('et_ophnupostoperative_vitals','anaesthesia_start_time','time null');
		$this->addColumn('et_ophnupostoperative_vitals_version','comments','text');
		$this->addColumn('et_ophnupostoperative_vitals_version','anaesthesia_start_time','time null');

		$this->dropColumn('ophnupostoperative_vital','hr_pulse');
		$this->dropColumn('ophnupostoperative_vital','blood_pressure');
		$this->dropColumn('ophnupostoperative_vital','rr');
		$this->dropColumn('ophnupostoperative_vital','sao2');
		$this->dropColumn('ophnupostoperative_vital','o2');
		$this->dropColumn('ophnupostoperative_vital','pain_score');
		$this->dropColumn('ophnupostoperative_vital','timestamp');

		$this->dropColumn('ophnupostoperative_vital_version','hr_pulse');
		$this->dropColumn('ophnupostoperative_vital_version','blood_pressure');
		$this->dropColumn('ophnupostoperative_vital_version','rr');
		$this->dropColumn('ophnupostoperative_vital_version','sao2');
		$this->dropColumn('ophnupostoperative_vital_version','o2');
		$this->dropColumn('ophnupostoperative_vital_version','pain_score');
		$this->dropColumn('ophnupostoperative_vital_version','timestamp');

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

		$this->versionExistingTable('ophnupostoperative_vitals_gas_field_type');

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

		$this->versionExistingTable('ophnupostoperative_vitals_gas');

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

		$this->versionExistingTable('ophnupostoperative_vitals_gas_level');

		$this->dropTable('ophnupostoperative_vital_avpu_version');
		$this->dropTable('ophnupostoperative_vital_avpu');

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

		$this->versionExistingTable('ophnupostoperative_vital_type_field_type');

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

		$this->versionExistingTable('ophnupostoperative_vital_type');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->versionExistingTable('ophnupostoperative_vital_type_field_type_option');

		$this->addColumn('ophnupostoperative_vital','offset','tinyint(1) unsigned NOT NULL');
		$this->addColumn('ophnupostoperative_vital_version','offset','tinyint(1) unsigned NOT NULL');
		$this->addColumn('ophnupostoperative_vital','value','varchar(16) COLLATE utf8_unicode_ci NOT NULL');
		$this->addColumn('ophnupostoperative_vital_version','value','varchar(16) COLLATE utf8_unicode_ci NOT NULL');
		$this->addColumn('ophnupostoperative_vital','item_id','int(10) unsigned NOT NULL');
		$this->addColumn('ophnupostoperative_vital_version','item_id','int(10) unsigned NOT NULL');
		$this->createIndex('ophnupostoperative_vital_ii_fk','ophnupostoperative_vital','item_id');
		$this->addForeignKey('ophnupostoperative_vital_ii_fk','ophnupostoperative_vital','item_id','ophnupostoperative_vital_type','id');
	}
}
