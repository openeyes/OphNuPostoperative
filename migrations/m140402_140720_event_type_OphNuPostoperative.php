<?php 
class m140402_140720_event_type_OphNuPostoperative extends CDbMigration
{
	public function up()
	{
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphNuPostoperative'))->queryRow()) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where('name=:name',array(':name'=>'Nursing'))->queryRow();
			$this->insert('event_type', array('class_name' => 'OphNuPostoperative', 'name' => 'Postoperative','event_group_id' => $group['id']));
		}

		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphNuPostoperative'))->queryRow();

		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Patient',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Patient','class_name' => 'Element_OphNuPostoperative_Patient', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Patient'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Vitals',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Vitals','class_name' => 'Element_OphNuPostoperative_Vitals', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Vitals'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Medication Administration',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Medication Administration','class_name' => 'Element_OphNuPostoperative_MedicationAdministration', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Medication Administration'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Post Operative Progress Notes',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Post Operative Progress Notes','class_name' => 'Element_OphNuPostoperative_PostOperativeProgressNotes', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Post Operative Progress Notes'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Falls and Mobility',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Falls and Mobility','class_name' => 'Element_OphNuPostoperative_FallsAndMobility', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Falls and Mobility'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Dental Work',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Dental Work','class_name' => 'Element_OphNuPostoperative_DentalWork', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Dental Work'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Hearing aid',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Hearing aid','class_name' => 'Element_OphNuPostoperative_HearingAid', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Hearing aid'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Patient Belongings',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Patient Belongings','class_name' => 'Element_OphNuPostoperative_PatientBelongings', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Patient Belongings'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Skin Assessment',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Skin Assessment','class_name' => 'Element_OphNuPostoperative_SkinAssessment', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Skin Assessment'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Post Op Observations',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Post Op Observations','class_name' => 'Element_OphNuPostoperative_PostOpObservations', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Post Op Observations'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Checklist',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Checklist','class_name' => 'Element_OphNuPostoperative_Checklist', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Checklist'))->queryRow();

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

