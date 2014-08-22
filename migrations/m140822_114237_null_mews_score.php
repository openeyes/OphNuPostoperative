<?php // [ORB-370]

class m140822_114237_null_mews_score extends OEMigration
{
	public function up()
	{
		$this->alterColumn('et_ophnupostoperative_vitals','mews_score','tinyint(1) unsigned null');
		$this->alterColumn('et_ophnupostoperative_vitals_version','mews_score','tinyint(1) unsigned null');
		$this->refreshTableSchema('et_ophnupostoperative_vitals');
		$this->refreshTableSchema('et_ophnupostoperative_vitals_version');
	}

	public function down()
	{
		$this->alterColumn('et_ophnupostoperative_vitals','mews_score','tinyint(1) unsigned not null');
		$this->alterColumn('et_ophnupostoperative_vitals_version','mews_score','tinyint(1) unsigned not null');
		$this->refreshTableSchema('et_ophnupostoperative_vitals');
		$this->refreshTableSchema('et_ophnupostoperative_vitals_version');
	}
}