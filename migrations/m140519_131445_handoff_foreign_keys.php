<?php

class m140519_131445_handoff_foreign_keys extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey('ophnupostoperative_patient_handing_off_from_fk','et_ophnupostoperative_patient');
		$this->addForeignKey('ophnupostoperative_patient_handing_off_from_fk','et_ophnupostoperative_patient','hand_off_from_id','user','id');

		$this->dropForeignKey('ophnupostoperative_patient_hand_off_from_fk','et_ophnupostoperative_patient');
		$this->addForeignKey('ophnupostoperative_patient_hand_off_from_fk','et_ophnupostoperative_patient','hand_off_from_id','user','id');

		$this->dropForeignKey('ophnupostoperative_patient_hand_off_to_fk','et_ophnupostoperative_patient');
		$this->addForeignKey('ophnupostoperative_patient_hand_off_to_fk','et_ophnupostoperative_patient','hand_off_to_id','user','id');

		$this->dropTable('ophnupostoperative_patient_handing_off_from');
		$this->dropTable('ophnupostoperative_patient_hand_off_from');
		$this->dropTable('ophnupostoperative_patient_hand_off_to');
	}

	public function down()
	{
		$this->createTable('ophnupostoperative_patient_hand_off_from', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_patient_hand_off_from_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_patient_hand_off_from_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_patient_hand_off_from_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_hand_off_from_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_patient_hand_off_from',array('name'=>'Anaesthesia','display_order'=>1));

		$this->createTable('ophnupostoperative_patient_hand_off_to', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_patient_hand_off_to_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_patient_hand_off_to_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_patient_hand_off_to_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_hand_off_to_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_patient_hand_off_to',array('name'=>'Nurse','display_order'=>1));

		$this->createTable('ophnupostoperative_patient_handing_off_from', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_patient_handing_off_from_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_patient_handing_off_from_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_patient_handing_off_from_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_handing_off_from_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_patient_handing_off_from',array('name'=>'Nurse','display_order'=>1));

		$this->dropForeignKey('ophnupostoperative_patient_handing_off_from_fk','et_ophnupostoperative_patient');
		$this->addForeignKey('ophnupostoperative_patient_handing_off_from_fk','et_ophnupostoperative_patient','hand_off_from_id','ophnupostoperative_patient_handing_off_from','id');

		$this->dropForeignKey('ophnupostoperative_patient_hand_off_from_fk','et_ophnupostoperative_patient');
		$this->addForeignKey('ophnupostoperative_patient_hand_off_from_fk','et_ophnupostoperative_patient','hand_off_from_id','ophnupostoperative_patient_hand_off_from','id');

		$this->dropForeignKey('ophnupostoperative_patient_hand_off_to_fk','et_ophnupostoperative_patient');
		$this->addForeignKey('ophnupostoperative_patient_hand_off_to_fk','et_ophnupostoperative_patient','hand_off_to_id','ophnupostoperative_patient_hand_off_to','id');
	}
}
