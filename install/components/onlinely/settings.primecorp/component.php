<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $USER;

if(!$USER->IsAdmin()){
	return false;
}

if(	!\Bitrix\Main\Loader::includeModule("onlinely.primecorp")){
	return false;
}
	$arResult = array();

	$ProtoSettings = Onlinely\Protocorp\ProtoSettingsCorp::getInstance();
	$arResult["CURRENT_SETTINGS"] = $ProtoSettings->getCurrentSettings();
	$arResult["DEFAULT_SETTINGS"] = $ProtoSettings->getDefaultSettings();
	$arResult["COLOR_ARRAY"] = $ProtoSettings->setColorThemes();
	
	$arResult["ISSET_CUSTOM_COLOR_FOLDER"] = $ProtoSettings->searchCustomColor($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/css/themes/");
$this->IncludeComponentTemplate();

?>