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
<tr class="progress-notes-row"<?php if ($edit) {?> data-i="<?php echo $i?>" data-date="<?php echo date('j M Y',strtotime($note->comment_date))?>" data-time="<?php echo date('H:i',strtotime($note->comment_date))?>" data-comment="<?php echo CHtml::encode($note->comment)?>"<?php }?>>
	<td>
		<?php echo date('j M Y H:i',strtotime($note->comment_date))?>
	</td>
	<td>
		<?php echo CHtml::encode($note->comment)?>
	</td>
	<?php if ($edit) {?>
		<td>
			<a href="#" class="editProgressNote">edit</a>
			&nbsp;&nbsp;
			<a href="#" class="removeProgressNote">remove</a>
			<input type="hidden" name="<?php echo CHtml::modelName($note)?>[comment_date][]" value="<?php echo $note->comment_date?>" />
			<input type="hidden" name="<?php echo CHtml::modelName($note)?>[comment][]" value="<?php echo CHtml::encode($note->comment)?>" />
		</td>
	<?php }?>
</tr>
