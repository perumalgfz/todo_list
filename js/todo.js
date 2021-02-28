jQuery(document).ready(function () {
	console.log('Inside JQuery');
	var todoListItem = jQuery('.todo-list');
	var todoListInput = jQuery('.todo-list-input');

	// create functionality
	jQuery('.todo-list-add-btn').on("click", function (event) {
		event.preventDefault();
		var action = 'create';
		var title = jQuery('.todo-list-title').val();
		var item = jQuery('.todo-list-input').val();
		
		if (title.length < 1 || item.length < 1) {
			console.log('Input Empty fields');
			jQuery('.err-cls').css("display", "block")
			jQuery('.err-cls').html('Please fill all value');
			return;
		}
		// console.log('title:'+ title);
		$("#task-modal").modal('hide');

		var bindHTML = '';
		jQuery.ajax({
			type: 'POST',
			url: 'action.php',
			data: { action: action, title: title, item: item },
			dataType: 'json',
			success: function (json) {
				if (item) {
					bindHTML += '<li>';
					bindHTML += '<div class="form-check">';
					bindHTML += '<label class="form-check-label">' + title +'</label>';
					bindHTML += '<label class="form-check-label">';
					bindHTML += '<span class="txt-decoration" data-utaskid="' + json.task_id + '" >' + item;
					bindHTML += '<i class="input-helper"></i> </span>';
					bindHTML += '</label>';
					bindHTML += '</div>';
					bindHTML += '<div class="actions">';
					bindHTML += '<i data-etaskid="' + json.task_id + '" class="edit fa fa-pen"  data-toggle="modal" data-target="#task-modal-edit"></i>';
					bindHTML += '<i data-dtaskid="' + json.task_id + '" class="remove fa fa-trash"></i>';
					bindHTML += '</div>';
					bindHTML += '</li>';
					todoListItem.append(bindHTML);
					todoListInput.val("");
					location.reload();
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});

	// get one record by "Id" functionality
	jQuery('.edit').on("click", function (event) {
		var action = 'edit';
		var task_id = jQuery(this).data('etaskid');
		
		jQuery.ajax({
			type: 'POST',
			url: 'action.php',
			data: { action: action, task_id: task_id },
			dataType: 'json',
			success: function (json) {
				$('#task_id').val(json.msg['0']['id']);
				$('#title').val(json.msg['0']['title']);
				$('#task').val(json.msg['0']['task']);
				return true;
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});

	// update functionality
	jQuery('.todo-list-update-btn').on("click", function (event) {

		var action = 'update';
		var task_id = jQuery('#task_id').val();
		var title = jQuery('#title').val();
		var item = jQuery('#task').val();

		if (title.length < 1 || item.length < 1) {
			event.preventDefault();
			jQuery('.err-cls').css("display", "block")
			jQuery('.err-cls').html('Please fill all value');
			return;
		}

		jQuery.ajax({
			type: 'POST',
			url: 'action.php',
			data: { action: action, task_id: task_id, title: title, task: item },
			dataType: 'json',
			success: function (json) {
				$("#task-modal-edit").modal('hide');
				return true;
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
		jQuery(this).closest("li").toggleClass('completed');
	});

	jQuery('.txt-decoration').on("click", function (event) {
		
		var action = 'updateTaskStatus';
		var task_id = jQuery(this).data('utaskid');
		if (jQuery(this).attr('checked')) {
			jQuery(this).removeAttr('checked');
			var status = 0;
		} else {
			jQuery(this).attr('checked', 'checked');
			var status = 1;
		}

		jQuery.ajax({
			type: 'POST',
			url: 'action.php',
			data: { action: action, task_id: task_id, status: status },
			dataType: 'json',
			success: function (json) {
				return true;
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
		jQuery(this).closest("li").toggleClass('completed');
	});

	// delete functionality
	todoListItem.on('click', '.remove', function () {
		var action = 'delete';
		var task_id = jQuery(this).data('dtaskid');
		jQuery.ajax({
			type: 'POST',
			url: 'action.php',
			data: { action: action, task_id: task_id },
			dataType: 'json',
			success: function (json) {
				location.reload();
				return true;
			},
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
		jQuery(this).parent().remove();
	});
});		