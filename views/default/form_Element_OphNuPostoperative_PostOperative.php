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
			<?php echo $form->radioBoolean($element, 'fallsmobility')?>
	<?php echo $form->multiSelectList($element, 'MultiSelect_falls', 'fallss', 'ophnupostoperative_postoperative_falls_id', CHtml::listData(OphNuPostoperative_PostOperative_Falls::model()->findAll(array('order'=>'display_order asc')),'id','name'), $element->ophnupostoperative_postoperative_falls_defaults, array('empty' => '- Please select -', 'label' => 'Falls/mobility'))?>
	<?php echo $form->radioBoolean($element, 'removable_dental')?>
	<?php echo $form->checkBox($element, 'full_uppers')?>
	<?php echo $form->checkBox($element, 'full_lowers')?>
	<?php echo $form->checkBox($element, 'other')?>
	<?php echo $form->checkBox($element, 'full_uppers_returned')?>
	<?php echo $form->checkBox($element, 'ful_lowers_returned')?>
	<?php echo $form->checkBox($element, 'other_returned')?>
	<?php echo $form->textField($element, 'other_comments', array('size' => '10'))?>
	<?php echo $form->radioBoolean($element, 'hearing_aid_present')?>
	<?php echo $form->checkBox($element, 'h_right')?>
	<?php echo $form->checkBox($element, 'h_returned_right')?>
	<?php echo $form->checkBox($element, 'h_left')?>
	<?php echo $form->checkBox($element, 'h_returned_left')?>
	<?php echo $form->multiSelectList($element, 'MultiSelect_belongings', 'belongingss', 'ophnupostoperative_postoperative_belongings_id', CHtml::listData(OphNuPostoperative_PostOperative_Belongings::model()->findAll(array('order'=>'display_order asc')),'id','name'), $element->ophnupostoperative_postoperative_belongings_defaults, array('empty' => '- Please select -', 'label' => 'Patient Belongings'))?>
	<?php echo $form->textField($element, 'h_comments', array('size' => '10'))?>
	<?php echo $form->multiSelectList($element, 'MultiSelect_skin', 'skins', 'ophnupostoperative_postoperative_skin_id', CHtml::listData(OphNuPostoperative_PostOperative_Skin::model()->findAll(array('order'=>'display_order asc')),'id','name'), $element->ophnupostoperative_postoperative_skin_defaults, array('empty' => '- Please select -', 'label' => 'Skin Assessment'))?>
	<?php echo $form->textField($element, 's_comments', array('size' => '10'))?>
	<?php echo $form->multiSelectList($element, 'MultiSelect_obs', 'obss', 'ophnupostoperative_postoperative_obs_id', CHtml::listData(OphNuPostoperative_PostOperative_Obs::model()->findAll(array('order'=>'display_order asc')),'id','name'), $element->ophnupostoperative_postoperative_obs_defaults, array('empty' => '- Please select -', 'label' => 'Post-Op Observations'))?>
	<?php echo $form->radioBoolean($element, 'o_comments')?>
	<?php echo $form->radioBoolean($element, 'eye_dressing_in_place')?>
	<?php echo $form->radioBoolean($element, 'iv_removed')?>
	<?php echo $form->radioBoolean($element, 'ecg_dots_removed')?>
	<?php echo $form->radioBoolean($element, 'take_home_ophthalmic')?>
	<?php echo $form->radioBoolean($element, 'instructions_given')?>
	</div>
	
</section>
