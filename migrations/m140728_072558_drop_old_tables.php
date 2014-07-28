<?php

class m140728_072558_drop_old_tables extends OEMigration
{
	public function up()
	{
		$this->dropTable('ophnupostoperative_vitals_drug_dose_version');
		$this->dropTable('ophnupostoperative_vitals_drug_dose');
		$this->dropTable('ophnupostoperative_vitals_drug_version');
		$this->dropTable('ophnupostoperative_vitals_drug');
	}

	public function down()
	{
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

		$this->versionExistingTable('ophnupostoperative_vitals_drug');

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

		$this->versionExistingTable('ophnupostoperative_vitals_drug_dose');
	}
}
