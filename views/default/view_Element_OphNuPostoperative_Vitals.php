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
		<?php $this->widget('application.widgets.Records', array(
			'form' => $form,
			'element' => $element,
			'model' => new OphNuPostoperative_Vital,
			'field' => 'vitals',
			'edit' => false,
			'validate_method' => '/OphNuPostoperative/default/validateVital',
			'row_view' => 'protected/modules/OphNuPostoperative/views/default/_vital_row.php',
			'columns' => array(
				array(
					'width' => 5,
					'fields' => array('hr_pulse','blood_pressure','rr'),
				),
				array(
					'width' => 5,
					'fields' => array('spo2','o2','pain_score'),
				),
			),
			'no_items_text' => 'No vitals have been recorded.',
			'add_button_text' => 'Add vital',
			'use_last_button_text' => 'Input last recorded vital signs',
		))?>
		<div class="row field-row">
			<div class="large-3 column">
				<div class="data-label">
					<?php echo $element->getAttributeLabel('glucose_level')?>:
				</div>
			</div>
			<div class="large-9 column end">
				<div class="data-value">
					<?php echo $element->glucose_level_na ? 'N/A' : $element->glucose_level?>
				</div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<div class="data-label">
					<?php echo $element->getAttributeLabel('nausea_vomiting')?>:
				</div>
			</div>
			<div class="large-9 column end">
				<div class="data-value">
					<?php echo $element->nausea_vomiting?>
				</div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<div class="data-label">
					<?php echo $element->getAttributeLabel('blood_loss')?>:
				</div>
			</div>
			<div class="large-9 column end">
				<div class="data-value">
					<?php echo $element->blood_loss?>mL
				</div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<div class="data-label">
					<?php echo $element->getAttributeLabel('total_fluid_intake')?>:
				</div>
			</div>
			<div class="large-9 column end">
				<div class="data-value">
					<?php echo $element->total_fluid_intake?>mL
				</div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<div class="data-label">
					<?php echo $element->getAttributeLabel('total_fluid_outtake')?>:
				</div>
			</div>
			<div class="large-9 column end">
				<div class="data-value">
					<?php echo $element->total_fluid_outtake?>mL
				</div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<div class="data-label">
					<?php echo $element->getAttributeLabel('avpu_score_id')?>:
				</div>
			</div>
			<div class="large-9 column end">
				<div class="data-value">
					<?php echo $element->avpu_score->name?>
				</div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<div class="data-label">
					<?php echo $element->getAttributeLabel('mews_score')?>:
				</div>
			</div>
			<div class="large-9 column end">
				<div class="data-value">
					<?php echo $element->mews_score?>
				</div>
			</div>
		</div>
	</div>
