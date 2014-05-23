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
	<div class="element-data">
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('patient_id_verified_with_two_identifiers'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->patient_id_verified_with_two_identifiers ? 'Yes' : 'No'?></div></div>
		</div>
		<?php if ($element->patient_id_verified_with_two_identifiers) {?>
			<div class="row data-row">
				<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('identifiers'))?>:</div></div>
				<div class="large-9 column end"><div class="data-value"><?php if (!$element->identifiers) {?>
								None
							<?php } else {?>
									<?php foreach ($element->identifiers as $item) {
										echo $item->name?><br/>
									<?php }?>
							<?php }?>
				</div></div>
			</div>
		<?php }?>
		<?php $this->widget('application.widgets.AllergySelection', array(
			'form' => $form,
			'element' => $element,
			'label' => 'Allergies',
			'relation' => 'allergies',
			'input_name' => 'allergies',
			'no_allergies_field' => 'patient_has_no_allergies',
			'edit' => false,
		))?>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('allergies_verified'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->allergies_verified ? 'Yes' : 'No'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('patient_enters_recovery_room'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo CHtml::encode($element->patient_enters_recovery_room)?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('hand_off_from_id'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->hand_off_from ? $element->hand_off_from->fullName : 'Not recoreded'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('hand_off_to_id'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->hand_off_to ? $element->hand_off_to->fullName : 'Not recorded'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('handing_off_from_id'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->handing_off_from ? $element->handing_off_from->fullName : 'Not recorded'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('translator_present_id'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->translator_present ? $element->translator_present->name : 'Not recorded'?></div></div>
		</div>
		<?php if ($element->translator_present && $element->translator_present->name == 'Yes') {?>
			<div class="row data-row">
				<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('name_of_translator'))?></div></div>
				<div class="large-9 column end"><div class="data-value"><?php echo CHtml::encode($element->name_of_translator)?></div></div>
			</div>
		<?php }?>
	</div>
