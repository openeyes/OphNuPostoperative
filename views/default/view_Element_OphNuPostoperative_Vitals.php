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

<section class="element">
	<header class="element-header">
		<h3 class="element-title"><?php echo $element->elementType->name?></h3>
	</header>

	<div class="element-data">
		<div class="row field-row">
			<div class="large-12 column end">
				<?php echo $this->renderPartial('_grid_view',array('element'=>$element,'mode'=>'view'))?>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<div class="data-label">
					<?php echo CHtml::encode($element->getAttributeLabel('anaesthesia_start_time'))?>
				</div>
			</div>
			<div class="large-9 column end">
				<div class="data-value">
					<?php echo $element->anaesthesia_start_time ? $element->anaesthesia_start_time : 'Not recorded'?>
				</div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<div class="data-label">
					<?php echo CHtml::encode($element->getAttributeLabel('anaesthesia_end_time'))?>
				</div>
			</div>
			<div class="large-9 column end">
				<div class="data-value">
					<?php echo $element->anaesthesia_end_time ? $element->anaesthesia_end_time : 'Not recorded'?>
				</div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<div class="data-label">
					<?php echo CHtml::encode($element->getAttributeLabel('surgery_start_time'))?>
				</div>
			</div>
			<div class="large-9 column end">
				<div class="data-value">
					<?php echo $element->surgery_start_time ? $element->surgery_start_time : 'Not recorded'?>
				</div>
			</div>
		</div>
		<div class="row field-row">
			<div class="large-3 column">
				<div class="data-label">
					<?php echo CHtml::encode($element->getAttributeLabel('surgery_end_time'))?>
				</div>
			</div>
			<div class="large-9 column end">
				<div class="data-value">
					<?php echo $element->surgery_end_time ? $element->surgery_end_time : 'Not recorded'?>
				</div>
			</div>
		</div>
	</div>
</section>
