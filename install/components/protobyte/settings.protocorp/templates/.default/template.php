<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->addExternalCss($templateFolder."/plugins/colorpicker/colorpicker.css");?>
<?$this->addExternalJS($templateFolder."/plugins/colorpicker/colorpicker.js");?>
<?$printSettings = 'print_window_settings_' . SITE_ID;?>
<?$optionColor = 'COLOR_SITE_' . SITE_ID;?>
<?$optionFileName = 'FILE_NAME_COLOR_' . SITE_ID;?>

<?if($arResult['CURRENT_SETTINGS'][$printSettings] == 'Y'):?>
<div class="settings">
	<div class="settings__switcher">
		<img src="<?=$templateFolder . '/img/gear.png'?>" alt="" width="54" height="54">
	</div>
	<div class="settings__window" id="settings-parameters-info" data-site-id="<?=SITE_ID?>" data-template-path="<?=SITE_TEMPLATE_PATH?>" data-component-path="<?=$this->getComponent()->getPath();?>">
		<div class="settings__head">
			<?=getMessage('SETTINGS_PROTO_HEAD')?>
		</div>
		<?if(!empty($arResult['COLOR_ARRAY'])):?>
			<div class="settings__block settings__color settings__type-link" data-id="FILE_NAME_COLOR_<?=SITE_ID?>">
				<div id="current-color" 
						data-file-color="<?=(!empty($arResult["CURRENT_SETTINGS"][$optionFileName]["FILE_NAME"])) ? $arResult["CURRENT_SETTINGS"][$optionFileName]["FILE_NAME"] : ''?>" 
						data-type-color="<?=(!empty($arResult["CURRENT_SETTINGS"][$optionFileName]["TYPE"])) ? $arResult["CURRENT_SETTINGS"][$optionFileName]["TYPE"] : ''?>" 
						data-main-color="<?=(!empty($arResult["CURRENT_SETTINGS"][$optionFileName]["MAIN"])) ? $arResult["CURRENT_SETTINGS"][$optionFileName]["MAIN"] : ''?>" 
						data-hover-color="<?=(!empty($arResult["CURRENT_SETTINGS"][$optionFileName]["HOVER"])) ? $arResult["CURRENT_SETTINGS"][$optionFileName]["HOVER"] : ''?>"
						style="display:none;" >
				</div>
				<div class="settings__block-title"><?=getMessage('SETTINGS_PROTO_COLOR_TITLE')?></div>
				<div class="settings__color-list">
					<?foreach($arResult['COLOR_ARRAY'] as $name => $color):?>
						<?if(!empty($color['MAIN']) && $name != 'CUSTOM'):?>
							<div class="settings__color-item settings__type-link-item 
							<?=($arResult['CURRENT_SETTINGS'][$optionColor] == $name) ? "active" : ""?>" title="<?=$name?>" data-type-color="<?=$color['TYPE']?>" data-main-color="<?=$color['MAIN']?>" data-hover-color="<?=$color['HOVER']?>">
								<input style="display: none" type="radio" name="<?=$name?>" id="color_<?=$name?>" value="<?=$color['MAIN']?>">
								<label for="color_<?=$name?>" title="<?=$name?>" class="settings__color-item-label">
									<span class="settings__color-item-btn">
										<span class="settings__color-item-image" style="background:<?=$color['MAIN']?>;"></span>
									</span>
								</label>
							</div>
						<?endif?>
					<?endforeach?>
				</div>
				<div class="settings__hr"></div>
				<div class="settings__custom-color-title">
					<?=GetMessage("SETTINGS_PROTO_CUSTOM_COLOR_TITLE")?>
				</div>
				<div class="settings__custom-color-fields">
					<div class="settings__custom-color-field">
						<div class="settings__custom-color-field-wrap">
							<div class="settings__custom-color-field-show"
								id="settings-custom-color-main-show"
								style="background:<?=(!empty($arResult["CURRENT_SETTINGS"][$optionFileName]["MAIN"])) ? $arResult["CURRENT_SETTINGS"][$optionFileName]["MAIN"] : ''?>;"></div>
							<div class="settings__custom-color-field-inp">
								<div class="settings__custom-color-label"><?=GetMessage("SETTINGS_PROTO_CUSTOM_COLOR_MAIN")?></div>
								<input type="text" id="settings-custom-color-main" class="settings__custom-color-picker" value="<?=(!empty($arResult["CURRENT_SETTINGS"][$optionFileName]["MAIN"])) ? $arResult["CURRENT_SETTINGS"][$optionFileName]["MAIN"] : ''?>" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="settings__custom-color-field">
						<div class="settings__custom-color-field-wrap">
							<div class="settings__custom-color-field-show"
							id="settings-custom-color-hover-show"
							style="background:<?=(!empty($arResult["CURRENT_SETTINGS"][$optionFileName]["HOVER"])) ? $arResult["CURRENT_SETTINGS"][$optionFileName]["HOVER"] : ''?>;"></div>
							<div class="settings__custom-color-field-inp">
								<div class="settings__custom-color-label"><?=GetMessage("SETTINGS_PROTO_CUSTOM_COLOR_HOVER")?></div>
								<input type="text" id="settings-custom-color-hover" class="settings__custom-color-picker" value="<?=(!empty($arResult["CURRENT_SETTINGS"][$optionFileName]["HOVER"])) ? $arResult["CURRENT_SETTINGS"][$optionFileName]["HOVER"] : ''?>" autocomplete="off">
							</div>
						</div>
					</div>
				</div>
			</div>
		<?endif?>
		<div class="settings__custom-color-message-error" style="display:none">
			<?=GetMessage("SETTINGS_PROTO_CUSTOM_COLOR_WINDOW_ERROR")?>
		</div>
		<div class="settings__custom-color-message-error-file" style="display:none">
			<?=GetMessage("SETTINGS_PROTO_CUSTOM_COLOR_WINDOW_ERROR_FILE")?>
		</div>
		<div class="settings__btns">
			<div class="settings__save btn-default">
				<?=getMessage('SETTINGS_PROTO_SAVE')?>
			</div>
			<div class="settings__close">
				<?=getMessage('SETTINGS_PROTO_CLOSE')?>
			</div>
		</div>
		<div class="settings__save-error" style="display: none">
			<?=getMessage('SETTINGS_SAVE_ERROR')?>
		</div>
	</div>
</div>
<?endif?>