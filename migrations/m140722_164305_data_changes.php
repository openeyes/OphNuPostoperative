<?php

class m140722_164305_data_changes extends CDbMigration
{
	public function up()
	{
		$this->update('ophnupostoperative_postoperative_dental',array('name' => 'Full lowers'),"id=1");
		$this->update('ophnupostoperative_postoperative_dental',array('name' => 'Full uppers'),"id=2");

		$this->update('ophnupostoperative_postoperative_hearing',array('name' => 'Right hearing aid'),"id=1");
		$this->update('ophnupostoperative_postoperative_hearing',array('name' => 'Left hearing aid'),"id=2");
	}

	public function down()
	{
		$this->update('ophnupostoperative_postoperative_dental',array('name' => 'Full Lowers Returned'),"id=1");
		$this->update('ophnupostoperative_postoperative_dental',array('name' => 'Full Uppers Returned'),"id=2");

		$this->update('ophnupostoperative_postoperative_hearing',array('name' => 'Right hearing aid returned'),"id=1");
		$this->update('ophnupostoperative_postoperative_hearing',array('name' => 'Left hearing aid returned'),"id=2");
	}
}
