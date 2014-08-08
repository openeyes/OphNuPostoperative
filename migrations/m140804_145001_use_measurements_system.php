<?php

class m140804_145001_use_measurements_system extends CDbMigration
{
	public function up()
	{
		$types = array();
		foreach ($this->dbConnection->createCommand()->select("*")->from("measurement_type")->queryAll() as $type) {
			$types[$type['class_name']] = $type['id'];
		}

		$this->addColumn('et_ophnupostoperative_vitals','blood_glucose_m_id','int(10) unsigned null');
		$this->addColumn('et_ophnupostoperative_vitals_version','blood_glucose_m_id','int(10) unsigned null');

		$this->addColumn('ophnupostoperative_vital','hr_pulse_m_id','int(10) unsigned null');
		$this->addColumn('ophnupostoperative_vital','blood_pressure_m_id','int(10) unsigned null');
		$this->addColumn('ophnupostoperative_vital','rr_m_id','int(10) unsigned null');
		$this->addColumn('ophnupostoperative_vital','sao2_m_id','int(10) unsigned null');
		$this->addColumn('ophnupostoperative_vital','pain_score_m_id','int(10) unsigned null');

		$this->addColumn('ophnupostoperative_vital_version','hr_pulse_m_id','int(10) unsigned null');
		$this->addColumn('ophnupostoperative_vital_version','blood_pressure_m_id','int(10) unsigned null');
		$this->addColumn('ophnupostoperative_vital_version','rr_m_id','int(10) unsigned null');
		$this->addColumn('ophnupostoperative_vital_version','sao2_m_id','int(10) unsigned null');
		$this->addColumn('ophnupostoperative_vital_version','pain_score_m_id','int(10) unsigned null');

		foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_vitals")->order("id asc")->queryAll() as $element) {
			$event = $this->getRecord('event',$element['event_id']);
			$episode = $this->getRecord('episode',$event['episode_id']);

			foreach ($this->dbConnection->createCommand()->select("*")->from("ophnupostoperative_vital")->where("element_id = {$element['id']}")->order("id asc")->queryAll() as $vital) {
				foreach (array(
						'MeasurementPulse' => array('hr_pulse','pulse','measurement_pulse'),
						'MeasurementBloodPressure' => array('blood_pressure','bp_systolic','measurement_blood_pressure'),
						'MeasurementRespiratoryRate' => array('rr','rr','measurement_respiratory_rate'),
						'MeasurementSAO2' => array('sao2','sao2','measurement_sao2'),
						'MeasurementPainScore' => array('pain_score','pain_score','measurement_pain_score'),
					) as $class => $fields) {

					$this->insert('patient_measurement',array(
						'patient_id' => $episode['patient_id'],
						'measurement_type_id' => $types[$class],
						'created_user_id' => $vital['created_user_id'],
						'created_date' => $vital['created_date'],
						'last_modified_user_id' => $vital['last_modified_user_id'],
						'last_modified_date' => $vital['last_modified_date'],
						'timestamp' => $vital['timestamp'],
					));

					$pm_id = $this->dbConnection->createCommand()->select("max(id)")->from("patient_measurement")->queryScalar();

					$this->insert($fields[2],array(
						'patient_measurement_id' => $pm_id,
						$fields[1] => $vital[$fields[0]],
					));

					$m_id = $this->dbConnection->createCommand()->select("max(id)")->from($fields[2])->queryScalar();

					$this->update('ophnupostoperative_vital',array($fields[0].'_m_id' => $m_id),"id = {$vital['id']}");

					$this->insert('measurement_reference',array(
						'patient_measurement_id' => $pm_id,
						'event_id' => $event['id'],
						'origin' => 1,
					));
				}
			}

			if ($element['glucose_level']) {
				$this->insert('patient_measurement',array(
					'patient_id' => $episode['patient_id'],
					'measurement_type_id' => $types['MeasurementGlucoseLevel'],
					'created_user_id' => $element['created_user_id'],
					'created_date' => $element['created_date'],
					'last_modified_user_id' => $element['last_modified_user_id'],
					'last_modified_date' => $element['last_modified_date'],
					'timestamp' => $element['created_date'],
				));

				$pm_id = $this->dbConnection->createCommand()->select("max(id)")->from("patient_measurement")->queryScalar();

				$this->insert('measurement_glucose_level',array(
					'patient_measurement_id' => $pm_id,
					'glucose_level' => $element['glucose_level'],
				));

				$m_id = $this->dbConnection->createCommand()->select("max(id)")->from("measurement_glucose_level")->queryScalar();

				$this->update('et_ophnupostoperative_vitals',array('blood_glucose_m_id' => $m_id),"id = {$element['id']}");

				$this->insert('measurement_reference',array(
					'patient_measurement_id' => $pm_id,
					'event_id' => $event['id'],
					'origin' => 1,
				));
			}
		}

		$this->addForeignKey('et_ophnupostoperative_vitals_bgmi_fk','et_ophnupostoperative_vitals','blood_glucose_m_id','measurement_glucose_level','id');

		$this->addForeignKey('ophnupostoperative_vital_hpmi_id_fk','ophnupostoperative_vital','hr_pulse_m_id','measurement_pulse','id');
		$this->addForeignKey('ophnupostoperative_vital_bpmi_fk','ophnupostoperative_vital','blood_pressure_m_id','measurement_blood_pressure','id');
		$this->addForeignKey('ophnupostoperative_vital_rrmi_fk','ophnupostoperative_vital','rr_m_id','measurement_respiratory_rate','id');
		$this->addForeignKey('ophnupostoperative_vital_spmi_fk','ophnupostoperative_vital','sao2_m_id','measurement_sao2','id');
		$this->addForeignKey('ophnupostoperative_vital_psmi_fk','ophnupostoperative_vital','pain_score_m_id','measurement_pain_score','id');

