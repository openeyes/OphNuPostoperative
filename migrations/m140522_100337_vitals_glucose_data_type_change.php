<?php

class m140522_100337_vitals_glucose_data_type_change extends OEMigration
{
	public function up()
	{
		$this->insert('ophnupostoperative_vital_type_field_type',array('id'=>6,'name'=>'Decimal','display_order'=>6));
		$this->update('ophnupostoperative_vital_type',array('field_type_id'=>6),"name ='Glucose level'");
	}

	public function down()
	{
		$this->update('ophnupostoperative_vital_type',array('field_type_id'=>3),"name ='Glucose level'");
		$this->execute("delete from ophnupostoperative_vital_type_field_type where name = 'Decimal'");

	}
}