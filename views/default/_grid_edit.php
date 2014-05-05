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
<table class="vitals-grid">
	<tr class="times">
		<?php foreach ($element->getTimeIntervals() as $i => $time) {?>
			<td align="right">
				<span<?php if ($i==0) {?> style="margin-right: -122px"<?php }?>><?php echo $time?></span>
			</td>
		<?php }?>
	</tr>
	<?php foreach (OphNuPostoperative_Vitals_Gas::model()->findAll(array('order'=>'display_order')) as $gas) {?>
		<tr>
			<th data-attr-min="<?php echo $gas->min?>" data-attr-max="<?php echo $gas->max?>"><?php echo $gas->name?><?php if ($gas->unit) {?> (<?php echo $gas->unit?>)<?php }?></th>
			<?php for ($i=0;$i<$element->intervals;$i++) {?>
				<td>
					<?php echo CHtml::textField('gas_level_'.$gas->id.'_'.$i,$element->gas_items[$gas->id][$i],array('size'=>6,'class'=>'gas_level'))?>
				</td>
			<?php }?>
		</tr>
	<?php }?>
	<?php foreach (OphNuPostoperative_Vitals_Drug::model()->findAll(array('order'=>'display_order')) as $drug) {?>
		<tr>
			<th><?php echo $drug->name?><?php if ($drug->unit) {?> (<?php echo $drug->unit?>)<?php }?></th>
			<?php for ($i=0;$i<$element->intervals;$i++) {?>
				<td>
					<?php echo CHtml::textField('drug_'.$drug->id.'_'.$i,$element->drug_items[$drug->id][$i],array('size'=>6))?>
				</td>
			<?php }?>
		</tr>
	<?php }?>
	<?php foreach (OphNuPostoperative_Vital_Type::model()->findAll(array('order'=>'display_order')) as $reading_type) {?>
		<tr>
			<th><?php echo $reading_type->name?><?php if ($reading_type->unit) {?> (<?php echo $reading_type->unit?>)<?php }?></th>
			<?php for ($i=0;$i<$element->intervals;$i++) {?>
				<td>
					<?php if ($reading_type->fieldType && $reading_type->fieldType->name == 'Select') {?>
						<?php echo CHtml::dropDownList("reading_".$reading_type->id.'_'.$i,$element->reading_items[$reading_type->id][$i],CHtml::listData(OphNuPostoperative_Vital_Type_Field_Type_Option::model()->findAll(array('order'=>'display_order','condition'=>'vital_type_id=:vital_type_id','params'=>array(':vital_type_id'=>$reading_type->id))),'name','name'),array('empty'=>''))?>
					<?php }else{?>
						<?php echo CHtml::textField('reading_'.$reading_type->id.'_'.$i,$element->reading_items[$reading_type->id][$i],array('size'=>6))?>
					<?php }?>
				</td>
			<?php }?>
		</tr>
	<?php }?>
</table>