		$this->dropColumn('et_ophnupostoperative_vitals','glucose_level');
		$this->dropColumn('et_ophnupostoperative_vitals_version','glucose_level');

		$this->dropColumn('ophnupostoperative_vital','hr_pulse');
		$this->dropColumn('ophnupostoperative_vital','blood_pressure');
		$this->dropColumn('ophnupostoperative_vital','rr');
		$this->dropColumn('ophnupostoperative_vital','sao2');
		$this->dropColumn('ophnupostoperative_vital','pain_score');

		$this->dropColumn('ophnupostoperative_vital_version','hr_pulse');
		$this->dropColumn('ophnupostoperative_vital_version','blood_pressure');
		$this->dropColumn('ophnupostoperative_vital_version','rr');
		$this->dropColumn('ophnupostoperative_vital_version','sao2');
		$this->dropColumn('ophnupostoperative_vital_version','pain_score');
	}

	public function getRecord($table,$id)
	{
		return $this->dbConnection->createCommand()->select("*")->from($table)->where("id = :id",array(":id" => $id))->queryRow();
	}

	public function down()
	{
		$this->addColumn('ophnupostoperative_vital','hr_pulse','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital','blood_pressure','varchar(255) not null');
		$this->addColumn('ophnupostoperative_vital','rr','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital','sao2','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital','pain_score','int(10) unsigned not null');

		$this->addColumn('ophnupostoperative_vital_version','hr_pulse','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital_version','blood_pressure','varchar(255) not null');
		$this->addColumn('ophnupostoperative_vital_version','rr','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital_version','sao2','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital_version','pain_score','int(10) unsigned not null');

		$this->addColumn('et_ophnupostoperative_vitals_version','glucose_level','tinyint(1) unsigned null');
		$this->addColumn('et_ophnupostoperative_vitals','glucose_level','tinyint(1) unsigned null');

		$this->dropForeignKey('ophnupostoperative_vital_hpmi_id_fk','ophnupostoperative_vital');
		$this->dropForeignKey('ophnupostoperative_vital_bpmi_fk','ophnupostoperative_vital');
		$this->dropForeignKey('ophnupostoperative_vital_rrmi_fk','ophnupostoperative_vital');
		$this->dropForeignKey('ophnupostoperative_vital_spmi_fk','ophnupostoperative_vital');
		$this->dropForeignKey('ophnupostoperative_vital_psmi_fk','ophnupostoperative_vital');

		$this->dropForeignKey('et_ophnupostoperative_vitals_bgmi_fk','et_ophnupostoperative_vitals');

		foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_vitals")->order("id asc")->queryAll() as $element) {
			$event = $this->getRecord('event',$element['event_id']);
			$episode = $this->getRecord('episode',$event['episode_id']);

			foreach ($this->dbConnection->createCommand()->select("*")->from("ophnupostoperative_vital")->where("element_id = {$element['id']}")->order("id asc")->queryAll() as $vital) {
				foreach (array(
						'MeasurementPulse' => array('hr_pulse','pulse','measurement_pulse'),
						'MeasurementBloodPressure' => array('blood_pressure','bp_systolic','measurement_blood_pressure'),
						'MeasurementRespiratoryRate' => array('rr','rr','measurement_respiratory_rate'),
						'MeasurementSAO2' => array('sao2','sao2','measurement_sao2'),
						'MeasurementPainScore' => array('pain_score','pain_score','measurement_pain_score'),
					) as $class => $fields) {

					$mes = $this->getRecord($fields[2],$vital[$fields[0].'_m_id']);

					$this->update('ophnupostoperative_vital',array($fields[0] => $mes[$fields[1]]),"id = {$vital['id']}");

					$this->delete($fields[2],"id = ".$vital[$fields[0].'_m_id']);
				}
			}

			if ($element['blood_glucose_m_id']) {
				$mes = $this->getRecord('measurement_glucose_level',$element['blood_glucose_m_id']);

				$this->update('et_ophnupostoperative_vitals',array('glucose_level' => $mes['glucose_level']),"id = {$element['id']}");

				$this->delete('measurement_glucose_level',"id = ".$element['blood_glucose_m_id']);
			}
		}

		$this->dropColumn('et_ophnupostoperative_vitals','blood_glucose_m_id');
		$this->dropColumn('et_ophnupostoperative_vitals_version','blood_glucose_m_id');

		$this->dropColumn('ophnupostoperative_vital','hr_pulse_m_id');
		$this->dropColumn('ophnupostoperative_vital','blood_pressure_m_id');
		$this->dropColumn('ophnupostoperative_vital','rr_m_id');
		$this->dropColumn('ophnupostoperative_vital','sao2_m_id');
		$this->dropColumn('ophnupostoperative_vital','pain_score_m_id');

		$this->dropColumn('ophnupostoperative_vital_version','hr_pulse_m_id');
		$this->dropColumn('ophnupostoperative_vital_version','blood_pressure_m_id');
		$this->dropColumn('ophnupostoperative_vital_version','rr_m_id');
		$this->dropColumn('ophnupostoperative_vital_version','sao2_m_id');
		$this->dropColumn('ophnupostoperative_vital_version','pain_score_m_id');
	}
}
