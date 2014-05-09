<?php

class m140509_125240_module_name extends CDbMigration
{
	public function up()
	{
		$this->update('event_type',array('name' => 'Post-operative nursing note'),"class_name = 'OphNuPostoperative'");
	}

	public function down()
	{
		$this->update('event_type',array('name' => 'Post-operative Nursing Note'),"class_name = 'OphNuPostoperative'");
	}
}
