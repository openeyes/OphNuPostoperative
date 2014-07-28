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
		<div id="div_Element_OphNuPostoperative_Patient_patient_enters_recovery_room" class="row field-row">
			<div class="large-3 column">
				<label for="Element_OphNuPostoperative_Patient_patient_enters_recovery_room"><?php echo $element->getAttributeLabel('patient_enters_recovery_room')?>:</label>
			</div>
			<div class="large-2 column end">
				<?php echo $form->textField($element, 'patient_enters_recovery_room', array('nowrapper' => true), array(), array('label' => 3, 'field' => 1))?>
				<button type="submit" class="secondary small time-now" data-target="patient_enters_recovery_room">Now</button>
			</div>
		</div>
		<?php echo $form->dropDownList($element, 'anaesthesia_handoff_from_id', CHtml::listData(User::model()->findAll(array('order'=> 'first_name asc, last_name asc')),'id','fullName'),array('empty'=>'- Please select -'),false,array('label' => 3, 'field' => 4))?>
		<?php echo $form->dropDownList($element, 'anaesthesia_handoff_to_id', CHtml::listData(User::model()->findAll(array('order'=> 'first_name asc, last_name asc')),'id','fullName'),array('empty'=>'- Please select -'),false,array('label' => 3, 'field' => 4))?>
		<?php echo $form->dropDownList($element, 'nursing_handoff_from_id', CHtml::listData(User::model()->findAll(array('order'=> 'first_name asc, last_name asc')),'id','fullName'),array('empty'=>'- Please select -'),false,array('label' => 3, 'field' => 4))?>
	</div>
