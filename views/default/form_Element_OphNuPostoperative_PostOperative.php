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
		<?php echo $form->radioBoolean($element, 'fallsmobility', array('class'=> 'collapse'))?>
		<div class="collapse">
			<?php echo $form->multiSelectList($element, 'MultiSelect_falls', 'fallss', 'ophnupostoperative_postoperative_falls_id', CHtml::listData(OphNuPostoperative_PostOperative_Falls::model()->findAll(array('order'=>'display_order asc')),'id','name'), $element->ophnupostoperative_postoperative_falls_defaults, array('empty' => '- Please select -', 'label' => 'Falls/mobility'))?>
		</div>
		<?php echo $form->radioButtons($element, 'removable_dental_id', 'ophnupostoperative_postoperative_removable_dental')?>
		<div class="collapse">
			<?php echo $form->multiSelectList($element, 'MultiSelect_dental', 'dentals', 'ophnupostoperative_postoperative_dental_id', CHtml::listData(OphNuPostoperative_PostOperative_Dental::model()->findAll(array('order'=>'display_order asc')),'id','name'), $element->ophnupostoperative_postoperative_dental_defaults, array('empty' => '- Please select -', 'label' => 'Items returned'))?>
			<?php echo $form->textField($element, 'other_comments', array('size' => '10'))?>
		</div>
		<?php echo $form->radioButtons($element, 'hearing_aid_returned_id', 'ophnupostoperative_postoperative_hearing_aid_returned')?>
		<div class="collapse">
			<?php echo $form->multiSelectList($element, 'MultiSelect_hearing', 'hearings', 'ophnupostoperative_postoperative_hearing_id', CHtml::listData(OphNuPostoperative_PostOperative_Hearing::model()->findAll(array('order'=>'display_order asc')),'id','name'), $element->ophnupostoperative_postoperative_hearing_defaults, array('empty' => '- Please select -', 'label' => 'Items Returned'))?>
		</div>
		<?php echo $form->radioBoolean($element, 'patent_belongings_returned')?>
		<div class="collapse">
			<?php echo $form->multiSelectList($element, 'MultiSelect_belongings', 'belongingss', 'ophnupostoperative_postoperative_belongings_id', CHtml::listData(OphNuPostoperative_PostOperative_Belongings::model()->findAll(array('order'=>'display_order asc')),'id','name'), $element->ophnupostoperative_postoperative_belongings_defaults, array('empty' => '- Please select -', 'label' => 'Items Returned'))?>
			<?php echo $form->textField($element, 'h_comments', array('size' => '10'))?>
		</div>
		<div class="collapse">
			<?php echo $form->multiSelectList($element, 'MultiSelect_skin', 'skins', 'ophnupostoperative_postoperative_skin_id', CHtml::listData(OphNuPostoperative_PostOperative_Skin::model()->findAll(array('order'=>'display_order asc')),'id','name'), $element->ophnupostoperative_postoperative_skin_defaults, array('empty' => '- Please select -', 'label' => 'Skin Assessment'))?>
			<?php echo $form->textField($element, 's_comments', array('size' => '10'))?>
		</div>
		<div class="collapse">
			<?php echo $form->multiSelectList($element, 'MultiSelect_obs', 'obss', 'ophnupostoperative_postoperative_obs_id', CHtml::listData(OphNuPostoperative_PostOperative_Obs::model()->findAll(array('order'=>'display_order asc')),'id','name'), $element->ophnupostoperative_postoperative_obs_defaults, array('empty' => '- Please select -', 'label' => 'Post-Op Observations'))?>
			<?php echo $form->textField($element, 'o_comments', array('size' => '10'))?>
		</div>
	</div>
	
</section>
