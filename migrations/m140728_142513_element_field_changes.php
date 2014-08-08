<?php

class m140728_142513_element_field_changes extends OEMigration
{
	public function up()
	{
		$et = $this->dbConnection->createCommand()->select("*")->from('event_type')->where('class_name = :cn',array(':cn' => 'OphNuPostoperative'))->queryRow();

		$this->insert('element_type',array(
			'event_type_id' => $et['id'],
			'name' => 'Hand off from OR to post-op',
			'class_name' => 'Element_OphNuPostoperative_HandOff',
			'display_order' => 20,
			'default' => 1,
			'required' => 1,
		));

		$this->update('element_type',array('display_order' => 10),"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_Patient'");
		$this->update('element_type',array('display_order' => 30),"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_Vitals'");
		$this->update('element_type',array('display_order' => 40),"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_MedicationAdministration'");
		$this->update('element_type',array('display_order' => 50),"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_PostOperativeProgressNotes'");
		$this->update('element_type',array('display_order' => 60),"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_PostOperative'");

		$this->createTable('et_ophnupostoperative_handoff', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'patient_enters_recovery_room' => 'time not null',
				'anaesthesia_handoff_from_id' => 'int(10) unsigned null',
				'anaesthesia_handoff_to_id' => 'int(10) unsigned null',
				'nursing_handoff_from_id' => 'int(10) unsigned null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_handoff_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_handoff_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_handoff_ev_fk` (`event_id`)',
				'KEY `et_ophnupostoperative_handoff_ahf_fk` (`anaesthesia_handoff_from_id`)',
				'KEY `et_ophnupostoperative_handoff_aht_fk` (`anaesthesia_handoff_to_id`)',
				'KEY `et_ophnupostoperative_handoff_nhf_fk` (`nursing_handoff_from_id`)',
				'CONSTRAINT `et_ophnupostoperative_handoff_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_handoff_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_handoff_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_handoff_ahf_fk` FOREIGN KEY (`anaesthesia_handoff_from_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_handoff_aht_fk` FOREIGN KEY (`anaesthesia_handoff_to_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_handoff_nhf_fk` FOREIGN KEY (`nursing_handoff_from_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('et_ophnupostoperative_handoff');

		foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_patient")->order("id asc")->queryAll() as $row) {
			$this->insert('et_ophnupostoperative_handoff',array(
				'id' => $row['id'],
				'event_id' => $row['event_id'],
				'patient_enters_recovery_room' => $row['patient_enters_recovery_room'],
				'anaesthesia_handoff_from_id' => $row['hand_off_from_id'],
				'anaesthesia_handoff_to_id' => $row['hand_off_to_id'],
				'nursing_handoff_from_id' => $row['handing_off_from_id'] ? $row['handing_off_from_id'] : null,
				'last_modified_user_id' => $row['last_modified_user_id'],
				'last_modified_date' => $row['last_modified_date'],
				'created_user_id' => $row['created_user_id'],
				'created_date' => $row['created_date'],
			));

			foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_patient_version")->where("id = :id",array(":id" => $row['id']))->order("version_id asc")->queryAll() as $v) {
				$this->insert('et_ophnupostoperative_handoff_version',array(
					'id' => $v['id'],
					'version_id' => $v['version_id'],
					'version_date' => $v['version_date'],
					'event_id' => $v['event_id'],
					'patient_enters_recovery_room' => $v['patient_enters_recovery_room'],
					'anaesthesia_handoff_from_id' => $v['hand_off_from_id'],
					'anaesthesia_handoff_to_id' => $v['hand_off_to_id'],
					'nursing_handoff_from_id' => $v['handing_off_from_id'],
					'last_modified_user_id' => $v['last_modified_user_id'],
					'last_modified_date' => $v['last_modified_date'],
					'created_user_id' => $v['created_user_id'],
					'created_date' => $v['created_date'],
				));
			}
		}

		$this->dropColumn('et_ophnupostoperative_patient','patient_enters_recovery_room');
		// Yep, two foreign keys on the same column.. sigh
		$this->dropForeignKey('ophnupostoperative_patient_handing_off_from_fk','et_ophnupostoperative_patient');
		$this->dropForeignKey('ophnupostoperative_patient_hand_off_from_fk','et_ophnupostoperative_patient');
		$this->dropColumn('et_ophnupostoperative_patient','hand_off_from_id');
		$this->dropForeignKey('ophnupostoperative_patient_hand_off_to_fk','et_ophnupostoperative_patient');
		$this->dropColumn('et_ophnupostoperative_patient','hand_off_to_id');
		$this->dropColumn('et_ophnupostoperative_patient','handing_off_from_id');

