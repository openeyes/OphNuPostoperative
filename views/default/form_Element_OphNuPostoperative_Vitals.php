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

<section class="element <?php echo $element->elementType->class_name?>"
				 data-element-type-id="<?php echo $element->elementType->id?>"
				 data-element-type-class="<?php echo $element->elementType->class_name?>"
				 data-element-type-name="<?php echo $element->elementType->name?>"
				 data-element-display-order="<?php echo $element->elementType->display_order?>">
	<header class="element-header">
		<h3 class="element-title"><?php echo $element->elementType->name; ?></h3>
	</header>

	<div class="element-fields">

		<?php


		$vitals = array ('Heart Rate','Blood Pressure','RR','Sa02','o2 l/min','Glucose Level','Temp (C)','Pain Score','Nausea/Vomiting','Blood Loss','AVPU','MEWS Score');

		$time = new DateTime();

		$num_intervals = 15;
		$times = array();
		for ($i = 1; $i <= $num_intervals; $i++) {
			$time = $time->add(new DateInterval('PT15M'));
			$times[] = $time->format('H:i').'<BR>';
		}

		$data = array($times);

		foreach($vitals as $vital){
			$data_row= array_fill(0,$num_intervals+1,'');
			$data_row[0]=$vital;
			$data[]=$data_row;
		}

		?>
		<div id="vitalswidget" style="cursor: pointer;">
			<?php
			$this->widget('application.widgets.Grid', array(
					'id'=>'vitals',
					'Options' => array('data'=>$data, 'vertical-headers'=>true, 'horizontal-headers'=>true)
			));
			array_unshift($vitals,'Time');
			?>
		</div>
		<div class="addVitalsFields" style="display: none">
			<input type="hidden" id="vitals-count" value="<?php echo sizeOf($vitals)?>">
			<?php

			foreach($vitals as $key => $vital)
			{?>
				<div class="row field-row">
					<div class="large-2 column"><label><?php echo $vital?></label></div>
					<div class="large-2 column end">
						<?php
						$htmlOptions = $vital=='Time' ?  array('readOnly'=>true) : array();
						echo CHtml::textField($key+1,'',$htmlOptions);?>
					</div>
				</div>
			<?php }
			?>
			<div class="row field-row">
				<div class="large-2 column"><label></label></div>
				<div class="large-4 column end">
					<button id="edit-vital" class="secondary small" value="">Add</button>
					<button class="cancel-vital warning small">Cancel</button>
				</div>
			</div>
		</div>
		<div class="row field-row vitalsErrors" style="display: none">
			<div class="large-3 column"><label></label></div>
			<div class="large-5 column end">
				<div class="alert-box alert with-icon">
					<p>Please fix the following input errors:</p>
					<ul class="vitalsErrorList">
					</ul>
				</div>
			</div>
		</div>


		<?php echo $form->textField($element, 'total_fluid_intake', array('size' => '10'))?>
		<?php echo $form->textField($element, 'total_fluid_output', array('size' => '10'))?>
	</div>

</section>
