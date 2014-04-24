<?php 
class m140421_112451_event_type_OphNuPostoperative extends CDbMigration
{
	public function up()
	{
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphNuPostoperative'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Nursing'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphNuPostoperative', 'name' => 'Post-operative Nursing Note','event_group_id' => $group['id']));
		}

		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphNuPostoperative'))->queryRow();

		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Patient',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Patient','class_name' => 'Element_OphNuPostoperative_Patient', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Patient'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Vitals',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Vitals','class_name' => 'Element_OphNuPostoperative_Vitals', 'event_type_id' => $event_type['id'], 'display_order' => 2));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Vitals'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Medication Administration',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Medication Administration','class_name' => 'Element_OphNuPostoperative_MedicationAdministration', 'event_type_id' => $event_type['id'], 'display_order' => 3));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Medication Administration'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Post Operative Progress Notes',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Post Operative Progress Notes','class_name' => 'Element_OphNuPostoperative_PostOperativeProgressNotes', 'event_type_id' => $event_type['id'], 'display_order' => 4));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Post Operative Progress Notes'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Post Operative',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Post Operative','class_name' => 'Element_OphNuPostoperative_PostOperative', 'event_type_id' => $event_type['id'], 'display_order' => 5));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Post Operative'))->queryRow();

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

		$this->createTable('ophnupostoperative_patient_translator_present', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_patient_translator_present_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_patient_translator_present_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_patient_translator_present_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_translator_present_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_patient_translator_present',array('name'=>'Yes','display_order'=>1));
		$this->insert('ophnupostoperative_patient_translator_present',array('name'=>'No','display_order'=>2));
		$this->insert('ophnupostoperative_patient_translator_present',array('name'=>'N/A','display_order'=>3));



		$this->createTable('et_ophnupostoperative_patient', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'patient_id_verified_with_two_identifiers' => 'tinyint(1) unsigned NOT NULL',

				'allergies_verified' => 'tinyint(1) unsigned NOT NULL',

				'patient_enters_recovery_room' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'hand_off_from_id' => 'int(10) unsigned NOT NULL DEFAULT 1',

				'hand_off_to_id' => 'int(10) unsigned NOT NULL DEFAULT 1',

				'handing_off_from_id' => 'int(10) unsigned NOT NULL DEFAULT 1',

				'translator_present_id' => 'int(10) unsigned NOT NULL',

				'name_of_translator' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_patient_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_patient_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_patient_ev_fk` (`event_id`)',
				'KEY `ophnupostoperative_patient_hand_off_from_fk` (`hand_off_from_id`)',
				'KEY `ophnupostoperative_patient_hand_off_to_fk` (`hand_off_to_id`)',
				'KEY `ophnupostoperative_patient_handing_off_from_fk` (`handing_off_from_id`)',
				'KEY `ophnupostoperative_patient_translator_present_fk` (`translator_present_id`)',
				'CONSTRAINT `et_ophnupostoperative_patient_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_patient_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_patient_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_hand_off_from_fk` FOREIGN KEY (`hand_off_from_id`) REFERENCES `ophnupostoperative_patient_hand_off_from` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_hand_off_to_fk` FOREIGN KEY (`hand_off_to_id`) REFERENCES `ophnupostoperative_patient_hand_off_to` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_handing_off_from_fk` FOREIGN KEY (`handing_off_from_id`) REFERENCES `ophnupostoperative_patient_handing_off_from` (`id`)',
				'CONSTRAINT `ophnupostoperative_patient_translator_present_fk` FOREIGN KEY (`translator_present_id`) REFERENCES `ophnupostoperative_patient_translator_present` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		$this->createTable('et_ophnupostoperative_vitals', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'vitals' => 'text COLLATE utf8_bin DEFAULT \'\'',

				'total_fluid_intake' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'total_fluid_output' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

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
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		$this->createTable('et_ophnupostoperative_medicationadmin', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'medication_administration' => 'text COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_medicationadmin_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_medicationadmin_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_medicationadmin_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_medicationadmin_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_medicationadmin_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_medicationadmin_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		$this->createTable('et_ophnupostoperative_progressnote', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'progress_notes' => 'text COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_progressnote_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_progressnote_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_progressnote_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_progressnote_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_progressnote_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_progressnote_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophnupostoperative_postoperative_falls', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'default' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_postoperative_falls_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_postoperative_falls_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_falls_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_falls_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_postoperative_falls',array('name'=>'Unaided','display_order'=>1));
		$this->insert('ophnupostoperative_postoperative_falls',array('name'=>'Walker','display_order'=>2));
		$this->insert('ophnupostoperative_postoperative_falls',array('name'=>'Crutches','display_order'=>3));
		$this->insert('ophnupostoperative_postoperative_falls',array('name'=>'Wheelchair','display_order'=>4));
		$this->insert('ophnupostoperative_postoperative_falls',array('name'=>'Cane','display_order'=>5));
		$this->insert('ophnupostoperative_postoperative_falls',array('name'=>'Parents','display_order'=>6));

		$this->createTable('ophnupostoperative_postoperative_removable_dental', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_postoperative_removable_dental_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_postoperative_removable_dental_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_removable_dental_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_removable_dental_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_postoperative_removable_dental',array('name'=>'Yes','display_order'=>1));
		$this->insert('ophnupostoperative_postoperative_removable_dental',array('name'=>'No','display_order'=>2));
		$this->insert('ophnupostoperative_postoperative_removable_dental',array('name'=>'NA','display_order'=>3));

		$this->createTable('ophnupostoperative_postoperative_dental', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'default' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_postoperative_dental_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_postoperative_dental_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_dental_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_dental_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_postoperative_dental',array('name'=>'Full Lowers Returned','display_order'=>1));
		$this->insert('ophnupostoperative_postoperative_dental',array('name'=>'Full Uppers Returned','display_order'=>2));
		$this->insert('ophnupostoperative_postoperative_dental',array('name'=>'Other Returned','display_order'=>3));

		$this->createTable('ophnupostoperative_postoperative_hearing_aid_returned', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_postoperative_hearing_aid_returned_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_postoperative_hearing_aid_returned_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_hearing_aid_returned_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_hearing_aid_returned_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_postoperative_hearing_aid_returned',array('name'=>'Yes','display_order'=>1));
		$this->insert('ophnupostoperative_postoperative_hearing_aid_returned',array('name'=>'No','display_order'=>2));
		$this->insert('ophnupostoperative_postoperative_hearing_aid_returned',array('name'=>'N/A','display_order'=>3));

		$this->createTable('ophnupostoperative_postoperative_hearing', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'default' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_postoperative_hearing_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_postoperative_hearing_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_hearing_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_hearing_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_postoperative_hearing',array('name'=>'Right hearing aid returned','display_order'=>1));
		$this->insert('ophnupostoperative_postoperative_hearing',array('name'=>'Left hearing aid returned','display_order'=>2));

		$this->createTable('ophnupostoperative_postoperative_belongings', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'default' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_postoperative_belongings_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_postoperative_belongings_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_belongings_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_belongings_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_postoperative_belongings',array('name'=>'Glasses','display_order'=>1));
		$this->insert('ophnupostoperative_postoperative_belongings',array('name'=>'Jewelery','display_order'=>2));
		$this->insert('ophnupostoperative_postoperative_belongings',array('name'=>'Clothing','display_order'=>3));
		$this->insert('ophnupostoperative_postoperative_belongings',array('name'=>'Other','display_order'=>4));

		$this->createTable('ophnupostoperative_postoperative_skin', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'default' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_postoperative_skin_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_postoperative_skin_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_skin_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_skin_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_postoperative_skin',array('name'=>'Bruising','display_order'=>1));
		$this->insert('ophnupostoperative_postoperative_skin',array('name'=>'Dry','display_order'=>2));
		$this->insert('ophnupostoperative_postoperative_skin',array('name'=>'Warm','display_order'=>3));
		$this->insert('ophnupostoperative_postoperative_skin',array('name'=>'Cool','display_order'=>4));
		$this->insert('ophnupostoperative_postoperative_skin',array('name'=>'Moist','display_order'=>5));
		$this->insert('ophnupostoperative_postoperative_skin',array('name'=>'Other','display_order'=>6));

		$this->createTable('ophnupostoperative_postoperative_obs', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'default' => 'tinyint(1) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_postoperative_obs_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_postoperative_obs_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_obs_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_obs_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_postoperative_obs',array('name'=>'Anxious / Restless','display_order'=>1));
		$this->insert('ophnupostoperative_postoperative_obs',array('name'=>'Calm','display_order'=>2));
		$this->insert('ophnupostoperative_postoperative_obs',array('name'=>'Crying','display_order'=>3));
		$this->insert('ophnupostoperative_postoperative_obs',array('name'=>'Talkative','display_order'=>4));
		$this->insert('ophnupostoperative_postoperative_obs',array('name'=>'Withdrawn','display_order'=>5));
		$this->insert('ophnupostoperative_postoperative_obs',array('name'=>'Other','display_order'=>6));



		$this->createTable('et_ophnupostoperative_postoperative', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'fallsmobility' => 'tinyint(1) unsigned NOT NULL',

				'removable_dental_id' => 'int(10) unsigned NOT NULL',

				'other_comments' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'hearing_aid_returned_id' => 'int(10) unsigned NOT NULL',

				'patent_belongings_returned' => 'tinyint(1) unsigned NOT NULL',

				'h_comments' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				's_comments' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'o_comments' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_postoperative_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_ev_fk` (`event_id`)',
				'KEY `ophnupostoperative_postoperative_removable_dental_fk` (`removable_dental_id`)',
				'KEY `ophnupostoperative_postoperative_hearing_aid_returned_fk` (`hearing_aid_returned_id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_removable_dental_fk` FOREIGN KEY (`removable_dental_id`) REFERENCES `ophnupostoperative_postoperative_removable_dental` (`id`)',
				'CONSTRAINT `ophnupostoperative_postoperative_hearing_aid_returned_fk` FOREIGN KEY (`hearing_aid_returned_id`) REFERENCES `ophnupostoperative_postoperative_hearing_aid_returned` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophnupostoperative_postoperative_falls_assignment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'ophnupostoperative_postoperative_falls_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_postoperative_falls_assignment_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_falls_assignment_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_falls_assignment_ele_fk` (`element_id`)',
				'KEY `et_ophnupostoperative_postoperative_falls_assignment_lku_fk` (`ophnupostoperative_postoperative_falls_id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_falls_assignment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_falls_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_falls_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_postoperative` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_falls_assignment_lku_fk` FOREIGN KEY (`ophnupostoperative_postoperative_falls_id`) REFERENCES `ophnupostoperative_postoperative_falls` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophnupostoperative_postoperative_dental_assignment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'ophnupostoperative_postoperative_dental_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_postoperative_dental_assignment_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_dental_assignment_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_dental_assignment_ele_fk` (`element_id`)',
				'KEY `et_ophnupostoperative_postoperative_dental_assignment_lku_fk` (`ophnupostoperative_postoperative_dental_id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_dental_assignment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_dental_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_dental_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_postoperative` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_dental_assignment_lku_fk` FOREIGN KEY (`ophnupostoperative_postoperative_dental_id`) REFERENCES `ophnupostoperative_postoperative_dental` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophnupostoperative_postoperative_hearing_assignment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'ophnupostoperative_postoperative_hearing_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_postoperative_hearing_assignment_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_hearing_assignment_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_hearing_assignment_ele_fk` (`element_id`)',
				'KEY `et_ophnupostoperative_postoperative_hearing_assignment_lku_fk` (`ophnupostoperative_postoperative_hearing_id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_hearing_assignment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_hearing_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_hearing_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_postoperative` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_hearing_assignment_lku_fk` FOREIGN KEY (`ophnupostoperative_postoperative_hearing_id`) REFERENCES `ophnupostoperative_postoperative_hearing` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophnupostoperative_postoperative_belongings_assignment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'ophnupostoperative_postoperative_belongings_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_opba_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_belongings_assignment_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_belongings_assignment_ele_fk` (`element_id`)',
				'KEY `et_ophnupostoperative_postoperative_belongings_assignment_lku_fk` (`ophnupostoperative_postoperative_belongings_id`)',
				'CONSTRAINT `et_opba_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_belongings_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_belongings_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_postoperative` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_belongings_assignment_lku_fk` FOREIGN KEY (`ophnupostoperative_postoperative_belongings_id`) REFERENCES `ophnupostoperative_postoperative_belongings` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophnupostoperative_postoperative_skin_assignment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'ophnupostoperative_postoperative_skin_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_postoperative_skin_assignment_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_skin_assignment_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_skin_assignment_ele_fk` (`element_id`)',
				'KEY `et_ophnupostoperative_postoperative_skin_assignment_lku_fk` (`ophnupostoperative_postoperative_skin_id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_skin_assignment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_skin_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_skin_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_postoperative` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_skin_assignment_lku_fk` FOREIGN KEY (`ophnupostoperative_postoperative_skin_id`) REFERENCES `ophnupostoperative_postoperative_skin` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophnupostoperative_postoperative_obs_assignment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'ophnupostoperative_postoperative_obs_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_postoperative_obs_assignment_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_obs_assignment_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_postoperative_obs_assignment_ele_fk` (`element_id`)',
				'KEY `et_ophnupostoperative_postoperative_obs_assignment_lku_fk` (`ophnupostoperative_postoperative_obs_id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_obs_assignment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_obs_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_obs_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_postoperative` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_postoperative_obs_assignment_lku_fk` FOREIGN KEY (`ophnupostoperative_postoperative_obs_id`) REFERENCES `ophnupostoperative_postoperative_obs` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

	}

	public function down()
	{
		$this->dropTable('et_ophnupostoperative_patient');


		$this->dropTable('ophnupostoperative_patient_hand_off_from');
		$this->dropTable('ophnupostoperative_patient_hand_off_to');
		$this->dropTable('ophnupostoperative_patient_handing_off_from');
		$this->dropTable('ophnupostoperative_patient_translator_present');

		$this->dropTable('et_ophnupostoperative_vitals');



		$this->dropTable('et_ophnupostoperative_medicationadmin');



		$this->dropTable('et_ophnupostoperative_progressnote');



		$this->dropTable('et_ophnupostoperative_postoperative_falls_assignment');
		$this->dropTable('et_ophnupostoperative_postoperative_dental_assignment');
		$this->dropTable('et_ophnupostoperative_postoperative_hearing_assignment');
		$this->dropTable('et_ophnupostoperative_postoperative_belongings_assignment');
		$this->dropTable('et_ophnupostoperative_postoperative_skin_assignment');
		$this->dropTable('et_ophnupostoperative_postoperative_obs_assignment');
		$this->dropTable('et_ophnupostoperative_postoperative');


		$this->dropTable('ophnupostoperative_postoperative_falls');
		$this->dropTable('ophnupostoperative_postoperative_removable_dental');
		$this->dropTable('ophnupostoperative_postoperative_dental');
		$this->dropTable('ophnupostoperative_postoperative_hearing_aid_returned');
		$this->dropTable('ophnupostoperative_postoperative_hearing');
		$this->dropTable('ophnupostoperative_postoperative_belongings');
		$this->dropTable('ophnupostoperative_postoperative_skin');
		$this->dropTable('ophnupostoperative_postoperative_obs');


		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphNuPostoperative'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		$this->delete('element_type', 'event_type_id='.$event_type['id']);
		$this->delete('event_type', 'id='.$event_type['id']);
	}
}