		$this->createTable('ophnupostoperative_fallsmobility_fm_id', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'default' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_fallsmobility_fm_id_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_fallsmobility_fm_id_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_fallsmobility_fm_id_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_fallsmobility_fm_id_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_fallsmobility_fm_id',array('name'=>'Unaided','display_order'=>1));
		$this->insert('ophnupostoperative_fallsmobility_fm_id',array('name'=>'Crutches','display_order'=>2));
		$this->insert('ophnupostoperative_fallsmobility_fm_id',array('name'=>'Cane','display_order'=>3));
		$this->insert('ophnupostoperative_fallsmobility_fm_id',array('name'=>'Walker','display_order'=>4));
		$this->insert('ophnupostoperative_fallsmobility_fm_id',array('name'=>'Wheelchair','display_order'=>5));
		$this->insert('ophnupostoperative_fallsmobility_fm_id',array('name'=>'Parents','display_order'=>6));



		$this->createTable('et_ophnupostoperative_fallsmobility', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'falls_mobility' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_fallsmobility_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_fallsmobility_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_fallsmobility_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_fallsmobility_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_fallsmobility_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_fallsmobility_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophnupostoperative_fallsmobility_fm_id_assignment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'ophnupostoperative_fallsmobility_fm_id_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_fallsmobility_fm_id_assignment_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_fallsmobility_fm_id_assignment_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_fallsmobility_fm_id_assignment_ele_fk` (`element_id`)',
				'KEY `et_ophnupostoperative_fallsmobility_fm_id_assignment_lku_fk` (`ophnupostoperative_fallsmobility_fm_id_id`)',
				'CONSTRAINT `et_ophnupostoperative_fallsmobility_fm_id_assignment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_fallsmobility_fm_id_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_fallsmobility_fm_id_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_fallsmobility` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_fallsmobility_fm_id_assignment_lku_fk` FOREIGN KEY (`ophnupostoperative_fallsmobility_fm_id_id`) REFERENCES `ophnupostoperative_fallsmobility_fm_id` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		$this->createTable('et_ophnupostoperative_dentalwork', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'removable_dental' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',

				'full_uppers' => 'tinyint(1) unsigned NOT NULL',

				'full_lowers' => 'tinyint(1) unsigned NOT NULL',

				'other' => 'tinyint(1) unsigned NOT NULL',

				'full_uppers_returned' => 'tinyint(1) unsigned NOT NULL',

				'ful_lowers_returned' => 'tinyint(1) unsigned NOT NULL',

				'other_returned' => 'tinyint(1) unsigned NOT NULL',

				'other_comments' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_dentalwork_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_dentalwork_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_dentalwork_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_dentalwork_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_dentalwork_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_dentalwork_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		$this->createTable('et_ophnupostoperative_hearingaid', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'hearing_aid' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',

				'right' => 'tinyint(1) unsigned NOT NULL',

				'right_returned' => 'tinyint(1) unsigned NOT NULL',

				'left' => 'tinyint(1) unsigned NOT NULL',

				'left_returned' => 'tinyint(1) unsigned NOT NULL',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_hearingaid_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_hearingaid_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_hearingaid_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_hearingaid_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_hearingaid_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_hearingaid_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophnupostoperative_patientbelongings_belongings_id', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'default' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_patientbelongings_belongings_id_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_patientbelongings_belongings_id_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_patientbelongings_belongings_id_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patientbelongings_belongings_id_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_patientbelongings_belongings_id',array('name'=>'Glasses','display_order'=>1));
		$this->insert('ophnupostoperative_patientbelongings_belongings_id',array('name'=>'Jewelery','display_order'=>2));
		$this->insert('ophnupostoperative_patientbelongings_belongings_id',array('name'=>'Clothing','display_order'=>3));
		$this->insert('ophnupostoperative_patientbelongings_belongings_id',array('name'=>'Other','display_order'=>4));
		$this->insert('ophnupostoperative_patientbelongings_belongings_id',array('name'=>'Enter value','display_order'=>5));



		$this->createTable('et_ophnupostoperative_patientbelongings', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'patient_belongings' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',

				'comments' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_patientbelongings_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_patientbelongings_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_patientbelongings_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_patientbelongings_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_patientbelongings_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_patientbelongings_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophnupostoperative_patientbelongings_belongings_id_assignment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'ophnupostoperative_patientbelongings_belongings_id_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_opbia_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_opbia_cui_fk` (`created_user_id`)',
				'KEY `et_opbia_ele_fk` (`element_id`)',
				'KEY `et_opbia_lku_fk` (`ophnupostoperative_patientbelongings_belongings_id_id`)',
				'CONSTRAINT `et_opbia_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_opbia_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_opbia_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_patientbelongings` (`id`)',
				'CONSTRAINT `et_opbia_lku_fk` FOREIGN KEY (`ophnupostoperative_patientbelongings_belongings_id_id`) REFERENCES `ophnupostoperative_patientbelongings_belongings_id` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophnupostoperative_skinassessment_assessment_id', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'default' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_skinassessment_assessment_id_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_skinassessment_assessment_id_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_skinassessment_assessment_id_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_skinassessment_assessment_id_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_skinassessment_assessment_id',array('name'=>'Bruising','display_order'=>1));
		$this->insert('ophnupostoperative_skinassessment_assessment_id',array('name'=>'Warm','display_order'=>2));
		$this->insert('ophnupostoperative_skinassessment_assessment_id',array('name'=>'Cool','display_order'=>3));
		$this->insert('ophnupostoperative_skinassessment_assessment_id',array('name'=>'Dry','display_order'=>4));
		$this->insert('ophnupostoperative_skinassessment_assessment_id',array('name'=>'Moist','display_order'=>5));
		$this->insert('ophnupostoperative_skinassessment_assessment_id',array('name'=>'Other','display_order'=>6));



		$this->createTable('et_ophnupostoperative_skinassessment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'comments' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_skinassessment_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_skinassessment_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_skinassessment_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_skinassessment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_skinassessment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_skinassessment_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophnupostoperative_skinassessment_assessment_id_assignment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'ophnupostoperative_skinassessment_assessment_id_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_osaia_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_osaia_cui_fk` (`created_user_id`)',
				'KEY `et_osaia_ele_fk` (`element_id`)',
				'KEY `et_osaia_lku_fk` (`ophnupostoperative_skinassessment_assessment_id_id`)',
				'CONSTRAINT `et_osaia_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_osaia_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_osaia_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_skinassessment` (`id`)',
				'CONSTRAINT `et_osaia_lku_fk` FOREIGN KEY (`ophnupostoperative_skinassessment_assessment_id_id`) REFERENCES `ophnupostoperative_skinassessment_assessment_id` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophnupostoperative_observations_ob_id', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'default' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_observations_ob_id_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_observations_ob_id_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_observations_ob_id_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_observations_ob_id_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_observations_ob_id',array('name'=>'Anxious / Restless','display_order'=>1));
		$this->insert('ophnupostoperative_observations_ob_id',array('name'=>'Calm','display_order'=>2));
		$this->insert('ophnupostoperative_observations_ob_id',array('name'=>'Talkative','display_order'=>3));
		$this->insert('ophnupostoperative_observations_ob_id',array('name'=>'Withdrawn','display_order'=>4));
		$this->insert('ophnupostoperative_observations_ob_id',array('name'=>'Crying','display_order'=>5));
		$this->insert('ophnupostoperative_observations_ob_id',array('name'=>'Other','display_order'=>6));



		$this->createTable('et_ophnupostoperative_observations', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'comments' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_observations_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_observations_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_observations_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_observations_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_observations_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_observations_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('et_ophnupostoperative_observations_ob_id_assignment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'element_id' => 'int(10) unsigned NOT NULL',
				'ophnupostoperative_observations_ob_id_id' => 'int(10) unsigned NOT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_observations_ob_id_assignment_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_observations_ob_id_assignment_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_observations_ob_id_assignment_ele_fk` (`element_id`)',
				'KEY `et_ophnupostoperative_observations_ob_id_assignment_lku_fk` (`ophnupostoperative_observations_ob_id_id`)',
				'CONSTRAINT `et_ophnupostoperative_observations_ob_id_assignment_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_observations_ob_id_assignment_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_observations_ob_id_assignment_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_observations` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_observations_ob_id_assignment_lku_fk` FOREIGN KEY (`ophnupostoperative_observations_ob_id_id`) REFERENCES `ophnupostoperative_observations_ob_id` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		$this->createTable('et_ophnupostoperative_checklist', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'eye_dressing_in_place' => 'tinyint(1) unsigned NOT NULL',

				'iv_removed' => 'tinyint(1) unsigned NOT NULL',

				'ecg_dots_removed' => 'tinyint(1) unsigned NOT NULL',

				'take_home_ophthalmic_medication_and/or_analgesics_supplies' => 'tinyint(1) unsigned NOT NULL',

				'instructions' => 'tinyint(1) unsigned NOT NULL',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_checklist_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_checklist_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_checklist_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_checklist_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_checklist_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_checklist_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
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



		$this->dropTable('et_ophnupostoperative_fallsmobility_fm_id_assignment');
		$this->dropTable('et_ophnupostoperative_fallsmobility');


		$this->dropTable('ophnupostoperative_fallsmobility_fm_id');

		$this->dropTable('et_ophnupostoperative_dentalwork');



		$this->dropTable('et_ophnupostoperative_hearingaid');



		$this->dropTable('et_ophnupostoperative_patientbelongings_belongings_id_assignment');
		$this->dropTable('et_ophnupostoperative_patientbelongings');


		$this->dropTable('ophnupostoperative_patientbelongings_belongings_id');

		$this->dropTable('et_ophnupostoperative_skinassessment_assessment_id_assignment');
		$this->dropTable('et_ophnupostoperative_skinassessment');


		$this->dropTable('ophnupostoperative_skinassessment_assessment_id');

		$this->dropTable('et_ophnupostoperative_observations_ob_id_assignment');
		$this->dropTable('et_ophnupostoperative_observations');


		$this->dropTable('ophnupostoperative_observations_ob_id');

		$this->dropTable('et_ophnupostoperative_checklist');




		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphNuPostoperative'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		$this->delete('element_type', 'event_type_id='.$event_type['id']);
		$this->delete('event_type', 'id='.$event_type['id']);
	}
}

