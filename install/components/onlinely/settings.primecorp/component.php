<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $USER;

if(!$USER->IsAdmin()){
	return false;
}

if(	!\Bitrix\Main\Loader::includeModule("onlinely.primecorp")){
	return false;
}
	$arResult = array();

	$OnlinelySettings = Onlinely\Primecorp\OnlinelySettingsCorp::getInstance();
	$arResult["CURRENT_SETTINGS"] = $OnlinelySettings->getCurrentSettings();
	$arResult["DEFAULT_SETTINGS"] = $OnlinelySettings->getDefaultSettings();
	$arResult["COLOR_ARRAY"] = $OnlinelySettings->setColorThemes();
	
		$arResult["ISSET_CUSTOM_COLOR_FOLDER"] = $OnlinelySettings->searchCustomColor($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/css/themes/");
		$logoOptionName = "LOGO_FILE_ID_" . SITE_ID;
		$logoFileId = (int)\Bitrix\Main\Config\Option::get("onlinely.primecorp", $logoOptionName, 0);
		$arResult["LOGO_FILE_ID"] = $logoFileId;
		$arResult["LOGO_SRC"] = $logoFileId > 0 ? CFile::GetPath($logoFileId) : "";
	$this->IncludeComponentTemplate();

?>
