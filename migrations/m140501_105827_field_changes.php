<?php

class m140501_105827_field_changes extends CDbMigration
{
	public function up()
	{
		$this->update('ophnupostoperative_postoperative_skin',array('name'=>'Other (please specify)'),"name = 'Other'");
		$this->update('ophnupostoperative_postoperative_obs',array('name'=>'Other (please specify)'),"name = 'Other'");
		$this->update('ophnupostoperative_postoperative_dental',array('name'=>'Other (please specify)'),"name = 'Other Returned'");
		$this->update('ophnupostoperative_postoperative_belongings',array('name'=>'Other (please specify)'),"name = 'Other'");
	}

	public function down()
	{
		$this->update('ophnupostoperative_postoperative_skin',array('name'=>'Other'),"name = 'Other (please specify)'");
		$this->update('ophnupostoperative_postoperative_obs',array('name'=>'Other'),"name = 'Other (please specify)'");
		$this->update('ophnupostoperative_postoperative_dental',array('name'=>'Other Returned'),"name = 'Other (please specify)'");
		$this->update('ophnupostoperative_postoperative_belongings',array('name'=>'Other'),"name = 'Other (please specify)'");
	}
}
