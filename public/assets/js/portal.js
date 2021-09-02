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

    function initSelect2Inputs() {
        $('#url-attachment').select2({
            width: '100%',
            scrollAfterSelect: true,
            placeholder: "  URL Attachments (Optional)",
            tags: true,
            escapeMarkup: function(m) { 
                return m; 
            }
        });
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

		if (tabID == 'all') {
			$.each(recordTypes, function(index, rType) {
				elemIDs.push(`#${rType['elem_id']}-content`);
				urls.push(`records/show-record/${rType['id']}`);
			});
		} else {
			$.each(recordTypes, function(index, rType) {
				const _tabID = `tab-${rType['elem_id']}`;

				if (_tabID == tabID) {
					elemIDs.push(`#${rType['elem_id']}-content`);
					urls.push(`records/show-record/${rType['id']}`);
					return;
				}
			});
		}

		$.each(elemIDs, function(index, elemID) {
			runRefreshRecordDisplay(elemID, urls[index])
		});		
	}

	if (recordTypes.length > 0) {
		refreshRecordDisplay('tab-' + recordTypes[0]['elem_id']);
	}
	
	function refreshDefaults(type, otherParam = "") {
		if (type == 'all' || type == 'record') {
			//Records
			$('#inp-search-record').val('');
			$('#search-display').html('<div id="search-display" class="well">' +
	                                  '<p class="grey-text"> Please fill-up the search field.</p>' +
	                            	  '</div>');
			$('#sel-record-type').val(0).trigger('change');
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
			const storeURL = $('#form-action').val();
			const formValidator = $("#form-create-record").validate({
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
			   	const fileName = $(this).val().split('\\').pop(); 
			   	$(this).next('.custom-file-label')
			   		   .addClass("selected")
			   		   .html('<i class="fas fa-image"></i> ' + fileName); 
			   	//$('#btn-add-record').removeAttr('disabled');
			});

            initSelect2Inputs();

			if (recordType == 0) {
				$('#btn-add-edit-types').unbind('click').click(function() {
				});
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
		if (toggle == 'store') {
			$(form).submit();
		} else {
			$(form).submit();
		}
	}

	$.fn.showView = function(id, type, otherParam = "") {
		if (type == 'record') {
			$('#view-content').load('records/show-view/' + otherParam + '?id=' + id);
			$("#modal-view").modal().on('shown.bs.modal', function() {

			}).on('hidden.bs.modal', function() {
			    $('#view-content').html(modalLoadingContent);
			});
		} else if (type == 'record-type') {
            $('#view-content').load(`record-types/show-view/${id}`);
            $("#modal-view").modal().on('shown.bs.modal', function() {

			}).on('hidden.bs.modal', function() {
			    $('#view-content').html(modalLoadingContent);
			});
        }
	}

	$.fn.showCreate = function() {
		$("#modal-create").modal().on('shown.bs.modal', function() {
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

	$.fn.store = function(_form = '', _formAction = '') { 
		var form = _form ? _form : "#form-create";
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
			var storeURL = _formAction ? $(_formAction).val() : $('#form-action').val();
			storeProcess(form, storeURL, 'store');
		}
	}

	$.fn.showEdit = function(id, type, otherParam = "") {
		$("#modal-edit").modal().on('shown.bs.modal', function() {
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
			$('#edit-content').load('records/show-edit/' + otherParam + '?id=' + id, function() {
                initSelect2Inputs();
            });
		} else if (type == 'record-type') {
            $("#modal-view").modal('hide');
            $('#edit-content').load('record-types/show-edit/' + id);
        }
	}

	$.fn.update = function() {
		const form = "#form-edit";
		const formValidator = $(form).validate({
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
		const isValid = formValidator.form();
		
		if (isValid) {
			const editURL = $('#form-action').val();
			storeProcess(form, editURL, 'update');
		}
	}

    $.fn.updateRecordTypeOrder = function() {
        const form = "#form-update-record-type-order";
        const editURL = $('#form-update-record-type-order').val();
		
        storeProcess(form, editURL, 'update');
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
		$('#form-delete').submit();
	}

	$.fn.searchRecord = function() {
		var search = $('#inp-search-record').val();
		_search = $.trim(search).length;
		search = encodeURIComponent(search);

		$('#search-display').html('<div id="search-display" class="well">' +
                                  '<p class="grey-text">' +
                                  '<i class="fas fa-spinner fa-spin"></i> Searching...' +
                            	  '</p></div>');
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

    $('#tab-add-edit-types').parent('li').click(function() {
        $('#record-type-title').focus();
    }).hover(function() {
        $('#record-type-title').focus();
    });

    $('#sel-record-type').select2({
        width: '100%'
    });

    $('#sel-record-type').on('change.select2', function() {
        const recordType = $(this).val();
		createRecordForm(recordType);
    });

    $('#btn-add-edit-record-types').click(function() {

    });

	$('.tab-text').unbind('click').click(function() {
		var tabID = $(this).attr('id');
		refreshRecordDisplay(tabID);
		refreshDefaults('record');
	});

    $( ".sortable" ).sortable();
});