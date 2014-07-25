<?php

class m140725_165426_schema_fixes extends OEMigration
{
	public function up()
	{
		$this->dropColumn('ophnupostoperative_postoperative_progress_notes','default');
		$this->versionExistingTable('ophnupostoperative_postoperative_progress_notes');
	}

	public function down()
	{
		$this->dropTable('ophnupostoperative_postoperative_progress_notes_version');
		$this->addColumn('ophnupostoperative_postoperative_progress_notes','default','tinyint(1) unsigned not null');
	}
}
