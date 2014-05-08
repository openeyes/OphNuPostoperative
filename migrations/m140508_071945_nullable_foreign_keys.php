<?php

class m140508_071945_nullable_foreign_keys extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('et_ophnupostoperative_patient','hand_off_from_id','int(10) unsigned null');
		$this->alterColumn('et_ophnupostoperative_patient','hand_off_to_id','int(10) unsigned null');
		$this->alterColumn('et_ophnupostoperative_patient','handing_off_from_id','int(10) unsigned null');
		$this->alterColumn('et_ophnupostoperative_patient','translator_present_id','int(10) unsigned null');
		$this->alterColumn('et_ophnupostoperative_postoperative','removable_dental_id','int(10) unsigned null');
		$this->alterColumn('et_ophnupostoperative_postoperative','hearing_aid_returned_id','int(10) unsigned null');
		$this->alterColumn('et_ophnupostoperative_vitals','anaesthesia_start_time','time null');
		$this->alterColumn('et_ophnupostoperative_vitals','anaesthesia_end_time','time null');
		$this->alterColumn('et_ophnupostoperative_vitals','surgery_start_time','time null');
		$this->alterColumn('et_ophnupostoperative_vitals','surgery_end_time','time null');
		$this->alterColumn('et_ophnupostoperative_postoperative','fallsmobility','tinyint(1) unsigned null');
		$this->alterColumn('et_ophnupostoperative_postoperative','patent_belongings_returned','tinyint(1) unsigned null');
	}

	public function down()
	{
		$this->alterColumn('et_ophnupostoperative_patient','hand_off_from_id','int(10) unsigned not null');
		$this->alterColumn('et_ophnupostoperative_patient','hand_off_to_id','int(10) unsigned not null');
		$this->alterColumn('et_ophnupostoperative_patient','handing_off_from_id','int(10) unsigned not null');
		$this->alterColumn('et_ophnupostoperative_patient','translator_present_id','int(10) unsigned not null');
		$this->alterColumn('et_ophnupostoperative_postoperative','removable_dental_id','int(10) unsigned not null');
		$this->alterColumn('et_ophnupostoperative_postoperative','hearing_aid_returned_id','int(10) unsigned not null');
		$this->alterColumn('et_ophnupostoperative_vitals','anaesthesia_start_time','time not null');
		$this->alterColumn('et_ophnupostoperative_vitals','anaesthesia_end_time','time not null');
		$this->alterColumn('et_ophnupostoperative_vitals','surgery_start_time','time not null');
		$this->alterColumn('et_ophnupostoperative_vitals','surgery_end_time','time not null');
		$this->alterColumn('et_ophnupostoperative_postoperative','fallsmobility','tinyint(1) unsigned not null');
		$this->alterColumn('et_ophnupostoperative_postoperative','patent_belongings_returned','tinyint(1) unsigned not null');
	}
}
