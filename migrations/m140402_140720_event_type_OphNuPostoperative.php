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

		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Allergies',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Allergies','class_name' => 'Element_OphNuPostoperative_Allergies', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Allergies'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Patient Hand off',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Patient Hand off','class_name' => 'Element_OphNuPostoperative_PatientHandOff', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Patient Hand off'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Medication Administration',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Medication Administration','class_name' => 'Element_OphNuPostoperative_MedicationAdministration', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Medication Administration'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Progress Notes',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Progress Notes','class_name' => 'Element_OphNuPostoperative_ProgressNotes', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Progress Notes'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Fluids',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Fluids','class_name' => 'Element_OphNuPostoperative_Fluids', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Fluids'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Translator',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Translator','class_name' => 'Element_OphNuPostoperative_Translator', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Translator'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Patient ID',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Patient ID','class_name' => 'Element_OphNuPostoperative_PatientId', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Patient ID'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Mobility',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Mobility','class_name' => 'Element_OphNuPostoperative_Mobility', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Mobility'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Dental work',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Dental work','class_name' => 'Element_OphNuPostoperative_DentalWork', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Dental work'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Hearing Aid',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Hearing Aid','class_name' => 'Element_OphNuPostoperative_HearingAid', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Hearing Aid'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Patient Belongings',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Patient Belongings','class_name' => 'Element_OphNuPostoperative_PatientBelongings', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Patient Belongings'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Skin Assessment',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Skin Assessment','class_name' => 'Element_OphNuPostoperative_SkinAssessment', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Skin Assessment'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Observations',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Observations','class_name' => 'Element_OphNuPostoperative_Observations', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Observations'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Checks',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Checks','class_name' => 'Element_OphNuPostoperative_Checks', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Checks'))->queryRow();
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where('name=:name and event_type_id=:eventTypeId', array(':name'=>'Patient Follow up Appointment',':eventTypeId'=>$event_type['id']))->queryRow()) {
			$this->insert('element_type', array('name' => 'Patient Follow up Appointment','class_name' => 'Element_OphNuPostoperative_PatientFollowUpAppointment', 'event_type_id' => $event_type['id'], 'display_order' => 1));
		}

		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where('event_type_id=:eventTypeId and name=:name', array(':eventTypeId'=>$event_type['id'],':name'=>'Patient Follow up Appointment'))->queryRow();



		$this->createTable('et_ophnupostoperative_allergies', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'allergies_verified' => 'tinyint(1) unsigned NOT NULL',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_allergies_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_allergies_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_allergies_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_allergies_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_allergies_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_allergies_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophnupostoperative_patienthandoff_an_hand_off_from', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_patienthandoff_an_hand_off_from_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_patienthandoff_an_hand_off_from_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_patienthandoff_an_hand_off_from_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patienthandoff_an_hand_off_from_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_patienthandoff_an_hand_off_from',array('name'=>'Anesthesia','display_order'=>1));

		$this->createTable('ophnupostoperative_patienthandoff_nurse_hand_off_from', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_patienthandoff_nurse_hand_off_from_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_patienthandoff_nurse_hand_off_from_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_patienthandoff_nurse_hand_off_from_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patienthandoff_nurse_hand_off_from_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_patienthandoff_nurse_hand_off_from',array('name'=>'Nurse','display_order'=>1));

		$this->createTable('ophnupostoperative_patienthandoff_nurse_hand_off_to', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_patienthandoff_nurse_hand_off_to_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_patienthandoff_nurse_hand_off_to_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_patienthandoff_nurse_hand_off_to_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_patienthandoff_nurse_hand_off_to_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_patienthandoff_nurse_hand_off_to',array('name'=>'Nurse','display_order'=>1));



		$this->createTable('et_ophnupostoperative_patienthandoff', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'patient_enters_recovery_room' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'an_hand_off_from_id' => 'int(10) unsigned NOT NULL',

				'nurse_hand_off_from_id' => 'int(10) unsigned NOT NULL',

				'nurse_hand_off_to_id' => 'int(10) unsigned NOT NULL',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_patienthandoff_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_patienthandoff_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_patienthandoff_ev_fk` (`event_id`)',
				'KEY `ophnupostoperative_patienthandoff_an_hand_off_from_fk` (`an_hand_off_from_id`)',
				'KEY `ophnupostoperative_patienthandoff_nurse_hand_off_from_fk` (`nurse_hand_off_from_id`)',
				'KEY `ophnupostoperative_patienthandoff_nurse_hand_off_to_fk` (`nurse_hand_off_to_id`)',
				'CONSTRAINT `et_ophnupostoperative_patienthandoff_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_patienthandoff_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_patienthandoff_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `ophnupostoperative_patienthandoff_an_hand_off_from_fk` FOREIGN KEY (`an_hand_off_from_id`) REFERENCES `ophnupostoperative_patienthandoff_an_hand_off_from` (`id`)',
				'CONSTRAINT `ophnupostoperative_patienthandoff_nurse_hand_off_from_fk` FOREIGN KEY (`nurse_hand_off_from_id`) REFERENCES `ophnupostoperative_patienthandoff_nurse_hand_off_from` (`id`)',
				'CONSTRAINT `ophnupostoperative_patienthandoff_nurse_hand_off_to_fk` FOREIGN KEY (`nurse_hand_off_to_id`) REFERENCES `ophnupostoperative_patienthandoff_nurse_hand_off_to` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		$this->createTable('et_ophnupostoperative_medicationadmin', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'comments' => 'text COLLATE utf8_bin DEFAULT \'\'',

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



		$this->createTable('et_ophnupostoperative_progressnotes', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'progress_notes' => 'text COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_progressnotes_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_progressnotes_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_progressnotes_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_progressnotes_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_progressnotes_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_progressnotes_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		$this->createTable('et_ophnupostoperative_fluids', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'total_fluid_intake' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'total_fluid_output' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_fluids_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_fluids_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_fluids_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_fluids_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_fluids_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_fluids_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->createTable('ophnupostoperative_translator_translator_present', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(128) COLLATE utf8_bin NOT NULL',
				'display_order' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_translator_translator_present_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_translator_translator_present_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_translator_translator_present_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_translator_translator_present_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

		$this->insert('ophnupostoperative_translator_translator_present',array('name'=>'Yes','display_order'=>1));
		$this->insert('ophnupostoperative_translator_translator_present',array('name'=>'No','display_order'=>2));
		$this->insert('ophnupostoperative_translator_translator_present',array('name'=>'NA','display_order'=>3));



		$this->createTable('et_ophnupostoperative_translator', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'translator_present_id' => 'int(10) unsigned NOT NULL',

				'name_of_translator' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_translator_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_translator_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_translator_ev_fk` (`event_id`)',
				'KEY `ophnupostoperative_translator_translator_present_fk` (`translator_present_id`)',
				'CONSTRAINT `et_ophnupostoperative_translator_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_translator_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_translator_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
				'CONSTRAINT `ophnupostoperative_translator_translator_present_fk` FOREIGN KEY (`translator_present_id`) REFERENCES `ophnupostoperative_translator_translator_present` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		$this->createTable('et_ophnupostoperative_patientid', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'two_identifiers' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',

				'dob' => 'tinyint(1) unsigned NOT NULL',

				'patient_name' => 'tinyint(1) unsigned NOT NULL',

				'parent_caregiver' => 'tinyint(1) unsigned NOT NULL',

				'chart_number' => 'tinyint(1) unsigned NOT NULL',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_patientid_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_patientid_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_patientid_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_patientid_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_patientid_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_patientid_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		$this->createTable('et_ophnupostoperative_mobility', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'falls_mobility' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',

				'unaided' => 'tinyint(1) unsigned NOT NULL',

				'walker' => 'tinyint(1) unsigned NOT NULL',

				'crutches' => 'tinyint(1) unsigned NOT NULL',

				'cane' => 'tinyint(1) unsigned NOT NULL',

				'wheelchair' => 'tinyint(1) unsigned NOT NULL',

				'parents' => 'tinyint(1) unsigned NOT NULL',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_mobility_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_mobility_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_mobility_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_mobility_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_mobility_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_mobility_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		$this->createTable('et_ophnupostoperative_dentalwork', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'dental_present' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',

				'uppers' => 'tinyint(1) unsigned NOT NULL',

				'uppers_removed' => 'tinyint(1) unsigned NOT NULL',

				'lowers' => 'tinyint(1) unsigned NOT NULL',

				'lowers_removed' => 'tinyint(1) unsigned NOT NULL',

				'other' => 'tinyint(1) unsigned NOT NULL',

				'other_comments' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'other_removed' => 'tinyint(1) unsigned NOT NULL',

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
				'hearing_aid_present' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',

				'right' => 'tinyint(1) unsigned NOT NULL',

				'left' => 'tinyint(1) unsigned NOT NULL',

				'left_removed' => 'tinyint(1) unsigned NOT NULL',

				'right_removed' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',

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



		$this->createTable('et_ophnupostoperative_patientbelongings', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'patient_belongings' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',

				'glasses' => 'tinyint(1) unsigned NOT NULL',

				'jewlery' => 'tinyint(1) unsigned NOT NULL',

				'clothing' => 'tinyint(1) unsigned NOT NULL',

				'other' => 'tinyint(1) unsigned NOT NULL',

				'other_comments' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

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



		$this->createTable('et_ophnupostoperative_skinassessment', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'bruising' => 'tinyint(1) unsigned NOT NULL',

				'dry' => 'tinyint(1) unsigned NOT NULL',

				'warm' => 'tinyint(1) unsigned NOT NULL',

				'moist' => 'tinyint(1) unsigned NOT NULL',

				'cool' => 'tinyint(1) unsigned NOT NULL',

				'other' => 'tinyint(1) unsigned NOT NULL',

				'other_comments' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

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



		$this->createTable('et_ophnupostoperative_observations', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'anxious_restless' => 'tinyint(1) unsigned NOT NULL',

				'talkative' => 'tinyint(1) unsigned NOT NULL',

				'calm' => 'tinyint(1) unsigned NOT NULL',

				'withdrawn' => 'tinyint(1) unsigned NOT NULL',

				'moist' => 'tinyint(1) unsigned NOT NULL',

				'other' => 'tinyint(1) unsigned NOT NULL',

				'other_comments' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

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



		$this->createTable('et_ophnupostoperative_checks', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'eye_dressing' => 'tinyint(1) unsigned NOT NULL',

				'iv_removed' => 'tinyint(1) unsigned NOT NULL',

				'ecg_dots_removed' => 'tinyint(1) unsigned NOT NULL',

				'take_home' => 'tinyint(1) unsigned NOT NULL',

				'post_op_instructions' => 'tinyint(1) unsigned NOT NULL',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_checks_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_checks_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_checks_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_checks_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_checks_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_checks_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');



		$this->createTable('et_ophnupostoperative_patientfollowup', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'follow_up_date' => 'date DEFAULT NULL',

				'follow_up_time' => 'varchar(255) COLLATE utf8_bin DEFAULT \'\'',

				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophnupostoperative_patientfollowup_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophnupostoperative_patientfollowup_cui_fk` (`created_user_id`)',
				'KEY `et_ophnupostoperative_patientfollowup_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophnupostoperative_patientfollowup_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_patientfollowup_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophnupostoperative_patientfollowup_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin');

	}

	public function down()
	{
		$this->dropTable('et_ophnupostoperative_allergies');



		$this->dropTable('et_ophnupostoperative_patienthandoff');


		$this->dropTable('ophnupostoperative_patienthandoff_an_hand_off_from');
		$this->dropTable('ophnupostoperative_patienthandoff_nurse_hand_off_from');
		$this->dropTable('ophnupostoperative_patienthandoff_nurse_hand_off_to');

		$this->dropTable('et_ophnupostoperative_medicationadmin');



		$this->dropTable('et_ophnupostoperative_progressnotes');



		$this->dropTable('et_ophnupostoperative_fluids');



		$this->dropTable('et_ophnupostoperative_translator');


		$this->dropTable('ophnupostoperative_translator_translator_present');

		$this->dropTable('et_ophnupostoperative_patientid');



		$this->dropTable('et_ophnupostoperative_mobility');



		$this->dropTable('et_ophnupostoperative_dentalwork');



		$this->dropTable('et_ophnupostoperative_hearingaid');



		$this->dropTable('et_ophnupostoperative_patientbelongings');



		$this->dropTable('et_ophnupostoperative_skinassessment');



		$this->dropTable('et_ophnupostoperative_observations');



		$this->dropTable('et_ophnupostoperative_checks');



		$this->dropTable('et_ophnupostoperative_patientfollowup');




		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where('class_name=:class_name', array(':class_name'=>'OphNuPostoperative'))->queryRow();

		foreach ($this->dbConnection->createCommand()->select('id')->from('event')->where('event_type_id=:event_type_id', array(':event_type_id'=>$event_type['id']))->queryAll() as $row) {
			$this->delete('audit', 'event_id='.$row['id']);
			$this->delete('event', 'id='.$row['id']);
		}

		$this->delete('element_type', 'event_type_id='.$event_type['id']);
		$this->delete('event_type', 'id='.$event_type['id']);
	}
}

