<?php

class m140808_095750_spo2_is_sao2 extends CDbMigration
{
	public function up()
	{
		$this->dropForeignKey('ophnupostoperative_vital_spmi_fk','ophnupostoperative_vital');

		$this->renameColumn('ophnupostoperative_vital','spo2_m_id','sao2_m_id');
		$this->renameColumn('ophnupostoperative_vital_version','spo2_m_id','sao2_m_id');

		$this->addForeignKey('ophnupostoperative_vital_sami_fk','ophnupostoperative_vital','sao2_m_id','measurement_sao2','id');
	}

	public function down()
	{
		$this->dropForeignKey('ophnupostoperative_vital_spmi_fk','ophnupostoperative_vital');

		$this->renameColumn('ophnupostoperative_vital','spo2_m_id','sao2_m_id');
		$this->renameColumn('ophnupostoperative_vital_version','spo2_m_id','sao2_m_id');

		$this->addForeignKey('ophnupostoperative_vital_sami_fk','ophnupostoperative_vital','sao2_m_id','measurement_sao2','id');
	}
}
