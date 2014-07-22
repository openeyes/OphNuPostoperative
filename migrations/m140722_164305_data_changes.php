<?php

class m140722_164305_data_changes extends CDbMigration
{
	public function up()
	{
		$this->update('ophnupostoperative_postoperative_dental',array('name' => 'Full Lowers'),"id=1");
		$this->update('ophnupostoperative_postoperative_dental',array('name' => 'Full Uppers'),"id=2");
	}

	public function down()
	{
		$this->update('ophnupostoperative_postoperative_dental',array('name' => 'Full Lowers Returned'),"id=1");
		$this->update('ophnupostoperative_postoperative_dental',array('name' => 'Full Uppers Returned'),"id=2");
	}
}
