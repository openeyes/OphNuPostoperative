<?php

class m140513_131242_progress_notes extends CDbMigration
{
	public function up()
	{
		$this->createTable('ophnupostoperative_postoperative_progress_notes',array(
			'id'=> 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
			'element_id' => 'INT(10) UNSIGNED NOT NULL',
			'comment' => 'text NOT NULL COLLATE \'utf8_bin\'',
			'comment_date' => 'DATETIME NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'default'=> 'TINYINT(1) UNSIGNED NOT NULL',
			'last_modified_user_id' => 'INT(10) UNSIGNED NOT NULL DEFAULT \'1\'',
			'last_modified_date' => 'DATETIME NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'created_user_id' => 'INT(10) UNSIGNED NOT NULL DEFAULT \'1\'',
			'created_date'=>'DATETIME NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
			'PRIMARY KEY (`id`)',
			'INDEX `et_ophnupostoperative_postoperative_progress_notes_lmui_fk` (`last_modified_user_id`)',
			'INDEX `et_ophnupostoperative_postoperative_progress_notes_cui_fk` (`created_user_id`)',
			'INDEX `et_ophnupostoperative_postoperative_progress_notes_ele_fk` (`element_id`)',
			'CONSTRAINT `et_ophnupostoperative_postoperative_progress_notes_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
			'CONSTRAINT `et_ophnupostoperative_postoperative_progress_notes_ele_fk` FOREIGN KEY (`element_id`) REFERENCES `et_ophnupostoperative_progressnote` (`id`)',
			'CONSTRAINT `et_ophnupostoperative_postoperative_progress_notes_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)'
		), 'COLLATE=`utf8_bin` ENGINE=InnoDB AUTO_INCREMENT=7');

		$old_notes = Yii::app()->db->createCommand()
			->select('*')
			->from('et_ophnupostoperative_progressnote')
			->where('progress_notes IS NOT NULL')
			->queryAll();

		foreach($old_notes as $old_note) {
			$command = Yii::app()->db->createCommand();
			$command->insert('ophnupostoperative_postoperative_progress_notes', array(
				'element_id'=>$old_note['id'],
				'comment_date'=>$old_note['created_date'],
				'created_date' =>$old_note['created_date'],
				'comment'=>$old_note['progress_notes'],
				'last_modified_user_id'=>$old_note['last_modified_user_id'],
				'last_modified_date'=>$old_note['last_modified_date'],
				'created_user_id' =>$old_note['created_user_id'],
			));
		}
		$this->dropColumn('et_ophnupostoperative_progressnote','progress_notes');
	}

	public function down()
	{
		$this->dropTable('ophnupostoperative_postoperative_progress_notes');
		$this->addColumn('et_ophnupostoperative_progressnote','progress_notes','text COLLATE utf8_bin DEFAULT');
	}
}