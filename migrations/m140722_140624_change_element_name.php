<?php

class m140722_140624_change_element_name extends CDbMigration
{
	public function up()
	{
		$et = $this->dbConnection->createCommand()->select("id")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphNuPostoperative"))->queryRow();

		$this->update("element_type",array("name" => "Discharge preparation"),"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_PostOperative'");
	}

	public function down()
	{
		$et = $this->dbConnection->createCommand()->select("id")->from("event_type")->where("class_name = :class_name",array(":class_name" => "OphNuPostoperative"))->queryRow();

		$this->update("element_type",array("name" => "Post operative"),"event_type_id = {$et['id']} and class_name = 'Element_OphNuPostoperative_PostOperative'");
	}
}