		$this->dropColumn('et_ophnupostoperative_patient_version','patient_enters_recovery_room');
		$this->dropColumn('et_ophnupostoperative_patient_version','hand_off_from_id');
		$this->dropColumn('et_ophnupostoperative_patient_version','hand_off_to_id');
		$this->dropColumn('et_ophnupostoperative_patient_version','handing_off_from_id');
	}

	public function down()
	{
		$this->addColumn('et_ophnupostoperative_patient_version','patient_enters_recovery_room',"varchar(255) COLLATE utf8_bin DEFAULT ''");
		$this->addColumn('et_ophnupostoperative_patient_version','hand_off_from_id','int(10) unsigned DEFAULT NULL');
		$this->addColumn('et_ophnupostoperative_patient_version','hand_off_to_id','int(10) unsigned DEFAULT NULL');
		$this->addColumn('et_ophnupostoperative_patient_version','handing_off_from_id','int(10) unsigned DEFAULT NULL');

		$this->addColumn('et_ophnupostoperative_patient','patient_enters_recovery_room',"varchar(255) COLLATE utf8_bin DEFAULT ''");
		$this->addColumn('et_ophnupostoperative_patient','hand_off_from_id','int(10) unsigned DEFAULT NULL');
		// ..sigh..
		$this->addForeignKey('ophnupostoperative_patient_handing_off_from_fk','et_ophnupostoperative_patient','hand_off_from_id','user','id');
		$this->addForeignKey('ophnupostoperative_patient_hand_off_from_fk','et_ophnupostoperative_patient','hand_off_from_id','user','id');
		$this->addColumn('et_ophnupostoperative_patient','hand_off_to_id','int(10) unsigned DEFAULT NULL');
		$this->addForeignKey('ophnupostoperative_patient_hand_off_to_fk','et_ophnupostoperative_patient','hand_off_to_id','user','id');
		$this->addColumn('et_ophnupostoperative_patient','handing_off_from_id','int(10) unsigned DEFAULT NULL');

		foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_patient")->order("id asc")->queryAll() as $row) {
			$handoff = $this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_handoff")->where("event_id = :ei",array(":ei" => $row['event_id']))->queryRow();

			$this->update('et_ophnupostoperative_patient',array(
					'patient_enters_recovery_room' => $handoff['patient_enters_recovery_room'],
					'hand_off_from_id' => $handoff['anaesthesia_handoff_from_id'],
					'hand_off_to_id' => $handoff['anaesthesia_handoff_to_id'],
					'handing_off_from_id' => $handoff['nursing_handoff_from_id'],
				),
				"id = {$row['id']}");

			foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_patient_version")->where("id = :id",array(":id" => $row['id']))->order("version_id asc")->queryAll() as $v) {
				$handoff_v = $this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_handoff_version")->where("event_id = :ei and version_id = :vid",array(":ei" => $row['event_id'],":vid" => $v['id']))->queryRow();

				$this->update('et_ophnupostoperative_patient_version',array(
					'patient_enters_recovery_room' => $handoff_v['patient_enters_recovery_room'],
					'hand_off_from_id' => $handoff_v['anaesthesia_handoff_from_id'],
					'hand_off_to_id' => $handoff_v['anaesthesia_handoff_to_id'],
					'handing_off_from_id' => $handoff_v['nursing_handoff_from_id'],
				),
				"version_id = {$v['id']}");
			} 
		}

		$this->dropTable('et_ophnupostoperative_handoff_version');
		$this->dropTable('et_ophnupostoperative_handoff');

		$et = $this->dbConnection->createCommand()->select("*")->from('event_type')->where('class_name = :cn',array(':cn' => 'OphNuPostoperative'))->queryRow();

		$this->update('element_type',array('display_order' => 1),"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_Patient'");
		$this->update('element_type',array('display_order' => 2),"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_Vitals'");
		$this->update('element_type',array('display_order' => 3),"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_MedicationAdministration'");
		$this->update('element_type',array('display_order' => 4),"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_PostOperativeProgressNotes'");
		$this->update('element_type',array('display_order' => 5),"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_PostOperative'");

		$this->delete('element_type',"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_HandOff'");
	}
}
