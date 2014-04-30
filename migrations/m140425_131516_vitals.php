<?php

class m140425_131516_vitals extends CDbMigration
{
	public function up()
	{
		return true;
		$this->createTable('ophnupostoperative_vitals', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'typeid' => 'int(10) unsigned NOT NULL',
				'time' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_postoperative_vitals_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_postoperative_vitals_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_vitals_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_vitals_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophnupostoperative_vitals_type', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'units' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_postoperative_vitalst_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_postoperative_vitalst_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_vitalst_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_vitalst_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
		), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');
	}

	public function down()
	{
		return true;
	}
}