<?php

class m140512_133448_grid_field_changes extends CDbMigration
{
	public function up()
	{
		$this->delete('ophnupostoperative_vitals_drug');
		$this->delete('ophnupostoperative_vitals_gas');
		$this->delete('ophnupostoperative_vital_type_field_type_option');

		$this->delete('ophnupostoperative_vital_type',"name in ('ECG Rhythm','TV','ETCO2','PNS','Position')");

		$this->insert('ophnupostoperative_vital_type',array('id'=>3,'name'=>'RR','display_order'=>3,'field_type_id'=>5));
		$this->insert('ophnupostoperative_vital_type',array('id'=>5,'name'=>'O2','unit'=>'L/min','display_order'=>5,'field_type_id'=>3));
		$this->insert('ophnupostoperative_vital_type',array('id'=>6,'name'=>'Glucose level','display_order'=>6,'field_type_id'=>3));

		$this->insert('ophnupostoperative_vital_type',array('id'=>8,'name'=>'Pain score','display_order'=>8,'field_type_id'=>3));
		$this->insert('ophnupostoperative_vital_type',array('id'=>9,'name'=>'Nausea/vomiting','display_order'=>9,'field_type_id'=>5));
		$this->insert('ophnupostoperative_vital_type',array('id'=>10,'name'=>'Blood loss','display_order'=>10,'field_type_id'=>5));
		$this->insert('ophnupostoperative_vital_type',array('id'=>11,'name'=>'AVPU','display_order'=>11,'field_type_id'=>5));
		$this->insert('ophnupostoperative_vital_type',array('id'=>12,'name'=>'MEWS score (adults)','display_order'=>12,'field_type_id'=>5));
	}

	public function down()
	{
		$this->delete('ophnupostoperative_vital_type',"name in ('RR','O2','Glucose level','Pain score','Nausea/vomiting','Blood loss','AVPU','MEWS score (adults)')");

		$this->insert('ophnupostoperative_vitals_drug',array('id'=>1,'name'=>'Fentanyl','display_order'=>1));
		$this->insert('ophnupostoperative_vitals_drug',array('id'=>2,'name'=>'Atropine','display_order'=>2));
		$this->insert('ophnupostoperative_vitals_drug',array('id'=>3,'name'=>'Ephedrine','display_order'=>3));

		$this->Insert('ophnupostoperative_vitals_gas',array('id'=>1,'name'=>'Oxygen','display_order'=>1,'field_type_id'=>1));
		$this->Insert('ophnupostoperative_vitals_gas',array('id'=>2,'name'=>'Air/N2O','display_order'=>2,'field_type_id'=>1));
		$this->Insert('ophnupostoperative_vitals_gas',array('id'=>3,'name'=>'Iso/Sev','display_order'=>3,'field_type_id'=>1));

		$this->insert('ophnupostoperative_vital_type',array('id'=>3,'name'=>'ECG Rhythm','display_order'=>3,'field_type_id'=>2));
		$this->insert('ophnupostoperative_vital_type',array('id'=>5,'name'=>'TV','unit'=>'ml','display_order'=>5,'field_type_id'=>3));
		$this->insert('ophnupostoperative_vital_type',array('id'=>6,'name'=>'ETCO2','unit'=>'%','display_order'=>6,'field_type_id'=>1));
		$this->insert('ophnupostoperative_vital_type',array('id'=>8,'name'=>'PNS','display_order'=>8,'field_type_id'=>3));
		$this->insert('ophnupostoperative_vital_type',array('id'=>9,'name'=>'Position','display_order'=>9,'field_type_id'=>2));

		$this->insert('ophnupostoperative_vital_type_field_type_option',array('id'=>1,'vital_type_id'=>3,'name'=>'SR','display_order'=>1));
		$this->insert('ophnupostoperative_vital_type_field_type_option',array('id'=>2,'vital_type_id'=>3,'name'=>'AF','display_order'=>2));
		$this->insert('ophnupostoperative_vital_type_field_type_option',array('id'=>3,'vital_type_id'=>8,'name'=>'Superior','display_order'=>1));
		$this->insert('ophnupostoperative_vital_type_field_type_option',array('id'=>4,'vital_type_id'=>8,'name'=>'Temporal','display_order'=>2));
		$this->insert('ophnupostoperative_vital_type_field_type_option',array('id'=>5,'vital_type_id'=>9,'name'=>'Inferior','display_order'=>1));
		$this->insert('ophnupostoperative_vital_type_field_type_option',array('id'=>6,'vital_type_id'=>9,'name'=>'Nasal','display_order'=>2));
	}
}
