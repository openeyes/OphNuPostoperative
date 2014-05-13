<tr class="progress-notes-row">
	<td>
		<?php
		$date = strtotime($full_time);
		$time = date("H:i",$date);
		echo $time?>
		<?php echo CHtml::hiddenField('progress_notes_ids[]',$id)?>
		<?php echo CHtml::hiddenField('progress_notes_time[]',$full_time)?>
	</td>
	<td>
		<?php echo $note?>
		<?php echo CHtml::hiddenField('progress_notes_note[]',$note)?>
	</td>
	<?php if(isset($edit)){?>
	<td>
		<a href="#" class="remove-progress-notes-row">remove</a>
	</td>
	<?php }?>
</tr>