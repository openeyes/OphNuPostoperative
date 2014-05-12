<?php

class m140512_071331_field_changes extends CDbMigration
{
	public function up()
	{
		$this->dropColumn('et_ophnupostoperative_vitals','anaesthesia_end_time');
		$this->dropColumn('et_ophnupostoperative_vitals','surgery_start_time');
		$this->dropColumn('et_ophnupostoperative_vitals','surgery_end_time');

		$this->addColumn('et_ophnupostoperative_vitals','total_fluid_intake','varchar(64)');
		$this->addColumn('et_ophnupostoperative_vitals','total_fluid_outtake','varchar(64)');
	}

	public function down()
	{
		$this->dropColumn('et_ophnupostoperative_vitals','total_fluid_intake');
		$this->dropColumn('et_ophnupostoperative_vitals','total_fluid_outtake');

		$this->addColumn('et_ophnupostoperative_vitals','anaesthesia_end_time','time not null');
		$this->addColumn('et_ophnupostoperative_vitals','surgery_start_time','time not null');
		$this->addColumn('et_ophnupostoperative_vitals','surgery_end_time','time not null');
	}
}
