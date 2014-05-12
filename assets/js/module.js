
/* Module-specific javascript can be placed here */

$(document).ready(function() {
	handleButton($('#et_save'),function() {
	});
	
	handleButton($('#et_cancel'),function(e) {
		if (m = window.location.href.match(/\/update\/[0-9]+/)) {
			window.location.href = window.location.href.replace('/update/','/view/');
		} else {
			window.location.href = baseUrl+'/patient/episodes/'+OE_patient_id;
		}
		e.preventDefault();
	});

	handleButton($('#et_deleteevent'));

	handleButton($('#et_canceldelete'));

	handleButton($('#et_print'),function(e) {
		printIFrameUrl(OE_print_url, null);
		enableButtons();
		e.preventDefault();
	});

	$('select.populate_textarea').unbind('change').change(function() {
		if ($(this).val() != '') {
			var cLass = $(this).parent().parent().parent().attr('class').match(/Element.*/);
			var el = $('#'+cLass+'_'+$(this).attr('id'));
			var currentText = el.text();
			var newText = $(this).children('option:selected').text();

			if (currentText.length == 0) {
				el.text(ucfirst(newText));
			} else {
				el.text(currentText+', '+newText);
			}
		}
	});

	$(".collapse").hide();

	$("input:radio").each(function(){
		if($(this).is(':checked') && $(this).val()==1){
			$(this).closest("fieldset").next(".collapse").show();
		}
	});

	$(document.body).on('click', '[type="radio"]', function(e) {
		var button = $(e.currentTarget);
		var div = button.closest("fieldset").next(".collapse");
		if(div)	{
			button.val()==1 ? div.show() :	hideAndBlank(div);
		}
	});

	function hideAndBlank(div) {
		div.hide();
		div.find('input').removeAttr('checked');
		div.find('[type=text]').val('');
		div.find('a.MultiSelectRemove').map(function() {
			$(this).click();
		});
	};

	$('.addnote').click(function() {
		event.preventDefault();
		$('.no_notes').hide();

		$.ajax({
			'type': 'POST',
			'url': baseUrl+'/OphNuPostoperative/default/validateNote/',
			'data': 'YII_CSRF_TOKEN='+YII_CSRF_TOKEN+'&note=yehaww',
			'dataType': 'json',
			'success': function(resp) {
				$('.medicationErrorList').html('');

				if (resp['status'] == 'error') {
					for (var i in resp['errors']) {
						$('.medicationErrorList').append('<li>'+resp['errors'][i]);
					}

					$('.medicationErrors').show();
				} else {
					$('.medicationErrors').hide();

					if ($('#_edit_row_id').val() != '' || !medication_in_list($('#_medication_id').val(),$('#start_date').val())) {
						$('.medications tr.no_medications').hide();

						if ($('#_edit_row_id').val() == '') {
							$('.medications tbody').append(resp['row']);
						} else {
							$('#'+$('#_edit_row_id').val()).replaceWith(resp['row']);
						}
						var i = 0;
						$('.medications tbody tr').map(function() {
							$(this).attr('id','t'+i);
							i += 1;
						});
						$('.cancelMedication').click();
					} else {
						$('.medicationErrorList').append('Medication is already in the list for the given date');
						$('.medicationErrors').show();
					}
				}
			}
		});

		$('.notes').append('<tr><td>13:37</td><td>Note</td></tr>');
	});

	$('.timeNow').click(function(e) {
		e.preventDefault();

		var d = new Date;

		var h = d.getHours().toString();
		var m = d.getMinutes().toString();

		if (h.length <2) {
			h = '0' + h;
		}

		if (m.length <2) {
			m = '0' + m;
		}

		$(this).prev('input').val(h+':'+m);
	});

	$('.vitals-grid input').die('keypress').live('keypress',function(e) {
		if (e.keyCode == 13) {
			var n = parseInt($(this).attr('name').match(/[0-9]+$/));
			var tr = $(this).parent().parent().next('tr');
			var input = tr.children('td:first').children('input');
			if (input.length >0) {
				var name = input.attr('name').replace(/[0-9]+$/,'');
				$('#'+name+n).select().focus();
			}
			return false;
		}

		return true;
	});

	$('.vitals-grid input').die('keydown').live('keydown',function(e) {
		switch (e.keyCode) {
			case 37:
				var n = parseInt($(this).attr('name').match(/[0-9]+$/));
				if (n >0) {
					$('#'+$(this).attr('name').replace(/[0-9]+$/,'')+(n-1)).select().focus();
				}
				break;
			case 38:
				var n = parseInt($(this).attr('name').match(/[0-9]+$/));
				var tr = $(this).parent().parent().prev('tr');
				var input = tr.children('td:first').children('input');
				if (input.length >0) {
					var name = input.attr('name').replace(/[0-9]+$/,'');
					$('#'+name+n).select().focus();
				}
				break;
			case 39:
				var n = parseInt($(this).attr('name').match(/[0-9]+$/));
				var next = $(this).attr('name').replace(/[0-9]+$/,'')+(n+1);
				if ($('#'+next).length >0) {
					$('#'+next).select().focus();
				}
				break;
			case 40:
				var n = parseInt($(this).attr('name').match(/[0-9]+$/));
				var tr = $(this).parent().parent().next('tr');
				var input = tr.children('td:first').children('input');
				if (input.length >0) {
					var name = input.attr('name').replace(/[0-9]+$/,'');
					$('#'+name+n).select().focus();
				}
				break;
		}
	});

	$('.time-now').click(function(e) {
		e.preventDefault();

		var d = new Date;

		var h = d.getHours();
		var m = d.getMinutes();

		if (h <10) {
			h = '0'+h;
		}
		if (m <10) {
			m = '0'+m;
		}

		var element = $(this).closest('section').data('element-type-class');

		$('#'+element+'_'+$(this).data('target')).val(h+':'+m);
		$('#'+element+'_'+$(this).data('target')).change();
	});

	$('#Element_OphNuPostoperative_Patient_patient_enters_recovery_room').change(function() {
		var val = $(this).val();

		if (val != '') {
			OphNuPostoperative_update_times(val);
		}
	});
});

function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}

function OphNuPostoperative_update_times(start_time)
{
	$.ajax({
		'type': 'POST',
		'dataType': 'json',
		'url': baseUrl+'/OphNuPostoperative/default/dataTimes',
		'data': 'start_time='+start_time+'&YII_CSRF_TOKEN='+YII_CSRF_TOKEN,
		'success': function(resp) {
			if (resp['status'] == 'error') {
				alert(resp['message']);
			} else {
				$('table.vitals-grid .times').html(resp['html']);
				$('#Element_OphNuPostoperative_Vitals_anaesthesia_start_time').val(resp['start_time']);
			}
		}
	});
}
