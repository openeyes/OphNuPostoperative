<?php

class m140808_152226_o2_is_a_measurement extends CDbMigration
{
	public function up()
	{
		$types = array();
		foreach ($this->dbConnection->createCommand()->select("*")->from("measurement_type")->queryAll() as $type) {
			$types[$type['class_name']] = $type['id'];
		}

		$this->addColumn('ophnupostoperative_vital','o2_m_id','int(10) unsigned null');
		$this->addColumn('ophnupostoperative_vital_version','o2_m_id','int(10) unsigned null');

		foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_vitals")->order("id asc")->queryAll() as $element) {
			$event = $this->getRecord('event',$element['event_id']);
			$episode = $this->getRecord('episode',$event['episode_id']);

			foreach ($this->dbConnection->createCommand()->select("*")->from("ophnupostoperative_vital")->where("element_id = {$element['id']}")->order("id asc")->queryAll() as $vital) {
				foreach (array(
						'MeasurementO2' => array('o2','o2','measurement_o2'),
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
		}

		$this->addForeignKey('ophnupostoperative_vital_o2_id_fk','ophnupostoperative_vital','o2_m_id','measurement_o2','id');

		$this->dropColumn('ophnupostoperative_vital','o2');
		$this->dropColumn('ophnupostoperative_vital_version','o2');
	}

	public function getRecord($table,$id)
	{
		return $this->dbConnection->createCommand()->select("*")->from($table)->where("id = :id",array(":id" => $id))->queryRow();
	}

	public function down()
	{
		$this->addColumn('ophnupostoperative_vital','o2','varchar(64) not null');
		$this->addColumn('ophnupostoperative_vital_version','o2','varchar(64) not null');

		$this->dropForeignKey('ophnupostoperative_vital_o2_id_fk','ophnupostoperative_vital');

		foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_vitals")->order("id asc")->queryAll() as $element) {
			$event = $this->getRecord('event',$element['event_id']);
			$episode = $this->getRecord('episode',$event['episode_id']);

			foreach ($this->dbConnection->createCommand()->select("*")->from("ophnupostoperative_vital")->where("element_id = {$element['id']}")->order("id asc")->queryAll() as $vital) {
				foreach (array(
						'MeasurementO2' => array('o2','o2','measurement_o2'),
					) as $class => $fields) {

					$mes = $this->getRecord($fields[2],$vital[$fields[0].'_m_id']);

					$this->update('ophnupostoperative_vital',array($fields[0] => $mes[$fields[1]]),"id = {$vital['id']}");

					$this->delete($fields[2],"id = ".$vital[$fields[0].'_m_id']);
				}
			}
		}

		$this->dropColumn('ophnupostoperative_vital','o2_m_id');
		$this->dropColumn('ophnupostoperative_vital_version','o2_m_id');
	}
}
