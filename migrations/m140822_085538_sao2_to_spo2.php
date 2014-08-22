<?php // [ORB-366]

class m140822_085538_sao2_to_spo2 extends CDbMigration
{
	private $spo2_measurement_type;
	private $sao2_measurement_type;
	private $events;
	private $event_ids;

	private function getTypes()
	{
		$this->spo2_measurement_type = $this->dbConnection->createCommand()
			->select('id')
			->from('measurement_type')
			->where('class_name = :cn', array(
				':cn' => 'MeasurementSPO2')
			)->queryRow();

		$this->sao2_measurement_type = $this->dbConnection->createCommand()
			->select('id')
			->from('measurement_type')
			->where('class_name = :cn', array(
				':cn' => 'MeasurementSAO2')
			)->queryRow();

		$this->events = $this->dbConnection->createCommand()
			->select('e.*')
			->from('event e')
			->join('event_type et', 'e.event_type_id=et.id')
			->where('et.class_name = :cn', array(
				':cn' => 'OphNuPostoperative'
			))
			->queryAll();

		$this->event_ids = array_map(function($event){
			return $event['id'];
		}, $this->events);
	}

	public function up()
	{
		$this->getTypes();

		$this->dropForeignKey('ophnupostoperative_vital_spmi_fk','ophnupostoperative_vital');

		$this->renameColumn('ophnupostoperative_vital','sao2_m_id','spo2_m_id');
		$this->renameColumn('ophnupostoperative_vital_version','sao2_m_id','spo2_m_id');

		$this->refreshTableSchema('ophnupostoperative_vital');
		$this->refreshTableSchema('ophnupostoperative_vital_verion');

		// Find all patient measurements for any OphNuPostoperative event for this measurement type (sao2)
		$patient_measurements = $this->dbConnection->createCommand()
			->select('pm.*')
			->from('patient_measurement pm')
			->join('measurement_reference mr', 'pm.id = mr.patient_measurement_id')
			->where('mr.event_id in ('.implode(', ', $this->event_ids).') AND pm.measurement_type_id = :mti', array(
				':mti' => $this->sao2_measurement_type['id']
			))
			->queryAll();

		foreach($patient_measurements as $patient_measurement) {

			// Find the SAO2 measurement row
			$measurement_sao2  = $this->dbConnection->createCommand()
				->select('*')
				->from('measurement_sao2')
				->where('patient_measurement_id = :mi', array(
					'mi' => $patient_measurement['id']
				))
				->queryRow();

			// Insert into SPO2
			$this->insert('measurement_spo2',	array(
				'patient_measurement_id' => $patient_measurement['id'],
				'spo2' => $measurement_sao2['sao2'],
				'created_user_id' => $measurement_sao2['created_user_id']
			));

			// Update fk id
			$this->update('ophnupostoperative_vital', array(
				'spo2_m_id' => $this->dbConnection->getLastInsertId()
			), 'spo2_m_id='.$measurement_sao2['id']);

			// Remove SAO2 entry
			$this->delete('measurement_sao2', 'id='.$measurement_sao2['id']);

			// Update measurement_type in patient_measurement row
			$this->update('patient_measurement', array(
				'measurement_type_id' => $this->spo2_measurement_type['id']
			), 'id='.$patient_measurement['id']);
		}

		$this->addForeignKey('ophnupostoperative_vital_spmi_fk','ophnupostoperative_vital','spo2_m_id','measurement_spo2','id');
		$this->refreshTableSchema('ophnupostoperative_vital');
	}

	public function down()
	{
		$this->getTypes();

		$this->dropForeignKey('ophnupostoperative_vital_spmi_fk','ophnupostoperative_vital');

		$this->renameColumn('ophnupostoperative_vital','spo2_m_id','sao2_m_id');
		$this->renameColumn('ophnupostoperative_vital_version','spo2_m_id','sao2_m_id');

		$this->refreshTableSchema('ophnupostoperative_vital');
		$this->refreshTableSchema('ophnupostoperative_vital_verion');

		// Find all patient measurements for any OphNuPostoperative event for this measurement type (sao2)
		$patient_measurements = $this->dbConnection->createCommand()
			->select('pm.*')
			->from('patient_measurement pm')
			->join('measurement_reference mr', 'pm.id = mr.patient_measurement_id')
			->where('mr.event_id in ('.implode(', ', $this->event_ids).') AND pm.measurement_type_id = :mti', array(
				':mti' => $this->spo2_measurement_type['id']
			))
			->queryAll();

		foreach($patient_measurements as $patient_measurement) {

			// Find the SPO2 measurement row
			$measurement_spo2  = $this->dbConnection->createCommand()
				->select('*')
				->from('measurement_spo2')
				->where('patient_measurement_id = :mi', array(
					'mi' => $patient_measurement['id']
				))
				->queryRow();

			// Insert into SPO2
			$this->insert('measurement_sao2',	array(
				'patient_measurement_id' => $patient_measurement['id'],
				'sao2' => $measurement_spo2['spo2'],
				'created_user_id' => $measurement_spo2['created_user_id']
			));

			// Update fk id
			$this->update('ophnupostoperative_vital', array(
				'sao2_m_id' => $this->dbConnection->getLastInsertId()
			), 'sao2_m_id='.$measurement_spo2['id']);

			// Remove SAO2 entry
			$this->delete('measurement_spo2', 'id='.$measurement_spo2['id']);

			// Update measurement_type in patient_measurement row
			$this->update('patient_measurement', array(
				'measurement_type_id' => $this->sao2_measurement_type['id']
			), 'id='.$patient_measurement['id']);
		}

		$this->addForeignKey('ophnupostoperative_vital_spmi_fk','ophnupostoperative_vital','sao2_m_id','measurement_sao2','id');
		$this->refreshTableSchema('ophnupostoperative_vital');
	}
}