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

<h4 class="elementTypeName"><?php echo $element->elementType->name?></h4>
<table class="subtleWhite normalText">
	<tbody>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('fallsmobility'))?>:</td>
			<td><span class="big"><?php echo $element->fallsmobility ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="colThird">
					<b><?php echo CHtml::encode($element->getAttributeLabel('falls'))?>:</b>
					<div class="eventHighlight medium">
						<?php if (!$element->fallss) {?>
							<h4>None</h4>
						<?php } else {?>
							<h4>
								<?php foreach ($element->fallss as $item) {
									echo $item->ophnupostoperative_postoperative_falls->name?><br/>
								<?php }?>
							</h4>
						<?php }?>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('removable_dental'))?>:</td>
			<td><span class="big"><?php echo $element->removable_dental ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('full_uppers'))?></td>
			<td><span class="big"><?php echo $element->full_uppers ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('full_lowers'))?></td>
			<td><span class="big"><?php echo $element->full_lowers ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('other'))?></td>
			<td><span class="big"><?php echo $element->other ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('full_uppers_returned'))?></td>
			<td><span class="big"><?php echo $element->full_uppers_returned ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('ful_lowers_returned'))?></td>
			<td><span class="big"><?php echo $element->ful_lowers_returned ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('other_returned'))?></td>
			<td><span class="big"><?php echo $element->other_returned ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('other_comments'))?></td>
			<td><span class="big"><?php echo CHtml::encode($element->other_comments)?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('hearing_aid_present'))?>:</td>
			<td><span class="big"><?php echo $element->hearing_aid_present ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('h_right'))?></td>
			<td><span class="big"><?php echo $element->h_right ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('h_returned_right'))?></td>
			<td><span class="big"><?php echo $element->h_returned_right ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('h_left'))?></td>
			<td><span class="big"><?php echo $element->h_left ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('h_returned_left'))?></td>
			<td><span class="big"><?php echo $element->h_returned_left ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="colThird">
					<b><?php echo CHtml::encode($element->getAttributeLabel('belongings'))?>:</b>
					<div class="eventHighlight medium">
						<?php if (!$element->belongingss) {?>
							<h4>None</h4>
						<?php } else {?>
							<h4>
								<?php foreach ($element->belongingss as $item) {
									echo $item->ophnupostoperative_postoperative_belongings->name?><br/>
								<?php }?>
							</h4>
						<?php }?>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('h_comments'))?></td>
			<td><span class="big"><?php echo CHtml::encode($element->h_comments)?></span></td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="colThird">
					<b><?php echo CHtml::encode($element->getAttributeLabel('skin'))?>:</b>
					<div class="eventHighlight medium">
						<?php if (!$element->skins) {?>
							<h4>None</h4>
						<?php } else {?>
							<h4>
								<?php foreach ($element->skins as $item) {
									echo $item->ophnupostoperative_postoperative_skin->name?><br/>
								<?php }?>
							</h4>
						<?php }?>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('s_comments'))?></td>
			<td><span class="big"><?php echo CHtml::encode($element->s_comments)?></span></td>
		</tr>
		<tr>
			<td colspan="2">
				<div class="colThird">
					<b><?php echo CHtml::encode($element->getAttributeLabel('obs'))?>:</b>
					<div class="eventHighlight medium">
						<?php if (!$element->obss) {?>
							<h4>None</h4>
						<?php } else {?>
							<h4>
								<?php foreach ($element->obss as $item) {
									echo $item->ophnupostoperative_postoperative_obs->name?><br/>
								<?php }?>
							</h4>
						<?php }?>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('o_comments'))?>:</td>
			<td><span class="big"><?php echo $element->o_comments ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('eye_dressing_in_place'))?>:</td>
			<td><span class="big"><?php echo $element->eye_dressing_in_place ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('iv_removed'))?>:</td>
			<td><span class="big"><?php echo $element->iv_removed ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('ecg_dots_removed'))?>:</td>
			<td><span class="big"><?php echo $element->ecg_dots_removed ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('take_home_ophthalmic'))?>:</td>
			<td><span class="big"><?php echo $element->take_home_ophthalmic ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('instructions_given'))?>:</td>
			<td><span class="big"><?php echo $element->instructions_given ? 'Yes' : 'No'?></span></td>
		</tr>
	</tbody>
</table>

