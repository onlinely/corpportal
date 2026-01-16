$( document ).ready(function() {

	var settingsSiteId = $('#settings-parameters-info').data("site-id");
		$settings__switcher = $(".settings__switcher"),
		$settings__window = $(".settings__window"),
		componentPath = $('#settings-parameters-info').data("component-path"),
		mainTemplatePath = $('#settings-parameters-info').data("template-path");

	var checkVar = function(cVar){
			return typeof cVar != "undefined" && cVar != "";
		}
		
	var getCookie = function(name){

		//vars
		var matches = document.cookie.match(new RegExp(
			"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
		));

		return matches ? decodeURIComponent(matches[1]) : undefined;

	}
	$(function(){
		$(".settings__custom-color-picker").ColorPicker({
			onSubmit: function(hsb, hex, rgb, cal){
				$(cal).val("#" + hex);
			},
			onChange: function(cal, hex){
				$('.settings__type-link-item').removeClass('active');
				$(this.el).val("#" + hex).trigger('input');
			},
			onBeforeShow: function(){
				$(this).ColorPickerSetColor(this.value);
			}
		}).bind("keyup", function(){
			$(this).ColorPickerSetColor(this.value);
		});
	});

	function settingsSave (event){
		$settingsItems = $settings__window.find(".settings__type-link");
		ajaxFormData = new FormData();
		var currentColorFile = $('#current-color').data('file-color'),
		currentColorType = $('#current-color').data('type-color'),
		currentColorMain = $('#current-color').data('main-color'),
		currentColorHover = $('#current-color').data('hover-color'),
		ruleColor = /^\#\w\w\w\w\w\w$/,
		newColorType = '',
		newColorMain = $('#settings-custom-color-main').val().toUpperCase().trim(),
		newColorHover = $('#settings-custom-color-hover').val().toUpperCase().trim(),
		resultMainColor = ruleColor.test(newColorMain),
		resultHoverColor = ruleColor.test(newColorHover);
		if (!currentColorFile.endsWith('.css')) {
			currentColorFile += '.css';
		}
		$settingsItems.each(function(ix, nextItem){
			var $nextItem = $(nextItem);
			var nextItemSettingId = $nextItem.data("id");
			var nextItemSettingValue = "";

			if(typeof nextItemSettingId != "undefined" && nextItemSettingId != ""){
				if($nextItem.hasClass("settings__type-link")){
					if($nextItem.hasClass("settings__color")){

						var	isActiveColor = $nextItem.find(".settings__type-link-item").hasClass('active');
		
						if(resultMainColor && resultHoverColor) {
							if(isActiveColor) {
								var optColorName = 'COLOR_SITE_' + settingsSiteId,
									optFileName = 'FILE_NAME_COLOR_' + settingsSiteId,
									newColorName = $('.settings__color-item.active').attr('title');
									newColorFile = 'color_' + newColorMain.substring(1) + '_' + newColorHover.substring(1) +'.css';
								ajaxFormData.append(optColorName, newColorName);
								ajaxFormData.append(optFileName, newColorFile);

							} else {
								newColorType = 'custom';
								var newColorFile = newColorType + '_' + newColorMain.substring(1)+ '_' + newColorHover.substring(1) + '.css';
								$('.settings__custom-color-message-error').hide();
	
								var colors = {
									"currentColor": {
										File: currentColorFile,
										Type: currentColorType,
										Main: currentColorMain,
										Hover: currentColorHover
									},
									"replaceColor": {
										File: newColorFile,
										Type: newColorType,
										Main: newColorMain,
										Hover: newColorHover
									}
								};
								FormData_append_object(ajaxFormData, colors);
							}

						}else{
							$('.settings__custom-color-message-error').show();
						}

				}else {
					nextItemSettingValue = $nextItem.find(".settings__type-link-item.active").data("value");
				}
				
			}
			if(typeof nextItemSettingValue != "undefined" && nextItemSettingValue != "" && nextItemSettingId != ""){
				if(!nextItemIsFile && typeof nextItemSettingValue == "object"){
					$.each(nextItemSettingValue, function(inx, nextValue){
						ajaxFormData.append(nextItemSettingId, nextValue);
					});
				}
				else{
					ajaxFormData.append(nextItemSettingId, nextItemSettingValue);
				}
			}
		}
		});

		if(!$.isEmptyObject(ajaxFormData)){
			if(resultMainColor && resultHoverColor){
				sendSettings(ajaxFormData);
			}
		}
	};

	function FormData_append_object(fd, obj, key) {
		var i, k;
		for(i in obj) {
		  k = key ? key + '[' + i + ']' : i;
		  if(typeof obj[i] == 'object')
			FormData_append_object(fd, obj[i], k);
		  else
			fd.append(k, obj[i]);
		}
	}

	function sendSettings (ajaxFormData){

		if(!$.isEmptyObject(ajaxFormData)){

			if(checkVar(componentPath)){

				ajaxFormData.append("siteId", settingsSiteId);
				ajaxFormData.append("path", mainTemplatePath);
				ajaxFormData.append("action", "saveSettings");

				$.ajax({
					type: "POST",
					url: componentPath + "/ajax.php",
					enctype: "multipart/form-data",
					data: ajaxFormData,
					processData: false,
					contentType: false,
					dataType: "json",
					async: false,
					cache: false,
					success: function(jsonData){
						if(checkVar(jsonData["SUCCESS"]) && jsonData["SUCCESS"] == "Y"){
							console.log(jsonData);
							console.log("settings successfully saved");
							window.location.reload();
							$('.settings__close').trigger('click');
						}
						else{
							$('.settings__save-error').show();
							console.error("sendSettings: error");
							console.error(jsonData);
						}
					},
				});
			}
		}
	};

	function checkOpenSettings () {
		var open = getCookie('switcherOpened');
		if(open == 'Y'){
			$settings__switcher.addClass("active");
			$settings__window.addClass("opened");
		}
	}

	checkOpenSettings ();

	$('.settings__switcher, .settings__close').on('click', function(){
		//create cookie
		var date = new Date(new Date().getTime() + 3660 * 1000);
		if(!$settings__switcher.hasClass("active")){
			$settings__switcher.addClass("active");
			$settings__window.addClass("opened");
			document.cookie = "switcherOpened=Y; path=/; expires=" + date.toUTCString();
		}
		else{
			$settings__switcher.removeClass("active");
			$settings__window.removeClass("opened");
			document.cookie = "switcherOpened=N; path=/; expires=" + date.toUTCString();
		}
	});
	$('.settings__color-item').on('click', function(e){
		e.preventDefault();
		$('.settings__color-item').removeClass("active");
		$(this).addClass("active");
		var mainCol = $(this).data('main-color'),
			hoverCol = $(this).data('hover-color');
			$('#settings-custom-color-main').val(mainCol).trigger('input');
			$('#settings-custom-color-hover').val(hoverCol).trigger('input');
		console.log(mainCol);
	});

	$('.settings__custom-color-picker').on('input', function(){

		$('.settings__type-link-item').removeClass('active');
		$('.settings__color-item').removeClass('active');

		if(this.id == 'settings-custom-color-main'){
			$('#settings-custom-color-main-show').css('background', $(this).val());
		}else if(this.id == 'settings-custom-color-hover'){
			$('#settings-custom-color-hover-show').css('background', $(this).val());
		}
	});

	$('.settings__custom-color-btn').on('click', function(){
		createCustomColor ();
	});
	
	$('.settings__save').on('click', function(){
		settingsSave ();
	});

});
