<?php

class m140723_061235_new_fields extends OEMigration
{
	public function up()
	{
		$this->addColumn('et_ophnupostoperative_postoperative','iv_discontinued','tinyint(1) unsigned null');
		$this->addColumn('et_ophnupostoperative_postoperative_version','iv_discontinued','tinyint(1) unsigned null');

		$this->addColumn('et_ophnupostoperative_postoperative','dressing_in_place','tinyint(1) unsigned null');
		$this->addColumn('et_ophnupostoperative_postoperative_version','dressing_in_place','tinyint(1) unsigned null');

		$this->createTable('ophnupostoperative_dressing_condition', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(16) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_dressing_condition_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_dressing_condition_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_dressing_condition_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_dressing_condition_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophnupostoperative_dressing_condition');

		$this->addColumn('et_ophnupostoperative_postoperative','dressing_condition_id','int(10) unsigned null');
		$this->addColumn('et_ophnupostoperative_postoperative_version','dressing_condition_id','int(10) unsigned null');
		$this->createIndex('et_ophnupostoperative_postoperative_dressing_condition_id_fk','et_ophnupostoperative_postoperative','dressing_condition_id');
		$this->addForeignKey('et_ophnupostoperative_postoperative_dressing_condition_id_fk','et_ophnupostoperative_postoperative','dressing_condition_id','ophnupostoperative_dressing_condition','id');

		$this->addColumn('et_ophnupostoperative_postoperative','ecg_dots_removed','tinyint(1) unsigned null');
		$this->addColumn('et_ophnupostoperative_postoperative_version','ecg_dots_removed','tinyint(1) unsigned null');

		$this->createTable('ophnupostoperative_belongings_returned', array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'name' => 'varchar(16) not null',
				'display_order' => 'tinyint(1) unsigned not null',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `ophnupostoperative_belongings_returned_lmui_fk` (`last_modified_user_id`)',
				'KEY `ophnupostoperative_belongings_returned_cui_fk` (`created_user_id`)',
				'CONSTRAINT `ophnupostoperative_belongings_returned_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `ophnupostoperative_belongings_returned_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
			), 'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci');

		$this->versionExistingTable('ophnupostoperative_belongings_returned');

		$this->addColumn('et_ophnupostoperative_postoperative','belongings_returned_id','int(10) unsigned null');
		$this->addColumn('et_ophnupostoperative_postoperative_version','belongings_returned_id','int(10) unsigned null');
		$this->createIndex('et_ophnupostoperative_postoperative_belongings_returned_id_fk','et_ophnupostoperative_postoperative','belongings_returned_id');
		$this->addForeignKey('et_ophnupostoperative_postoperative_belongings_returned_id_fk','et_ophnupostoperative_postoperative','belongings_returned_id','ophnupostoperative_belongings_returned','id');

		$this->initialiseData(dirname(__FILE__));

		foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_postoperative")->queryAll() as $row) {
			if ($row['patent_belongings_returned'] !== null) {
				if ($row['patent_belongings_returned'] == 1) {
					$this->update('et_ophnupostoperative_postoperative',array('belongings_returned_id' => 1),"id = {$row['id']}");
				} else {
					$this->update('et_ophnupostoperative_postoperative',array('belongings_returned_id' => 2),"id = {$row['id']}");
				}
			}

			foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_postoperative_version")->where("id = {$row['id']}")->queryAll() as $version) {
				if ($version['patent_belongings_returned'] !== null) {
					if ($version['patent_belongings_returned'] == 1) {
						$this->update('et_ophnupostoperative_postoperative_version',array('belongings_returned_id' => 1),"id = {$version['id']}");
					} else {
						$this->update('et_ophnupostoperative_postoperative_version',array('belongings_returned_id' => 2),"id = {$version['id']}");
					}
				}
			}
		}

		$this->dropColumn('et_ophnupostoperative_postoperative','patent_belongings_returned');
		$this->dropColumn('et_ophnupostoperative_postoperative_version','patent_belongings_returned');

		$this->update('ophnupostoperative_postoperative_dental',array('name' => 'Others (please specify)'),'id=3');
	}

	public function down()
	{
		$this->update('ophnupostoperative_postoperative_dental',array('name' => 'Other (please specify)'),'id=3');

		$this->addColumn('et_ophnupostoperative_postoperative','patent_belongings_returned','tinyint(1) unsigned null');
		$this->addColumn('et_ophnupostoperative_postoperative_version','patent_belongings_returned','tinyint(1) unsigned null');

		foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_postoperative")->queryAll() as $row) {
			if ($row['belongings_returned_id'] !== null) {
				if ($row['belongings_returned_id'] == 1) {
					$this->update('et_ophnupostoperative_postoperative',array('patent_belongings_returned' => 1),"id = {$row['id']}");
				} else {
					$this->update('et_ophnupostoperative_postoperative',array('patent_belongings_returned' => 0),"id = {$row['id']}");
				}
			}

			foreach ($this->dbConnection->createCommand()->select("*")->from("et_ophnupostoperative_postoperative_version")->where("id = {$row['id']}")->queryAll() as $version) {
				if ($version['belongings_returned_id'] !== null) {
					if ($version['belongings_returned_id'] == 1) {
						$this->update('et_ophnupostoperative_postoperative_version',array('patent_belongings_returned' => 1),"id = {$version['id']}");
					} else {
						$this->update('et_ophnupostoperative_postoperative_version',array('patent_belongings_returned' => 0),"id = {$version['id']}");
					}
				}
			}
		}

		$this->dropForeignKey('et_ophnupostoperative_postoperative_belongings_returned_id_fk','et_ophnupostoperative_postoperative');
		$this->dropColumn('et_ophnupostoperative_postoperative','belongings_returned_id');
		$this->dropColumn('et_ophnupostoperative_postoperative_version','belongings_returned_id');

		$this->dropTable('ophnupostoperative_belongings_returned_version');
		$this->dropTable('ophnupostoperative_belongings_returned');

		$this->dropColumn('et_ophnupostoperative_postoperative','ecg_dots_removed');
		$this->dropColumn('et_ophnupostoperative_postoperative_version','ecg_dots_removed');

		$this->dropForeignKey('et_ophnupostoperative_postoperative_dressing_condition_id_fk','et_ophnupostoperative_postoperative');
		$this->dropColumn('et_ophnupostoperative_postoperative','dressing_condition_id');
		$this->dropColumn('et_ophnupostoperative_postoperative_version','dressing_condition_id');

		$this->dropTable('ophnupostoperative_dressing_condition_version');
		$this->dropTable('ophnupostoperative_dressing_condition');

		$this->dropColumn('et_ophnupostoperative_postoperative_version','dressing_in_place');
		$this->dropColumn('et_ophnupostoperative_postoperative','dressing_in_place');

		$this->dropColumn('et_ophnupostoperative_postoperative','iv_discontinued');
		$this->dropColumn('et_ophnupostoperative_postoperative_version','iv_discontinued');
	}
}
