<?php

class m140801_124034_remove_allergy_tables extends OEMigration
{
	public function up()
	{
		$this->dropTable('ophnupostoperative_patient_allergy_version');
		$this->dropTable('ophnupostoperative_patient_allergy');
	}

	public function down()
	{
		$this->execute("CREATE TABLE `ophnupostoperative_patient_allergy` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`element_id` int(10) unsigned NOT NULL,
	`allergy_id` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_patient_allergy_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_patient_allergy_cui_fk` (`created_user_id`),
	KEY `ophnupostoperative_patient_allergy_element_id_fk` (`element_id`),
	KEY `ophnupostoperative_patient_allergy_allergy_id_fk` (`allergy_id`),
	CONSTRAINT `ophnupostoperative_patient_allergy_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_patient_allergy_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_patient_allergy_element_id_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_patient` (`id`),
	CONSTRAINT `ophnupostoperative_patient_allergy_allergy_id_fk` FOREIGN KEY (`allergy_id`) REFERENCES `allergy` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");
	}
}
