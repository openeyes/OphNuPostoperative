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
		<?php $form->widget('application.widgets.Records', array(
			'form' => $form,
			'element' => $element,
			'model' => new OphNuPostoperative_Vital,
			'field' => 'vitals',
			'validate_method' => '/OphNuPostoperative/default/validateVital',
			'row_view' => 'protected/modules/OphNuPostoperative/views/default/_vital_row.php',
			'columns' => array(
				array(
					'width' => 5,
					'field_width' => 5,
					'fields' => array(
						array('field' => 'hr_pulse_m','type' => 'text'),
						array('field' => 'blood_pressure_m','type' => 'blood_pressure'),
						array('field' => 'rr_m','type' => 'text'),
					),
				),
				array(
					'width' => 5,
					'fields' => array(
						array('field' => 'spo2_m','type' => 'text'),
						array('field' => 'o2','type' => 'text'),
						array('field' => 'pain_score_m','type' => 'text'),
					),
				),
			),
			'no_items_text' => 'No vitals have been recorded.',
			'add_button_text' => 'Add vital',
			'use_last_button_text' => 'Input last recorded vital signs',
		))?>
		<div id="div_Element_OphNuPostoperative_Vitals_glucose_level" class="row field-row">
			<div class="large-3 column">
				<label for="Element_OphNuPostoperative_Vitals_glucose_level">
					<?php echo $element->getAttributeLabel('glucose_level')?>:
				</label>
			</div>
			<div class="large-3 column end">
				<?php echo $form->bloodGlucoseMeasurement($element,array('nowrapper' => true, 'disabled' => $element->glucose_level_na),array('label' => 3, 'field' => 1, 'append-text' => 1))?>
				<?php echo $form->checkBox($element,'glucose_level_na',array('nowrapper' => true))?>
			</div>
		</div>
		<?php echo $form->textField($element, 'nausea_vomiting', array(), array(), array('label' => 3, 'field' => 4))?>
		<div id="div_Element_OphNuPostoperative_Vitals_blood_loss" class="row field-row">
			<div class="large-3 column">
				<label for="Element_OphNuPostoperative_Vitals_blood_loss">
					<?php echo $element->getAttributeLabel('blood_loss')?>:
				</label>
			</div>
			<div class="large-2 column end">
				<?php echo $form->textField($element,'blood_loss',array('nowrapper' => true),array(),array('label' => 3, 'field' => 1, 'append-text' => 1))?>
				<span class="metric">mL</span>
			</div>
		</div>
		<div id="div_Element_OphNuPostoperative_Vitals_total_fluid_intake" class="row field-row">
			<div class="large-3 column">
				<label for="Element_OphNuPostoperative_Vitals_total_fluid_intake">
					<?php echo $element->getAttributeLabel('total_fluid_intake')?>:
				</label>
			</div>
			<div class="large-2 column end">
				<?php echo $form->textField($element,'total_fluid_intake',array('nowrapper' => true),array(),array('label' => 3, 'field' => 1, 'append-text' => 1))?>
				<span class="metric">mL</span>
			</div>
		</div>
		<div id="div_Element_OphNuPostoperative_Vitals_total_fluid_outtake" class="row field-row">
			<div class="large-3 column">
				<label for="Element_OphNuPostoperative_Vitals_total_fluid_outtake">	
					<?php echo $element->getAttributeLabel('total_fluid_outtake')?>:
				</label>
			</div>
			<div class="large-2 column end">
				<?php echo $form->textField($element,'total_fluid_outtake',array('nowrapper' => true),array(),array('label' => 3, 'field' => 1, 'append-text' => 1))?>
				<span class="metric">mL</span>
			</div>
		</div>
		<?php echo $form->dropDownList($element, 'avpu_score_id', CHtml::listData(OphNuPostoperative_Vitals_AVPU_Score::model()->findAll(array('order'=>'display_order asc')),'id','name'), array(), false, array('label' => 3, 'field' => 2))?>
		<?php echo $form->dropDownList($element, 'mews_score', array(0,1,2,3,4,5), array(), false, array('label' => 3, 'field' => 2))?>
	</div>
