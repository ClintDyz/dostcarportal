$(function() {
	var modalLoadingContent = '<div class="text-center grey-text m-5 p-5">' +
                    		  '<i class="fas fa-cog fa-spin fa-5x"></i>' +
                			  '</div>';
    var deleteURL = "", deleteForm;

    //$('#login-token').val($('meta[name=csrf-token]').attr('content'));

	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	  	if (!$(this).next().hasClass('show')) {
	  	  	$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	  	}

	  	var $subMenu = $(this).next(".dropdown-menu");
	  	$subMenu.toggleClass('show');
	
	  	$(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
	  	  	$('.dropdown-submenu .show').removeClass("show");
	  	});
	
	  	return false;
	});

	function displayError(msg) {
		$('#danger-text').text(msg);
		$("#modal-danger").modal();
		$("#modal-create").modal('hide');
		$("#modal-edit").modal('hide');
		$("#modal-delete").modal('hide');
	}

	function runRefreshRecordDisplay(elemID, url) {
		$(elemID).html(modalLoadingContent)
				 .load(url, function(response, status, xhr) {
			if (status == "error") {
				runRefreshRecordDisplay(elemID, url);
			}
		});
	}

	function refreshRecordDisplay(tabID) {
		var elemIDs = [], urls = [];

		switch (tabID) {
			case 'tab-announcement':
				elemIDs.push('#announcement-content');
				urls.push('records/show-record/1');
				break;
			case 'tab-memo':
				elemIDs.push('#memo-content');
				urls.push('records/show-record/2');
				break;
			case 'tab-so':
				elemIDs.push('#so-content');
				urls.push('records/show-record/3');
				break;
			case 'tab-to':
				elemIDs.push('#to-content');
				urls.push('records/show-record/4');
				break;
			case 'tab-guidelines':
				elemIDs.push('#guidelines-content');
				urls.push('records/show-record/5');
				break;
			case 'tab-policies':
				elemIDs.push('#policies-content');
				urls.push('records/show-record/6');
				break;
			case 'tab-reports':
				elemIDs.push('#reports-content');
				urls.push('records/show-record/7');
				break;
			case 'tab-forms':
				elemIDs.push('#forms-content');
				urls.push('records/show-record/8');
				break;
			case 'tab-mancomrecords':
				elemIDs.push('#mancomrecords-content');
				urls.push('records/show-record/9');
				break;
			case 'tab-infomaterials':
				elemIDs.push('#infomaterials-content');
				urls.push('records/show-record/10');
				break;
			case 'tab-otherrecords':
				elemIDs.push('#otherrecords-content');
				urls.push('records/show-record/11');
				break;
			case 'all':
				elemIDs.push('#announcement-content');
				urls.push('records/show-record/1');
				
				elemIDs.push('#memo-content');
				urls.push('records/show-record/2');

				elemIDs.push('#so-content');
				urls.push('records/show-record/3');

				elemIDs.push('#to-content');
				urls.push('records/show-record/4');

				elemIDs.push('#guidelines-content');
				urls.push('records/show-record/5');

				elemIDs.push('#policies-content');
				urls.push('records/show-record/6');

				elemIDs.push('#reports-content');
				urls.push('records/show-record/7');

				elemIDs.push('#forms-content');
				urls.push('records/show-record/8');

				elemIDs.push('#mancomrecords-content');
				urls.push('records/show-record/9');

				elemIDs.push('#infomaterials-content');
				urls.push('records/show-record/10');

				elemIDs.push('#otherrecords-content');
				urls.push('records/show-record/11');
				break;
		}

		$.each(elemIDs, function(index, elemID) {
			runRefreshRecordDisplay(elemID, urls[index])
		});		
	}

	refreshRecordDisplay('tab-announcement');

	function refreshDefaults(type, otherParam = "") {
		if (type == 'all' || type == 'record') {
			//Records
			$('#inp-search-record').val('');
			$('#search-display').html('<div id="search-display" class="well">' +
	                                  '<p class="grey-text"> Please fill-up the search field.</p>' +
	                            	  '</div>');
			$('#sel-record-type').val(0);
			createRecordForm(0);
		}
			
		if (type == 'all' || type == 'infosys') {
			//InfoSys
			$('#infosys-display').html(modalLoadingContent)
								 .load('infosys/show-infosys');
		}
	}

	function createRecordForm(recordType) {
		$('#add-record-display').load('records/show-create/' + recordType, function() {
			var storeURL = $('#form-action').val();
			var formValidator = $("#form-create-record").validate({
									errorElement : 'div',
									errorLabelContainer: '.error-msg',
									rules: {
								        record_title: {
								            required: true
								        },
								        record_subject: {
								            required: true
								        }
								    }
								});

			$('.custom-file-input').on('change', function() { 
			   	var fileName = $(this).val().split('\\').pop(); 
			   	$(this).next('.custom-file-label')
			   		   .addClass("selected")
			   		   .html('<i class="fas fa-image"></i> ' + fileName); 
			   	//$('#btn-add-record').removeAttr('disabled');
			});

			if (recordType == 0) {
				$('#btn-add-record').unbind('click').click(function() {
				});
			} else {
				$('#btn-add-record').unbind('click').click(function() {
					var isValid = formValidator.form();
					var form = "#form-create-record";

					if (isValid) {
						storeProcess(form, storeURL, 'store', 'record');
					}
				});
			}	
		});
	}

	function storeProcess(form, url, toggle) {
		/* // For AJAX Approach
		var dataForm = new FormData($(form)[0]);
		dataForm.append('_token', $('meta[name=csrf-token]').attr('content'));

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
		$.ajax({
		    url: url,
		    type: 'post',
		    data: dataForm ? dataForm : dataForm.serialize(),
		    contentType: false,
    		processData: false,
		    success: function(response) {
		        $('#success-text').text(response);
		    	$("#modal-success").modal();

		        if (toggle == 'store') {
					$("#modal-create").modal('hide');
				} else {
					$("#modal-edit").modal('hide');
				}

				refreshRecordDisplay('all');
				refreshDefaults('all');
		    },
		    fail: function(xhr, textStatus, errorThrown){
		       	displayError('Try again.');
		    },
		    error: function(data) {
		    	displayError('There is an error occurred.');
		    }     
		});*/


		if (toggle == 'store') {
			$(form).submit();
		} else {
			$(form).submit();
		}
	}

	$.fn.showView = function(id, type, otherParam = "") {
		if (type == 'record') {
			$('#view-content').load('records/show-view/' + otherParam + '?id=' + id);
			$("#modal-view").modal()
							.on('shown.bs.modal', function() {

							}).on('hidden.bs.modal', function() {
							    $('#view-content').html(modalLoadingContent);
							});
		}
	}

	$.fn.showCreate = function() {
		$("#modal-create").modal()
						  .on('shown.bs.modal', function() {
						  		$('.custom-file-input').on('change', function() { 
								   	var fileName = $(this).val().split('\\').pop(); 
								   	$(this).next('.custom-file-label')
								   		   .addClass("selected")
								   		   .html('<i class="fas fa-image"></i> ' + fileName); 
								});
						  }).on('hidden.bs.modal', function() {
						      $('#create-content').html(modalLoadingContent);
						  });
		$('#create-content').load('infosys/show-create');
	}

	$.fn.store = function() { 
		var form = "#form-create";
		var formValidator = $(form).validate({
								errorElement : 'div',
    							errorLabelContainer: '.error-msg',
								rules: {
							        infosys_name: {
							            required: true
							        },
							        infosys_type: {
							            required: true
							        }
							    }
							});
		var isValid = formValidator.form();

		if (isValid) {
			var storeURL = $('#form-action').val();
			storeProcess(form, storeURL, 'store');
		}
	}

	$.fn.showEdit = function(id, type, otherParam = "") {
		$("#modal-edit").modal()
						.on('shown.bs.modal', function() {
							deleteURL = $('#delete-url').val();
							deleteForm = $('#form-delete').serialize();
							$('.custom-file-input').on('change', function() { 
							   	var fileName = $(this).val().split('\\').pop(); 
							   	$(this).next('.custom-file-label')
							   		   .addClass("selected")
							   		   .html('<i class="fas fa-image"></i> ' + fileName); 
							});
						  }).on('hidden.bs.modal', function() {
						      $('#edit-content').html(modalLoadingContent);
						  }).css('overflow-y', 'auto');

		if (type == 'infosys') {
			$('#edit-content').load('infosys/show-edit/' + id);
		} else if (type == 'record') {
			$("#modal-view").modal('hide');
			$('#edit-content').load('records/show-edit/' + otherParam + '?id=' + id);
		}	
	}

	$.fn.update = function() {
		var form = "#form-edit";
		var formValidator = $(form).validate({
								errorElement : 'div',
	    						errorLabelContainer: '.error-msg',
								rules: {
							        infosys_name: {
							            required: true
							        },
							        infosys_type: {
							            required: true
							        }
							    }
							});
		var isValid = formValidator.form();
		
		if (isValid) {
			var editURL = $('#form-action').val();
			storeProcess(form, editURL, 'update');
		}
	}

	$.fn.showDelete = function() {
		$("#modal-edit").modal('hide');
		$("#modal-delete").modal()
						.on('shown.bs.modal', function() {
							$('#form-delete').attr('action', deleteURL);
						}).on('hidden.bs.modal', function() {
							$('#form-delete').attr('action', '');
						});
	}

	$.fn.delete = function() {
		/* // For AJAX Approach
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
		$.ajax({
		    url: deleteURL,
		    type: 'post',
		    data: {_token: $('meta[name=csrf-token]').attr('content')},
		    success: function(response) {
		    	$('#success-text').text(response);
		    	$("#modal-success").modal();
		        $("#modal-delete").modal('hide');
		        
		        refreshDefaults('all');
		    },
		    fail: function(xhr, textStatus, errorThrown){
		       	displayError('Try again.');
		    },
		    error: function(data) {
		    	displayError(data.responseText);
		    }
		});*/

		$('#form-delete').submit();
	}

	$.fn.searchRecord = function() {
		var search = $('#inp-search-record').val();
		_search = $.trim(search).length;
		search = encodeURIComponent(search);

		$('#search-display').html('<div id="search-display" class="well">' +
                                  '<p class="grey-text">' +
                                  '<i class="fas fa-spinner fa-spin"></i> Searching...' +
                            	  '</p></div>')

		if (_search > 0) {
			$('#search-display').load('records/show-search?search=' + search);
		} else {
			$('#search-display').html('<div id="search-display" class="well">' +
                                	  '<p class="grey-text"> Please fill-up the search field.</p>' +
                            		  '</div>');
		}
		
	}

	$.fn.deleteAttachment = function(id, filename, elementID) {
		var filePath = 'storage/record/' + id + '/' + filename;
		var deleteURL = 'records/delete-attachment/' + id;

		$('#' + elementID).html('<i class="fas fa-spinner fa-spin"></i> Deleting...')
						  .removeClass('red-text')
						  .addClass('grey-text');
		$.ajax({
		    url: deleteURL,
		    type: 'post',
		    data: {'_token': $('meta[name=csrf-token]').attr('content'),
				   'filepath': filePath},
		    success: function(response) {
		    	$('#' + elementID).html('<i class="fas fa-check"></i> ' + response)
						  				.fadeOut(1500);
		    },
		    fail: function(xhr, textStatus, errorThrown){
		       	$('#' + elementID).html('Click again to delete "' + filename + '"')
		       					  .removeClass('grey-text')
						  		  .addClass('red-text');
		    },
		    error: function(data) {
		    	$('#' + elementID).html('Click again to delete "' + filename + '"')
		       					  .removeClass('grey-text')
						  		  .addClass('red-text');
		    }
		});
	}

	$.fn.generateNextPrev = function(url, elementID) {
		$(elementID).html(modalLoadingContent)
					.load(url);
	}

	$('#sel-record-type').unbind('change').change(function() {
		var recordType = $(this).val();
		createRecordForm(recordType);	
	});

	$('.tab-text').unbind('click').click(function() {
		var tabID = $(this).attr('id');
		refreshRecordDisplay(tabID);
		refreshDefaults('record');
	});

});