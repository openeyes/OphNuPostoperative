<?php

class m140801_120427_change_event_type_name extends OEMigration
{
	public function up()
	{
		$this->update('event_type',
			array('name' => 'Nursing post-operative record'),
			"class_name = 'OphNuPostoperative'"
		);
	}

	public function down()
	{
		$this->update('event_type',
			array('name' => 'Post-operative nursing note'),
			"class_name = 'OphNuPostoperative'"
		);
	}
}