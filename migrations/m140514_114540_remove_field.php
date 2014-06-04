<?php

class m140514_114540_remove_field extends CDbMigration
{
	public function up()
	{
		$this->dropColumn('et_ophnupostoperative_progressnote','progress_notes');
	}

	public function down()
	{
		$this->addColumn('et_ophnupostoperative_progressnote','progress_notes','text NULL COLLATE \'utf8_bin\'');
	}

}