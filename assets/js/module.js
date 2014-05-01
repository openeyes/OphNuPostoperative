
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


	$('#vitals td').click(function() {
		var col = $(this).data('column');
		$('.addVitalsFields').show();
		$('#edit-vital').val(col);
		var fields =$('#vitals-count').val();
		for (var row=1;row<=fields;row++){

			$('.addVitalsFields').find('#' + row).val($(".vitals-col-"+col+".vitals-row-"+row).text().trim());
		}
	});

	$('#edit-vital').click(function() {
		event.preventDefault();
		var fields =$('#vitals-count').val();

		var col = $('#edit-vital').val();
		for (var row=1;row<=fields;row++){
			$(".vitals-col-"+col+".vitals-row-"+row).html($('.addVitalsFields').find('#'+row).val());
		}
		$('.addVitalsFields').hide();
	});

	$('.cancel-vital').click(function() {
		event.preventDefault();
		$('.addVitalsFields').hide();
	});

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



});

function ucfirst(str) { str += ''; var f = str.charAt(0).toUpperCase(); return f + str.substr(1); }

function eDparameterListener(_drawing) {
	if (_drawing.selectedDoodle != null) {
		// handle event
	}
}
