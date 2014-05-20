<?php

class m140520_074131_schema_fixes extends CDbMigration
{
	public function up()
	{
		$event_type = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphNuPostoperative"))->queryRow();
		$this->update('element_type',array('required'=>1),"event_type_id = {$event_type['id']}");

		$this->renameTable('et_ophnupostoperative_postoperative_belongings_assignment','et_ophnupostoperative_postoperative_belongassign');
	}

	public function down()
	{
		$event_type = $this->dbConnection->createCommand()->select("*")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphNuPostoperative"))->queryRow();
		$this->update('element_type',array('required'=>null),"event_type_id = {$event_type['id']}");

		$this->renameTable('et_ophnupostoperative_postoperative_belongassign','et_ophnupostoperative_postoperative_belongings_assignment');
	}
}
