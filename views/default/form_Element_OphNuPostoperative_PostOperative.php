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
		<?php echo $form->radioBoolean($element, 'fallsmobility', array('class'=>'linked-fields','data-linked-fields'=>'MultiSelect_falls','data-linked-values'=>'Yes'), array('label' => 3, 'field' => 4))?>
		<?php echo $form->multiSelectList($element, 'MultiSelect_falls', 'fallss', 'ophnupostoperative_postoperative_falls_id', CHtml::listData(OphNuPostoperative_PostOperative_Falls::model()->findAll(array('order'=>'display_order asc')),'id','name'), array(), array('empty' => '- Please select -', 'label' => 'Falls/mobility items'), !$element->fallsmobility || $element->fallsmobility->name != 'Yes', false, null, false, false, array('label' => 3, 'field' => 4))?>
		<?php echo $form->radioButtons($element, 'removable_dental_id', CHtml::listData(OphNuPostoperative_PostOperative_RemovableDental::model()->findAll(array('order' => 'display_order asc')),'id','name'), null, false, false, false, false, array('class' => 'linked-fields', 'data-linked-fields' => 'MultiSelect_dental', 'data-linked-values' => 'Yes'), array('label' => 3, 'field' => 4))?>
		<?php echo $form->multiSelectList($element, 'MultiSelect_dental', 'dentals', 'ophnupostoperative_postoperative_dental_id', CHtml::listData(OphNuPostoperative_PostOperative_Dental::model()->findAll(array('order'=>'display_order asc')),'id','name'), array(), array('empty' => '- Please select -', 'label' => 'Dental items returned', 'class' => 'linked-fields', 'data-linked-fields' => 'other_comments', 'data-linked-values' => 'Other (please specify)'), !$element->removable_dental || $element->removable_dental->name != 'Yes', false, null, false, false, array('label' => 3, 'field' => 4))?>
		<?php echo $form->textField($element, 'other_comments', array('hide' => !$element->hasMultiSelectValue('dentals','Other (please specify)')), array(), array('label' => 3, 'field' => 4))?>
		<?php echo $form->radioButtons($element, 'hearing_aid_returned_id', CHtml::listData(OphNuPostoperative_PostOperative_HearingAidReturned::model()->findAll(array('order'=>'display_order asc')),'id','name'), null, false, false, false, false, array('class' => 'linked-fields', 'data-linked-fields' => 'MultiSelect_hearing', 'data-linked-values' => 'Yes'), array('label' => 3, 'field' => 4))?>
		<?php echo $form->multiSelectList($element, 'MultiSelect_hearing', 'hearings', 'ophnupostoperative_postoperative_hearing_id', CHtml::listData(OphNuPostoperative_PostOperative_Hearing::model()->findAll(array('order'=>'display_order asc')),'id','name'), array(), array('empty' => '- Please select -', 'label' => 'Hearing items returned'), !$element->hearing_aid_returned || $element->hearing_aid_returned->name != 'Yes', false, null, false, false, array('label' => 3, 'field' => 4))?>
		<?php echo $form->radioBoolean($element, 'patent_belongings_returned', array('class' => 'linked-fields', 'data-linked-fields' => 'MultiSelect_belongings', 'data-linked-values' => 'Yes'), array('label' => 3, 'field' => 4))?>
		<?php echo $form->multiSelectList($element, 'MultiSelect_belongings', 'belongingss', 'ophnupostoperative_postoperative_belongings_id', CHtml::listData(OphNuPostoperative_PostOperative_Belongings::model()->findAll(array('order'=>'display_order asc')),'id','name'), array(), array('empty' => '- Please select -', 'label' => 'Belongings returned', 'class' => 'linked-fields', 'data-linked-fields' => 'h_comments', 'data-linked-values' => 'Other (please specify)'), !$element->patent_belongings_returned, false, null, false, false, array('label' => 3, 'field' => 4))?>
		<?php echo $form->textField($element, 'h_comments',array('hide' => !$element->hasMultiSelectValue('belongingss','Other (please specify)')), array(), array('label' => 3, 'field' => 4))?>
		<?php echo $form->multiSelectList($element, 'MultiSelect_skin', 'skins', 'ophnupostoperative_postoperative_skin_id', CHtml::listData(OphNuPostoperative_PostOperative_Skin::model()->findAll(array('order'=>'display_order asc')),'id','name'), array(), array('empty' => '- Please select -', 'label' => 'Skin assessment', 'class' => 'linked-fields', 'data-linked-fields' => 's_comments', 'data-linked-values' => 'Other (please specify)'), false, false, null, false, false, array('label' => 3, 'field' => 4))?>
		<?php echo $form->textField($element, 's_comments', array('hide' => !$element->hasMultiSelectValue('obss','Other (please specify)')), array(), array('label' => 3, 'field' => 4))?>
		<?php echo $form->multiSelectList($element, 'MultiSelect_obs', 'obss', 'ophnupostoperative_postoperative_obs_id', CHtml::listData(OphNuPostoperative_PostOperative_Obs::model()->findAll(array('order'=>'display_order asc')),'id','name'), array(), array('empty' => '- Please select -', 'label' => 'Post-op observations','class' => 'linked-fields', 'data-linked-fields' => 'o_comments', 'data-linked-values' => 'Other (please specify)'), false, false, null, false, false, array('label' => 3, 'field' => 4))?>
		<?php echo $form->textField($element, 'o_comments', array('hide' => !$element->hasMultiSelectValue('obss','Other (please specify)')), array(), array('label' => 3, 'field' => 4))?>
	</div>
</section>
