var g_stbAnimationSpeed = 300;

var g_stbCloneDialog;
var g_stbAddContactFormBtnDialog;

var g_stbFixedColumnsWidth = [];
var g_stbColumnWidthDialog;

var g_stbMultipleColumnsSorting = [];
var g_stbDisableColumnsSorting = [];
var g_stbMultipleColumnsSortingDialog;

var g_stbTableLoaderIconDialog;

var g_stbTableLoaderBgColorTimeoutSet = false;
var g_stbTableLoaderBgColorLast = '';

var g_stbCopyPasteCellsMetaData = [];
var g_stbCopyPasteRowsCount = [];
var g_stbCopyPasteColsCount = [];
(function ($, app, undefined) {
	$(document).ready(function () {
		var tablesModel = app.Models.Tables,
			editor = app.Editor.Hot,
			cssEditor = tablesModel.getCssEditor();

		// Initialize Main Tabs
		var $mainTabsContent = $('.row-tab'),
			$mainTabs = $('.subsubsub.tabs-wrapper .button'),
			$currentTab = $mainTabs.filter('.current').attr('href');

		$mainTabsContent.filter($currentTab).addClass('active');
		$mainTabs.on('click', function (e) {
			e.preventDefault();

			var $this = $(this),
				$curTab = $this.attr('href');

			$mainTabsContent.removeClass('active');
			$mainTabs.filter('.current').removeClass('current');
			$this.addClass('current');
			$mainTabsContent.filter($curTab).addClass('active');

			switch($curTab) {
				case '#row-tab-editor':
					editor.render();
					break;
				case '#row-tab-preview':
					tablesModel.saveTable('#table-preview');
					break;
				default:
					break;
			}
		});

		// Initialize Sub Tabs
		var $settingsSubTabsContent = $('.row-settings-tab'),
			$settingsSubTabs = $('.subsubsub.tabs-settings-wrapper .button'),
			$settingsCurrentTab = $settingsSubTabs.filter('.current').attr('href');

		$settingsSubTabsContent.filter($settingsCurrentTab).addClass('active');

		$settingsSubTabs.on('click', function (e) {
			e.preventDefault();

			var $this = $(this),
				$curTab = $this.attr('href');

			$settingsSubTabsContent.removeClass('active');
			$settingsSubTabs.filter('.current').removeClass('current');
			$this.addClass('current');
			$settingsSubTabsContent.filter($curTab).addClass('active');
		});

		// Fix of conflict with handsontable library - it triggers error if user makes click on link without href attribute
		$('select[multiple="multiple"]').on('change', function() {
			$('.chosen-container-multi .search-choice-close').each(function() {
				$(this).attr('href', '#');
				$(this).attr('onclick', 'return false');
			});
		});

		// Configure CSS Editor
		cssEditor.setTheme("ace/theme/monokai");
		cssEditor.getSession().setMode("ace/mode/css");

		// Make editors responsive for window height
		$('#tableEditor, #css-editor').css({
			'max-height': g_stbWindowHeight,
			'min-height': g_stbWindowHeight,
			'height': g_stbWindowHeight
		});

		// If turn on chosen plugin for selects of all types - there is conflict with handsontable plugin happen
		$('#row-tab-settings select[multiple="multiple"]').chosen({width: '100%'});

		// Tooltips and Shortcode select
		$('[data-toggle="tooltip"]').tooltip();
		$('#stbCopyTextCodeExamples').change(function(){
			$('.stbCopyTextCodeShowBlock').hide().filter('[data-for="'+ jQuery(this).val()+ '"]').show();
		}).trigger('change');

		// Edit Table Title
		$('#stbTableTitleShell').click(function(){
			var isEdit = $(this).data('edit-on');
			if(!isEdit) {
				var $labelHtml = $('#stbTableTitleLabel'),
					$labelTxt = $('#stbTableTitleTxt');

				$labelTxt.val( $labelHtml.text() );
				$labelHtml.hide( g_stbAnimationSpeed );
				$labelTxt.show( g_stbAnimationSpeed, function(){
					$(this).data('ready', 1);
				});
				$(this).data('edit-on', 1);
			}
		});
		$('#stbTableTitleTxt').blur(function(){
			tablesModel.renameTable( $(this).val() );
		}).keydown(function(e){
			if(e.keyCode == 13) {	// Enter pressed
				tablesModel.renameTable( $(this).val() );
			}
		});

		// Dialog Windows
		g_stbColumnWidthDialog = $('#setColumnWidthDialog').dialog({
			autoOpen: false,
			width:    600,
			height:   'auto',
			modal:    true,
			open: function() {
				var $this = $(this),
					fixedColumnWidthData = '';

				for(var i = 0; i < g_stbFixedColumnsWidth.length; i++) {
					if(g_stbFixedColumnsWidth[i]) {
						fixedColumnWidthData += '<span>column ' + (i + 1) + ': ' + g_stbFixedColumnsWidth[i] + '</span></span><br />';
					}
				}
				if(!fixedColumnWidthData) {
					$this.find('.fixedColumnWidthDataLabel').hide();
				} else {
					$this.find('.fixedColumnWidthDataLabel').show();
				}
				$this.find('#fixedColumnWidthData').html(fixedColumnWidthData);
			},
			close: function() {
				var $this = $(this);
				$this.find('input[name="columnWidth"]').val('');
			},
			buttons:  {
				Apply: function () {
					var $this = $(this),
						editor = window.editor,
						selection = editor.getSelectedRange(),
						value = $this.find('input[name="columnWidth"]').val(),
						valueType = $this.find('input[name="columnWidthType"]:checked').val();
					if(value) {
						for(var i = selection.from.col; i <= selection.to.col; i++) {
							g_stbFixedColumnsWidth[i] = value + valueType;
						}
					}
					$(this).dialog('close');
				},
				'Clear Fixed Width': function () {
					if (confirm('Are you sure you want to clear wixed width for all columns?')) {
						g_stbFixedColumnsWidth = [];
						$(this).dialog('close');
					}
				},
				Cancel: function () {
					$(this).dialog('close');
				}
			}
		});
		g_stbMultipleColumnsSortingDialog = $('#setMultipleColumnsSortingDialog').dialog({
			autoOpen: false,
			width:    600,
			height:   'auto',
			modal:    true,
			open: function() {
				var $this = $(this),
					columnsSortOrder = '',
					disableSortOrder = '',
					i = 0;

				for(i = 0; i < g_stbMultipleColumnsSorting.length; i++) {
					if(g_stbMultipleColumnsSorting[i]) {
						columnsSortOrder += '<span>column ' + (g_stbMultipleColumnsSorting[i][0] + 1) + ': ' + g_stbMultipleColumnsSorting[i][1] + '</span><br />';
					}
				}
				for(i = 0; i < g_stbDisableColumnsSorting.length; i++) {
					if(g_stbDisableColumnsSorting[i]) {
						disableSortOrder += '<span>column ' + (g_stbDisableColumnsSorting[i] + 1) + ': disable</span><br />';
					}
				}
				if(!columnsSortOrder) {
					$this.find('.columnSortOrderDataLabel').hide();
				} else {
					$this.find('.columnSortOrderDataLabel').show();
				}
				if(!disableSortOrder) {
					$this.find('.disableSortOrderDataLabel').hide();
				} else {
					$this.find('.disableSortOrderDataLabel').show();
				}
				$this.find('#columnSortOrderData').html(columnsSortOrder);
				$this.find('#disableSortOrderData').html(disableSortOrder);
			},
			buttons:  {
				Apply: function () {
					var $this = $(this),
						editor = window.editor,
						selection = editor.getSelectedRange(),
						order = $this.find('input[name="columnSortOrder"]:checked').val(),
						exists = false;
					for(var i = selection.from.col; i <= selection.to.col; i++) {
						if(order == 'disable') {
							if(toeInArray(i, g_stbDisableColumnsSorting)) {
								g_stbDisableColumnsSorting.push(i);
							}
						} else {
							for(var j = 0; j < g_stbMultipleColumnsSorting.length; j++) {
								if(g_stbMultipleColumnsSorting[j][0] == i) {
									g_stbMultipleColumnsSorting[j] = [i, order];
									exists = true;
								}
							}
							if(!exists) {
								g_stbMultipleColumnsSorting.push([i,order]);
							}
						}
					}

					$(this).dialog('close');
				},
				'Clear Multiple Sorting': function () {
					if (confirm('Are you sure you want to clear multiple sorting for all columns?')) {
						g_stbMultipleColumnsSorting = [];
						$(this).dialog('close');
					}
				},
				'Clear Disable Sorting': function () {
					if (confirm('Are you sure you want to clear disable sorting for all columns?')) {
						g_stbDisableColumnsSorting = [];
						$(this).dialog('close');
					}
				},
				Cancel: function () {
					$(this).dialog('close');
				}
			}
		});
		g_stbTableLoaderIconDialog = $('#tableLoaderIconDialog').dialog({
			autoOpen: false,
			modal:    true,
			width:    900,
			open: function() {
				var color = $('.tableLoaderColorArea').css('backgroundColor');
				$('.preicon_img').css('color', color);
				$('.preicon_img .spinner').css('backgroundColor', color);
			},
			buttons:  {
				Cancel: function () {
					$(this).dialog('close');
				}
			}
		});
		g_stbCloneDialog = $('#cloneDialog').dialog({
			autoOpen: false,
			width:    480,
			modal:    true,
			open: function() {
				var dialog = $(this);
				dialog.find('.message').remove();
				dialog.find('.input-group').show();
				dialog.find('input').val($.trim($('#stbTableTitleLabel').text()) + '_Clone');
				dialog.next().find('button:first-of-type').removeAttr('disabled');
				dialog.next().find('button:first-of-type').html('Clone').show();
			},
			buttons:  {
				Clone: function (e) {
					var $dialog = $(this),
						$button = $(e.target).closest('button');

					$button.attr('disabled', true);
					$button.html(app.createSpinner());
					tablesModel.request('cloneTable', {
						id: app.getParameterByName('id'),
						title: $(this).find('input').val()
					}).done(function(response) {
						if (response.success) {
							var html = '<a href="' + app.replaceParameterByName(window.location.href, 'id', response.id) + '" class="ui-button" style="text-decoration: none !important;">Open cloned table</a><div style="float: right; margin-top: 5px;">Done!</div>';

							$button.hide();
							$dialog.find('.input-group').hide();
							$dialog.find('.input-group').after($('<div>', {class: 'message', html: html}));
						}
					});
				},
				Cancel: function () {
					$(this).dialog('close');
				}
			}
		});
		g_stbAddContactFormBtnDialog = $('#addContactFormBtnDialog').dialog({
			autoOpen: false,
			width:    700,
			modal:    true,
			open: function() {
				var $this = $(this),
					columns = app.Editor.Hot.getColHeader(),
					exampleColomnNameSelect = $this.find('.columnName');
				exampleColomnNameSelect.html('<option value="">--</option>');
				for(var i = 0; i < columns.length; i++) {
					exampleColomnNameSelect.append('<option value="'+columns[i]+'">'+columns[i]+'</option>')
				}
			},
			close: function() {
				var $this = $(this);
				$this.find('.contactFormFieldsShellWrapper').hide();
				$this.find('.contactFormFieldsShell').html('');
				$this.find('[type="text"], select[name="forms_list"]').val('');
				$this.find('[type="checkbox"]').prop('checked', false).iCheck('update');
			},
			buttons:  {
				'Add Button': function (e) {
					var editor = app.Editor.Hot,
						range = editor.getSelectedRange();

					if (range === undefined) {
						return;
					}
					var shell = $('#addContactFormBtnDialog'),
						url = shell.find('[name="posts_list"]').val(),
						urlArr = url.split('?'),
						text = shell.find('[name="btn_text"]').val() || 'Button',
						classes = shell.find('[name="btn_class"]').val(),
						styles = shell.find('[name="btn_style"]').val(),
						target = shell.find('[name="btn_target"]').is(':checked'),
						fields = shell.find('.contactFormFieldsShell .columnName'),
						symbol = urlArr.length > 1 ? '&' : '?',
						link = url+symbol+'cfsPreFill=1',
						btn = '';
					for(var i = 0; i < fields.length; i++) {
						var f = $(fields[i]);
						if(f.val()) {
							var label = f.parents('.contactFormFieldRow').find('[name="field_name"]').val();
							link += '&cfs_'+label+'='+f.val();
						}
					}
					btn += '<a href="'+link+'"';
					btn += target ? ' target="_blank"' : '';
					btn += classes ? ' class="'+classes+'"' : '';
					btn += styles ? ' style="'+styles+'"' : '';
					btn += '>'+text+'</a>';
					for(var row = range.from.row; row <= range.to.row; row++) {
						for (var col = range.from.col; col <= range.to.col; col++) {
							editor.setDataAtCell(row, col, btn);
						}
					}
					$(this).dialog('close');
				},
				Cancel: function () {
					$(this).dialog('close');
				}
			}
		});
		$('#addContactFormBtnDialog select[name="forms_list"]').on('change', function() {
			var $this = $(this),
				formId = $this.val(),
				fieldRowExample = $('#contactFormFieldRowExample'),
				fieldRowsShell = $('.contactFormFieldsShell'),
				formOption,
				formData,
				fields;
			if(formId > 0) {
				formOption = $this.find('option[value="'+formId+'"]');
				if(formOption.length) {
					formData = formOption.data('item');
					if(formData && formData.params && formData.params.fields && formData.params.fields.length) {
						fields = formData.params.fields;
						fieldRowsShell.html('');
						for(var i = 0; i < fields.length; i++) {
							if(typeof fields[i].value != 'undefined') {
								var fieldRow = fieldRowExample.clone(),
									name = fields[i].label
										? fields[i].label+' ('+fields[i].name+')'
										: (fields[i].placeholder ? fields[i].placeholder+' ('+fields[i].name+')' : fields[i].name);
								fieldRow.removeAttr('id');
								fieldRow.find('.fieldName').html(name);
								fieldRow.find('[name="field_name"]').val(fields[i].name);
								fieldRow.appendTo(fieldRowsShell);
								fieldRow.show();
							}
						}
					}
				}
				fieldRowsShell.parents('.contactFormFieldsShellWrapper').show();
			}
		});

		// Main Buttons Actions
		$('#buttonClone').on('click', function () {
			g_stbCloneDialog.dialog('open');
		});
		$('#buttonSave').on('click', function () {
			tablesModel.saveTable();
		});
		$('#buttonDelete').on('click', function () {
			var $button = $(this);

			if (!confirm('Are you sure you want to delete the this table?')) {
				return;
			}
			app.createSpinner($button);
			tablesModel.remove(app.getParameterByName('id'))
				.done(function () {
					window.location.href = $('#menuItem_tables').attr('href');
				})
				.fail(function (error) {
					alert('Failed to delete table: ' + error);
				})
				.always(function () {
					app.deleteSpinner($button);
				});
		});
		$('#buttonClearData').on('click', function () {
			if (!confirm('Are you sure you want to clear all data in this table?')) {
				return;
			}
			editor.clear();
			if (g_stbPagination) {
				for (var i = 0; i <= editor.bufferData.length; i++) {
					for (var j = 0; j < editor.bufferCols; j++) {
						editor.bufferData[i][j] = '';
					}
				}
			}
			if($('#woocommerce-settings').length){
				//remove html with options
				$('input[name="woocommerce[order]"]').val('');
				$('input[name="woocommerce[productids]"]').val('');
				$('input[name="woocommerce[enable]"]').prop('checked', false).iCheck('update');
				tablesModel.saveTable();
				setTimeout(function() {
					location.reload();
				}, 500);
			}
		});

		// Settings Form Options
		var formSettings = $('form#settings'),
			head = formSettings.find('[name="elements[head]"]'),
			foot = formSettings.find('[name="elements[foot]"]'),
			fixedHead = formSettings.find('[name="fixedHeader"]'),
			fixedFoot = formSettings.find('[name="fixedFooter"]');

		// Set numbers
		formSettings.find('[name="useNumberFormat"]').on('change ifChanged', function() {
			if($(this).is(':checked')) {
				editor.useNumberFormat = true;
				$('.use-number-format-options').show();
			} else {
				editor.useNumberFormat = false;
				$('.use-number-format-options').hide();
			}
			editor.render();
		}).trigger('change');
		formSettings.find('[name="numberFormat"]').on('change', function(e) {
			e.preventDefault();
			editor.render();
		});

		// Set currency
		formSettings.find('[name="currencyFormat"]').on('change', function(e) {
			e.preventDefault();
			editor.render();
		});

		// Set percent
		formSettings.find('[name="percentFormat"]').on('change', function(e) {
			e.preventDefault();
			var value = $.trim($(this).val());
			$('.percent-format').attr('data-format', value);
			$('.percent-convert-format').attr('data-format', value);
			editor.render();
		});

		// Set date
		formSettings.find('[name="dateFormat"]').on('change', function(e) {
			e.preventDefault();
			$('.date-format').attr('data-format', $.trim($(this).val()));
		});

		// Set time / duration
		formSettings.find('[name="timeDurationFormat"]').on('change', function(e) {
			e.preventDefault();
			$('.time_duration-format').attr('data-format', $.trim($(this).val()));
		});

		// Fixed Header / Footer
		head.on('change ifChanged', function() {
			if(!$(this).is(':checked') && fixedHead.is(':checked')) {
				fixedHead.iCheck('uncheck');
			}
		});
		foot.on('change ifChanged', function() {
			if(!$(this).is(':checked') && fixedFoot.is(':checked')) {
				fixedFoot.iCheck('uncheck');
			}
			if($(this).is(':checked')) {
				if($('input[name="customFooter"]').is(':checked')) {
					$('.custom-footer-options').fadeIn();
				}
			} else {
				if($('input[name="customFooter"]').is(':checked')) {
					$('.custom-footer-options').fadeOut();
				}
			}
		});
		fixedHead.on('change ifChanged', function() {
			var head = $('#table-elements-head');

			if($(this).is(':checked') && !head.is(':checked')) {
				head.iCheck('check');
			}
			if($(this).is(':checked')) {
				$('.features-fixed-height').fadeIn();
			} else {
				$('.features-fixed-height').fadeOut();
			}
		});
		fixedFoot.on('change ifChanged', function() {
			var foot = $('#table-elements-foot');

			if($(this).is(':checked') && !foot.is(':checked')) {
				foot.iCheck('check');
			}
		});

		// Fixed Table Width - Width Type
		$('input[name="tableWidthType"]').on('ifChecked', function() {
			if($(this).val() == 'auto') {
				$('input[name="tableWidth"]').fadeOut(300);
			} else {
				$('input[name="tableWidth"]').fadeIn(300);
			}
		});

		// Fixed Table Width Mobile - Width Type
		$('input[name="tableWidthMobileType"]').on('ifChecked', function() {
			if($(this).val() == 'auto') {
				$('input[name="tableWidthMobile"]').fadeOut(300);
			} else {
				$('input[name="tableWidthMobile"]').fadeIn(300);
			}
		});

		// Search by Columns - Position
		$('input[name="searching[columnSearch]"]').on('change ifChanged', function() {
			if($(this).is(':checked')) {
				$('select[name="searching[columnSearchPosition]"]').parents('.setting-wrapper:first').fadeIn(300);
			} else {
				$('select[name="searching[columnSearchPosition]"]').parents('.setting-wrapper:first').fadeOut(300);
			}
		});

		// Show results only - Show empty table
		$('input[name="searching[resultOnly]"]').on('change ifChanged', function() {
			if($(this).is(':checked')) {
				$('input[name="searching[showTable]"]').parents('.setting-wrapper:first').fadeIn(300);
			} else {
				$('input[name="searching[showTable]"]').parents('.setting-wrapper:first').fadeOut(300);
			}
		});
		$('input[name="features[searching]"]').on('change ifChanged', function() {
			$('input[name="searching[resultOnly]"]').trigger('change');
			$('input[name="searching[columnSearch]"]').trigger('change');
		});

		// Table Loader
		var $tblLoaderIconName = $('input[name="tableLoader[iconName]"]'),
			$tblLoaderIconItems = $('input[name="tableLoader[iconItems]"]'),
			$tblLoaderPreview = $('#tableLoaderIconPreview');

		$('.selectTableLoaderIcon').on('click', function(e) {
			e.preventDefault();
			g_stbTableLoaderIconDialog.dialog('open');
		});
		$('.item-inner').on('click', function () {
			var iconImg = $(this).find('.preicon_img');
			var $tblLoaderIconColor = iconImg.css('color');
			$tblLoaderIconName.val(iconImg.data('name'));
			$tblLoaderIconItems.val(iconImg.data('items'));
			if($tblLoaderIconName.val() == 'default'){
				$tblLoaderPreview.html('');
				$tblLoaderPreview.append('<div class="supsystic-table-loader spinner" style="background-color:'+$tblLoaderIconColor+'"></div>');
			} else {
				var items = '';
				$tblLoaderPreview.html('');
				for(var i = 0; i < $tblLoaderIconItems.val(); i++){
					items += "<div></div>";
				}
				$tblLoaderPreview.append(
					'<div class="supsystic-table-loader la-'+$tblLoaderIconName.val()+' la-2x" style="color:'+$tblLoaderIconColor+'">'+items+'</div>'
				);
			}
			g_stbTableLoaderIconDialog.dialog('close');
		});
		$('#tableLoaderColorContainer').ColorPicker({
			color: '#000000',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				g_stbTableLoaderBgColorLast = hex;

				if(!g_stbTableLoaderBgColorTimeoutSet) {
					setTimeout(function(){
						g_stbTableLoaderBgColorTimeoutSet = false;
						$('.tableLoaderColorArea').css('backgroundColor', '#' + g_stbTableLoaderBgColorLast);
						$('#tableLoaderIconPreview .la-2x').css('color', '#' + g_stbTableLoaderBgColorLast);
						$('#tableLoaderIconPreview .spinner').css('backgroundColor', '#' + g_stbTableLoaderBgColorLast);
						$('input[name="tableLoader[color]"]').val('#' + g_stbTableLoaderBgColorLast);
					}, 500);
					g_stbTableLoaderBgColorTimeoutSet = true;
				}
			}
		});

		// Pro Notifications and Dialog Windows
		var $proNotify = $('.pro-notify');

		$proNotify.each(function() {
			var $this = $(this);

			$($this.data('dialog')).dialog({
				autoOpen: false,
				title: $this.data('dtitle'),
				width:    $this.data('dwidth'),
				modal:    true,
				buttons:  {
					Close: function () {
						$(this).dialog('close');
					}
				}
			})
		});
		$proNotify.on('click', function (e) {
			e.preventDefault();
			$($(this).data('dialog')).dialog('open');
		});
		$('#previewDiagramProFeature [data-tabs] a').on('click', function(e) {
			e.preventDefault();

			var dialog = $('#previewDiagramProFeature');

			dialog.find('[data-tabs] a').removeClass('active');
			dialog.find('[data-tab]').removeClass('active');

			$(this).addClass('active');
			dialog.find('[data-tab="' + $(this).attr('href') + '"]').addClass('active');
		});
	});
}(window.jQuery, window.supsystic.Tables));
