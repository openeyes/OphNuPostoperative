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
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('fallsmobility'))?>:</div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->fallsmobility ? 'Yes' : 'No'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('falls'))?>:</div></div>
			<div class="large-9 column end"><div class="data-value"><?php if (!$element->fallss) {?>
							None
						<?php } else {?>
								<?php foreach ($element->fallss as $item) {
									echo $item->ophnupostoperative_postoperative_falls->name?><br/>
								<?php }?>
						<?php }?>
			</div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('removable_dental_id'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->removable_dental ? $element->removable_dental->name : 'None'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('dental'))?>:</div></div>
			<div class="large-9 column end"><div class="data-value"><?php if (!$element->dentals) {?>
							None
						<?php } else {?>
								<?php foreach ($element->dentals as $item) {
									echo $item->ophnupostoperative_postoperative_dental->name?><br/>
								<?php }?>
						<?php }?>
			</div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('other_comments'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo CHtml::encode($element->other_comments)?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('hearing_aid_returned_id'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->hearing_aid_returned ? $element->hearing_aid_returned->name : 'None'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('hearing'))?>:</div></div>
			<div class="large-9 column end"><div class="data-value"><?php if (!$element->hearings) {?>
							None
						<?php } else {?>
								<?php foreach ($element->hearings as $item) {
									echo $item->ophnupostoperative_postoperative_hearing->name?><br/>
								<?php }?>
						<?php }?>
			</div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('patent_belongings_returned'))?>:</div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo $element->patent_belongings_returned ? 'Yes' : 'No'?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('belongings'))?>:</div></div>
			<div class="large-9 column end"><div class="data-value"><?php if (!$element->belongingss) {?>
							None
						<?php } else {?>
								<?php foreach ($element->belongingss as $item) {
									echo $item->ophnupostoperative_postoperative_belongings->name?><br/>
								<?php }?>
						<?php }?>
			</div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('h_comments'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo CHtml::encode($element->h_comments)?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('skin'))?>:</div></div>
			<div class="large-9 column end"><div class="data-value"><?php if (!$element->skins) {?>
							None
						<?php } else {?>
								<?php foreach ($element->skins as $item) {
									echo $item->ophnupostoperative_postoperative_skin->name?><br/>
								<?php }?>
						<?php }?>
			</div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('s_comments'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo CHtml::encode($element->s_comments)?></div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('obs'))?>:</div></div>
			<div class="large-9 column end"><div class="data-value"><?php if (!$element->obss) {?>
							None
						<?php } else {?>
								<?php foreach ($element->obss as $item) {
									echo $item->ophnupostoperative_postoperative_obs->name?><br/>
								<?php }?>
						<?php }?>
			</div></div>
		</div>
		<div class="row data-row">
			<div class="large-3 column"><div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('o_comments'))?></div></div>
			<div class="large-9 column end"><div class="data-value"><?php echo CHtml::encode($element->o_comments)?></div></div>
		</div>
	</div>
</section>
