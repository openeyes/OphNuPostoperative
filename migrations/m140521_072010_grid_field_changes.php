<?php

class m140521_072010_grid_field_changes extends CDbMigration
{
	public function up()
	{
		$this->update('ophnupostoperative_vital_type',array('field_type_id' => 3),"name in ('Pain score','MEWS score (adults)')");
	}

	public function down()
	{
		$this->update('ophnupostoperative_vital_type',array('field_type_id' => 5),"name in ('Pain score','MEWS score (adults)')");
	}
}
