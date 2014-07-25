<?php

class m140725_074358_avpu_values extends OEMigration
{
	public function up()
	{
		$this->update('et_ophnupostoperative_vitals',array('avpu_score_id' => null));
		$this->delete('ophnupostoperative_vital_avpu');

		$this->initialiseData(dirname(__FILE__));
	}

	public function down()
	{
	}
}
