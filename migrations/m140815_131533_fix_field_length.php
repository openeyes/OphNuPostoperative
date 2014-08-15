<?php

class m140815_131533_fix_field_length extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('ophnupostoperative_dressing_condition','name','varchar(64) not null');
		$this->alterColumn('ophnupostoperative_dressing_condition_version','name','varchar(64) not null');

		$this->update('ophnupostoperative_dressing_condition',array('name' => 'Needs to be changed'),"id=4");
	}

	public function down()
	{
		$this->alterColumn('ophnupostoperative_dressing_condition','name','varchar(16) not null');
		$this->alterColumn('ophnupostoperative_dressing_condition_version','name','varchar(16) not null');
	}
}
