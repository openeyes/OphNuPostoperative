<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */
?>
	<div class="element-fields">
		<?php echo $form->dropDownList($element, 'signout_lead_by_id', CHtml::listData(User::model()->findAll(array('order'=> 'first_name asc, last_name asc')),'id','fullName'),array('empty' => '- Please select -'),false,array('label' => 3, 'field' => 4))?>
		<?php echo $form->radioBoolean($element, 'surgical_count_completed', array(), array('label' => 3, 'field' => 4))?>
		<?php echo $form->radioButtons($element, 'labelling_id', CHtml::listData(OphNuPostoperative_WHOSignOut_Labelling::model()->findAll(array('order' => 'display_order asc')),'id','name'), null, false, false, false, false, array(), array('label' => 3, 'field' => 4))?>
		<?php echo $form->radioBoolean($element, 'equipment_problems', array('class' => 'linked-fields', 'data-linked-fields' => 'problems,equipment_problems_comments', 'data-linked-values' => 'Yes'), array('label' => 3, 'field' => 4))?>
		<?php echo $form->multiSelectList($element, 'problems', 'problems', 'problem_id', CHtml::listData(OphNuPostoperative_WHOSignOut_EquipmentProblems::model()->findAll(array('order' => 'name asc')),'id','name'), array(), array('label' => $element->getAttributeLabel('problems'), 'empty' => '- Please select -'), !$element->equipment_problems, false, null, false, false, array('label' => 3, 'field' => 4))?>
		<?php echo $form->textArea($element, 'equipment_problems_comments', array(), !$element->equipment_problems, array(), array('label' => 3, 'field' => 4))?>
		<?php echo $form->radioButtons($element, 'instructions_provided_id', CHtml::listData(OphNuPostoperative_WHOSignOut_InstructionsProvided::model()->findAll(array('order' => 'display_order asc')),'id','name'), null, false, false, false, false, array(), array('label' => 3, 'field' => 4))?>
	</div>
