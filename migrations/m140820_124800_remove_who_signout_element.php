<?php

class m140820_124800_remove_who_signout_element extends OEMigration
{
	public function up()
	{
		$et = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :cn",array(":cn" => "OphNuPostoperative"))->queryRow();

		$this->delete('element_type',"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_WHOSignOut'");

		$this->dropTable('ophnupostoperative_equipment_problems_assign_version');
		$this->dropTable('ophnupostoperative_equipment_problems_assign');

		$this->dropTable('et_ophnupostoperative_whosignout_version');
		$this->dropTable('et_ophnupostoperative_whosignout');

		$this->dropTable('ophnupostoperative_labelling_version');
		$this->dropTable('ophnupostoperative_labelling');

		$this->dropTable('ophnupostoperative_equipment_problems_version');
		$this->dropTable('ophnupostoperative_equipment_problems');

		$this->dropTable('ophnupostoperative_instructions_provided_version');
		$this->dropTable('ophnupostoperative_instructions_provided');
	}

	public function down()
	{
		$this->execute("CREATE TABLE `ophnupostoperative_instructions_provided` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
	`display_order` tinyint(1) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_instructions_provided_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_instructions_provided_cui_fk` (`created_user_id`),
	CONSTRAINT `ophnupostoperative_instructions_provided_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_instructions_provided_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->versionExistingTable('ophnupostoperative_instructions_provided');

		$this->execute("CREATE TABLE `ophnupostoperative_equipment_problems` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
	`display_order` tinyint(1) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_equipment_problems_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_equipment_problems_cui_fk` (`created_user_id`),
	CONSTRAINT `ophnupostoperative_equipment_problems_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_equipment_problems_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->versionExistingTable('ophnupostoperative_equipment_problems');

		$this->execute("CREATE TABLE `ophnupostoperative_labelling` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
	`display_order` tinyint(1) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_labelling_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_labelling_cui_fk` (`created_user_id`),
	CONSTRAINT `ophnupostoperative_labelling_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_labelling_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->versionExistingTable('ophnupostoperative_labelling');

		$this->execute("CREATE TABLE `et_ophnupostoperative_whosignout` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`signout_lead_by_id` int(10) unsigned DEFAULT NULL,
	`surgical_count_completed` tinyint(1) unsigned NOT NULL,
	`labelling_id` int(10) unsigned DEFAULT NULL,
	`equipment_problems` tinyint(1) unsigned NOT NULL,
	`equipment_problems_comments` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
	`instructions_provided_id` int(10) unsigned DEFAULT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `et_ophnupostoperative_whosignout_lmui_fk` (`last_modified_user_id`),
	KEY `et_ophnupostoperative_whosignout_cui_fk` (`created_user_id`),
	KEY `et_ophnupostoperative_whosignout_ev_fk` (`event_id`),
	KEY `et_ophnupostoperative_whosignout_slb_fk` (`signout_lead_by_id`),
	KEY `et_ophnupostoperative_whosignout_li_fk` (`labelling_id`),
	KEY `et_ophnupostoperative_whosignout_ipi_fk` (`instructions_provided_id`),
	CONSTRAINT `et_ophnupostoperative_whosignout_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `et_ophnupostoperative_whosignout_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `et_ophnupostoperative_whosignout_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
	CONSTRAINT `et_ophnupostoperative_whosignout_slb_fk` FOREIGN KEY (`signout_lead_by_id`) REFERENCES `user` (`id`),
	CONSTRAINT `et_ophnupostoperative_whosignout_li_fk` FOREIGN KEY (`labelling_id`) REFERENCES `ophnupostoperative_labelling` (`id`),
	CONSTRAINT `et_ophnupostoperative_whosignout_ipi_fk` FOREIGN KEY (`instructions_provided_id`) REFERENCES `ophnupostoperative_instructions_provided` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->versionExistingTable('et_ophnupostoperative_whosignout');

		$this->execute("CREATE TABLE `ophnupostoperative_equipment_problems_assign` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`element_id` int(10) unsigned NOT NULL,
	`problem_id` int(10) unsigned NOT NULL,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `ophnupostoperative_equipment_problems_assign_lmui_fk` (`last_modified_user_id`),
	KEY `ophnupostoperative_equipment_problems_assign_cui_fk` (`created_user_id`),
	KEY `ophnupostoperative_equipment_problems_assign_ele_fk` (`element_id`),
	KEY `ophnupostoperative_equipment_problems_assign_pro_fk` (`problem_id`),
	CONSTRAINT `ophnupostoperative_equipment_problems_assign_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_equipment_problems_assign_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `ophnupostoperative_equipment_problems_assign_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_whosignout` (`id`),
	CONSTRAINT `ophnupostoperative_equipment_problems_assign_pro_fk` FOREIGN KEY (`problem_id`) REFERENCES `ophnupostoperative_equipment_problems` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci");

		$this->versionExistingTable('ophnupostoperative_equipment_problems_assign');

		$et = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :cn",array(":cn" => "OphNuPostoperative"))->queryRow();

		$this->insert('element_type',array(
			'name' => 'WHO sign-out',
			'class_name' => 'Element_OphNuPostoperative_WHOSignOut',
			'event_type_id' => $et['id'],
			'display_order' => 90,
			'default' => 1,
			'required' => 1,
			'active' => 1,
		));
	}
}
