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
		<div class="row field-row">
			<div class="large-3 column"><label><?php echo $element->getAttributeLabel('progress_notes')?></label></div>
			<div class="large-9 column end">
				<table class="grid progress-notes">
					<thead>
						<tr>
							<th class="dateTime">Date/time</th>
							<th>Notes</th>
							<th class="actions">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr class="no-comments"<?php if (!empty($element->progressnotes)) {?> style="display: none"<?php }?>>
							<td class="no-notes" colspan="2">
								No notes have been entered
							</td>
						</tr>
						<?php if (!empty($element->progressnotes)) {?>
							<?php foreach ($element->progressnotes as $i => $note) {
								$this->renderPartial('_progress_notes_row',array('edit' => true, 'note' => $note, 'i' => $i))?>
							<?php }?>
						<?php }?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="addProgressNoteDiv" style="display: none">
			<input type="hidden" class="progressNoteEditItem" value="" />
			<div class="large-3 column">
				<label></label>
			</div>
			<div class="large-9 column end">
				<div class="row field-row">
					<div class="large-2 column progressNoteLabel">
						<label>Date/time:</label>
					</div>
					<div class="large-5 column end">
						<?php
						$this->widget('zii.widgets.jui.CJuiDatePicker',array(
							'name' => 'comment_date',
							'options' => array(
								'showAnim' => 'fold',
								'dateFormat' => Helper::NHS_DATE_FORMAT_JS,
							),
							'htmlOptions' => array(
								'class' => 'progressNoteTimestamp',
							),
						))?>
						<?php
						$this->widget('application.widgets.TimePicker', array(
							'name' => 'time',
							'htmlOptions' => array('nowrapper' => true, 'class' => 'progressNoteTime'),
						))?>
						<?php echo EventAction::button('Now', 'now', array('level' => 'save'),array('class' => 'progressNoteTimeNow'))->toHtml()?>
					</div>
				</div>
				<div class="row field-row">
					<div class="large-2 column progressNoteLabel">
						<label>Note:</label>
					</div>
					<div class="large-5 column end">
						<?php echo CHtml::textArea('progress_note','')?>
					</div>
				</div>
				<div class="row field-row progressNoteErrorsDiv" style="display: none">
					<div class="large-2 column">
						<label></label>
					</div>
					<div class="large-9 column end">
						<div class="alert-box alert with-icon">
							<p>Please fix the following input errors:</p>
							<ul class="progressNoteErrors">
							</ul>
						</div>
					</div>
				</div>
				<div class="row field-row">
					<div class="large-9 column end">
						<?php echo EventAction::button('Save', 'save', array('level' => 'save'),array('class' => 'saveProgressNote'))->toHtml()?>
						<?php echo EventAction::button('Cancel', 'cancel', array(),array('class' => 'small warning primary cancelProgressNote'))->toHtml()?>
					</div>
				</div>
			</div>
		</div>
		<div class="row field-row addNoteButtonDiv">
			<div class="large-3 column"><label></label></div>
			<div class="large-9 column end">
				<button type="submit" class="secondary small add-note">Add Note</button>
			</div>
		</div>
		<?php echo $form->hiddenInput($element,'present',1)?>
	</div>
