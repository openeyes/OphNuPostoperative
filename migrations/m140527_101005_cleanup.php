<?php

class m140527_101005_cleanup extends CDbMigration
{
	public $stuff = array(
		'et_ophnupostoperative_postoperative_belongassign' => array(
			'name' => 'ophnupostoperative_postoperative_belongassign',
			'keys' => array(
				'opba_lmui_fk' => array('last_modified_user_id','user','ophnupostoperative_postoperative_belongassign_lmui_fk'),
				'ophnupostoperative_postoperative_belongings_assignment_cui_fk' => array('created_user_id','user','ophnupostoperative_postoperative_belongassign_cui_fk'),
				'ophnupostoperative_postoperative_belongings_assignment_ele_fk' => array('element_id','et_ophnupostoperative_postoperative','ophnupostoperative_postoperative_belongassign_ele_fk'),
				'ophnupostoperative_postoperative_belongings_assignment_lku_fk' => array('belonging_id','ophnupostoperative_postoperative_belongings','ophnupostoperative_postoperative_belongassign_lku_fk'),
			),
			'fields' => array(
				'ophnupostoperative_postoperative_belongings_id' => 'belonging_id',
			),
		),
		'et_ophnupostoperative_postoperative_dental_assignment' => array(
			'name' => 'ophnupostoperative_postoperative_dental_assignment',
			'keys' => array(
				'{table}_lmui_fk' => array('last_modified_user_id','user'),
				'{table}_cui_fk' => array('created_user_id','user'),
				'{table}_ele_fk' => array('element_id','et_ophnupostoperative_postoperative'),
				'{table}_lku_fk' => array('dental_id','ophnupostoperative_postoperative_dental'),
			),
			'fields' => array(
				'ophnupostoperative_postoperative_dental_id' => 'dental_id',
			),
		),
		'et_ophnupostoperative_postoperative_falls_assignment' => array(
			'name' => 'ophnupostoperative_postoperative_falls_assignment',
			'keys' => array(
				'{table}_lmui_fk' => array('last_modified_user_id','user'),
				'{table}_cui_fk' => array('created_user_id','user'),
				'{table}_ele_fk' => array('element_id','et_ophnupostoperative_postoperative'),
				'{table}_lku_fk' => array('fall_id','ophnupostoperative_postoperative_falls'),
			),
			'fields' => array(
				'ophnupostoperative_postoperative_falls_id' => 'fall_id',
			),
		),
		'et_ophnupostoperative_postoperative_hearing_assignment' => array(
			'name' => 'ophnupostoperative_postoperative_hearing_assignment',
			'keys' => array(
				'{table}_lmui_fk' => array('last_modified_user_id','user'),
				'{table}_cui_fk' => array('created_user_id','user'),
				'{table}_ele_fk' => array('element_id','et_ophnupostoperative_postoperative'),
				'{table}_lku_fk' => array('hearing_id','ophnupostoperative_postoperative_hearing'),
			),
			'fields' => array(
				'ophnupostoperative_postoperative_hearing_id' => 'hearing_id',
			),
		),
		'et_ophnupostoperative_postoperative_obs_assignment' => array(
			'name' => 'ophnupostoperative_postoperative_obs_assignment',
			'keys' => array(
				'{table}_lmui_fk' => array('last_modified_user_id','user'),
				'{table}_cui_fk' => array('created_user_id','user'),
				'{table}_ele_fk' => array('element_id','et_ophnupostoperative_postoperative'),
				'{table}_lku_fk' => array('ob_id','ophnupostoperative_postoperative_obs'),
			),
			'fields' => array(
				'ophnupostoperative_postoperative_obs_id' => 'ob_id',
			),
		),
		'et_ophnupostoperative_postoperative_skin_assignment' => array(
			'name' => 'ophnupostoperative_postoperative_skin_assignment',
			'keys' => array(
				'{table}_lmui_fk' => array('last_modified_user_id','user'),
				'{table}_cui_fk' => array('created_user_id','user'),
				'{table}_ele_fk' => array('element_id','et_ophnupostoperative_postoperative'),
				'{table}_lku_fk' => array('skin_id','ophnupostoperative_postoperative_skin'),
			),
			'fields' => array(
				'ophnupostoperative_postoperative_skin_id' => 'skin_id',
			),
		),
	);

	public function up()
	{
		foreach ($this->stuff as $table => $params) {
			foreach ($params['keys'] as $key => $key_params) {
				if (preg_match('/\{table\}/',$key)) {
					$key_name = str_replace('{table}',$table,$key);
				} else {
					$key_name = 'et_'.$key;
				}

				$this->dropForeignKey($key_name,$table);
				$this->dropIndex($key_name,$table);
			}

			if (@$params['name']) {
				$target = @$params['name'];
			} else {
				$target = preg_replace('/^et_/','',$table);
			}

			$this->renameTable($table,$target);
			$this->renameTable($table.'_version',$target.'_version');

			if (!empty($params['fields'])) {
				foreach ($params['fields'] as $from => $to) {
					$this->renameColumn($target,$from,$to);
					$this->renameColumn($target.'_version',$from,$to);
				}
			}

			foreach ($params['keys'] as $key => $key_params) {
				if (preg_match('/\{table\}/',$key)) {
					$key_name = str_replace('{table}',$target,$key);
				} else {
					$key_name = $key;
				}

				if (isset($key_params[2])) {
					$key_name = $key_params[2];
				}

				if (isset($params['fields'][$key_params[0]])) {
					$field = $params['fields'][$key_params[0]];
				} else {
					$field = $key_params[0];
				}
				$this->createIndex($key_name,$target,$field);
				$this->addForeignKey($key_name,$target,$field,$key_params[1],'id');
			}
		}
	}

	public function down()
	{
		foreach (array_reverse($this->stuff) as $table => $params) {
			$target = $table;

			if (@$params['name']) {
				$table = $params['name'];
			} else {
				$table = preg_replace('/^et_/','',$table);
			}

			foreach ($params['keys'] as $key => $key_params) {
				if (preg_match('/\{table\}/',$key)) {
					$key_name = str_replace('{table}',$table,$key);
				} else {
					$key_name = $key;
				}
				if (isset($key_params[2])) {
					$key_name = $key_params[2];
				}
				$this->dropForeignKey($key_name,$table);
				$this->dropIndex($key_name,$table);
			}

			$this->renameTable($table,$target);
			$this->renameTable($table.'_version',$target.'_version');

			if (!empty($params['fields'])) {
				foreach ($params['fields'] as $to => $from) {
					$this->renameColumn($target,$from,$to);
					$this->renameColumn($target.'_version',$from,$to);
				}
			}

			foreach ($params['keys'] as $key => $key_params) {
				if (preg_match('/\{table\}/',$key)) {
					$key_name = str_replace('{table}',$target,$key);
				} else {
					$key_name = 'et_'.$key;
				}

				$field = $key_params[0];

				if (isset($params['fields'])) {
					foreach ($params['fields'] as $k => $v) {
						if ($v == $key_params[0]) {
							$field = $k;
						}
					}
				}

				$this->createIndex($key_name,$target,$field);
				$this->addForeignKey($key_name,$target,$field,$key_params[1],'id');
			} 
		}
	}
}
